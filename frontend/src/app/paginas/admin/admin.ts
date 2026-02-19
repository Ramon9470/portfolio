import { Component, OnInit, Inject, PLATFORM_ID, ChangeDetectorRef } from '@angular/core';
import { CommonModule, isPlatformBrowser } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Autenticacao } from '../../servicos/autenticacao';
import { Portfolio } from '../../servicos/portfolio';

@Component({
  selector: 'app-admin',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './admin.html',
  styleUrl: './admin.css'
})

export class Admin implements OnInit {

  selectedImage: File | null = null;
  selectedCertificate: File | null = null;
  selectedProjectImage: File | null = null;
  selectedProfilePhoto: File | null = null;

  projects: any[] = [];
  experiences: any[] = [];
  courses: any[] = [];
  isBrowser: boolean;
  personalInfo: any = {};

  showProjectModal = false;
  showExperienceModal = false;
  showCourseModal = false;
  isEditing = false;
  showProfileModal = false;

  currentProject: any = {
    titulo: '',
    descricao: '',
    tecnologias: '',
    imagem_url: '',
    repo_url: '',
    live_url: '',
    ordem: 0
  };
  
  currentExperience: any = {
    id: null,
    empresa: '',
    cargo: '',
    periodo: '',
    descricao: ''
  };

  currentCourse: any = {
    id: null,
    titulo: '',
    instituicao: '',
    tipo: '',
    status: '',
    data_inicio: null,
    data_conclusao: null,
    certificado_url: '',
    imagem_url: ''
  };

  constructor(
    private autenticacao: Autenticacao,
    private portfolio: Portfolio,
    private cdr: ChangeDetectorRef,
    @Inject(PLATFORM_ID) platformId: Object
  ) {
    this.isBrowser = isPlatformBrowser(platformId);
  }

  ngOnInit() {
    if (this.isBrowser) {
      this.loadAllData();
      this.portfolio.refreshNeeded$.subscribe(() => {
        this.loadAllData();
      });
    }
  }  

  onFileSelected(event: any, field: string) {
    const file = event.target.files[0];
    if (file) {
      if (field === 'imagem') {
        this.selectedImage = file;
      } else if (field === 'certificado') {
        this.selectedCertificate = file;
      }
    }
  }

  onProjectFileSelected(event: any) {
    const file = event.target.files[0];
    if (file){
      this.selectedProjectImage = file;
    }
  }

  onProfilePhotoSelected(event: any) {
    const file = event.target.files[0];
    if (file){
      this.selectedProfilePhoto = file;
    }
  }

  loadAllData(){
    this.loadPersonalInfo();
    this.loadProjects();
    this.loadExperiences();
    this.loadCourses();
  }

  loadCourses(){
    this.portfolio.getCourses().subscribe({
      next: (data) => { 
        this.courses = data; 
        this.cdr.detectChanges(); 
      },
      error: (err) => console.error('erro ao buscar cursos: ', err)
    });
  }

  loadPersonalInfo() {
    this.portfolio.getPersonalInfos().subscribe({
      next: (data) => { this.personalInfo = data; },
      error: (err) => console.error(err)
    });
  }

  openProfileModal() {
    this.selectedProfilePhoto = null;
    this.showProfileModal = true;
  }

  saveProfile() {
    const formData = new FormData();

    formData.append('nome_completo', this.personalInfo.nome_completo || '');
    formData.append('titulo', this.personalInfo.titulo || '');
    formData.append('resumo', this.personalInfo.resumo || '');
    formData.append('email', this.personalInfo.email || '');
    formData.append('telefone', this.personalInfo.telefone || '');
    formData.append('cidade', this.personalInfo.cidade || '');
    formData.append('estado', this.personalInfo.estado || '');
    formData.append('linkedin_url', this.personalInfo.linkedin_url || '');
    formData.append('github_url', this.personalInfo.github_url || '');

    if (this.selectedProfilePhoto) {
      formData.append('foto', this.selectedProfilePhoto);
    }

    this.portfolio.updatePersonalInfos(formData).subscribe({
      next: () => {
        alert('Perfil atualizado com sucesso!');
        this.showProfileModal = false;
        this.loadPersonalInfo();
      },
      error: (err) => {
        console.error(err);
        alert('Erro ao atualizar perfil.');
      }
    });
  }

  loadProjects() {
    this.portfolio.getProjects().subscribe({
      next: (data) => {
        this.projects = data;
        this.cdr.detectChanges();
      },
      error: (err) => {
        console.error('Erro ao buscar projetos:', err);
        if (err.status === 401) this.logout();
      }
    });
  }

  loadExperiences() {
    this.portfolio.getExperiences().subscribe({
      next: (data) => {
        this.experiences = data;
        this.cdr.detectChanges();
      },
      error: (err) => {
        console.error('Erro ao buscar experiências:', err);
        if (err.status === 401) {
          this.logout();
        }
      }
    });
  }

  openNewProjectModal() {
    this.isEditing = false;
    this.selectedProjectImage = null;
    this.resetProjectForm();
    this.showProjectModal = true;
  }

  openEditProjectModal(project: any) {
    this.isEditing = true;
    this.currentProject = { ...project };
    
    if (Array.isArray(this.currentProject.tecnologias)) {
      this.currentProject.tecnologias = this.currentProject.tecnologias.join(', ');
    }
    
    this.showProjectModal = true;
  }

  saveProject() {
    const formData = new FormData();
    
    // Adiciona os campos de texto
    formData.append('titulo', this.currentProject.titulo);
    formData.append('descricao', this.currentProject.descricao || '');
    formData.append('repo_url', this.currentProject.repo_url || '');
    formData.append('live_url', this.currentProject.live_url || '');
    
    let techs = this.currentProject.tecnologias;

    if (Array.isArray(techs)) {
      techs = techs.join(',');
    }

    formData.append('tecnologias', techs);

    if (this.selectedProjectImage) {
      formData.append('imagem', this.selectedProjectImage);
    }

    const request$ = this.isEditing 
      ? this.portfolio.updateProject(this.currentProject.id, formData)
      : this.portfolio.createProject(formData);

    request$.subscribe({
      next: () => {
        alert(this.isEditing ? 'Projeto atualizado!' : 'Projeto criado!');
        this.closeModals();
      },
      error: (err) => {
        console.error(err);
        alert(err.error?.message || 'Erro ao salvar projeto.');
      }
    });
  }

  deleteProject(id: number) {
    if(confirm('Tem certeza que deseja excluir este projeto?')) {
      this.portfolio.deleteProject(id).subscribe({
        next: () => {
          alert('Projeto excluído!');
        }
      });
    }
  }

  openNewExperienceModal() {
    this.isEditing = false;
    this.currentExperience = { 
      id: null, 
      empresa: '',
      cargo: '', 
      periodo: '', 
      descricao: '' 
    };
    this.showExperienceModal = true;
  }

  openEditExperienceModal(exp: any) {
    this.isEditing = true;
    this.currentExperience = { ...exp };
    this.showExperienceModal = true;
  }

  saveExperience() {
    const request$ = this.isEditing 
      ? this.portfolio.updateExperience(this.currentExperience.id, this.currentExperience)
      : this.portfolio.createExperience(this.currentExperience);

    request$.subscribe({
      next: () => {
        alert(this.isEditing ? 'Experiência atualizada!' : 'Experiência criada!');
        this.closeModals();
      }
    });
  }

  deleteExperience(id: number) {
    if(confirm('Tem certeza que deseja excluir esta experiência?')) {
      this.portfolio.deleteExperience(id).subscribe({
        next: () => {
          alert('Experiência apagada!');
        }
      });
    }
  }

  openNewCourseModal() {
    this.isEditing = false;
    this.selectedImage = null;
    this.selectedCertificate = null;
    this.currentCourse = { 
      id: null,
      titulo: '', 
      instituicao: '', 
      tipo: 'Graduação', 
      status: 'Concluído', 
      data_inicio: null, 
      data_conclusao: null, 
      certificado_url: '' 
    };
    this.showCourseModal = true;
  }

  openEditCourseModal(course: any) {
    this.isEditing = true;
    this.currentCourse = { ...course };
    this.showCourseModal = true;
  }

  saveCourse() {
    const formData = new FormData();
    
    formData.append('titulo', this.currentCourse.titulo);
    formData.append('instituicao', this.currentCourse.instituicao);
    formData.append('tipo', this.currentCourse.tipo);
    formData.append('status', this.currentCourse.status);
    
    if(this.currentCourse.data_inicio) 
      formData.append('data_inicio', this.currentCourse.data_inicio);
    
    if(this.currentCourse.data_conclusao) 
      formData.append('data_conclusao', this.currentCourse.data_conclusao);

    if (this.selectedImage) {
      formData.append('imagem', this.selectedImage);
    }
    
    if (this.selectedCertificate) {
      formData.append('certificado', this.selectedCertificate);
    }

    const request$ = this.isEditing 
      ? this.portfolio.updateCourse(this.currentCourse.id, formData)
      : this.portfolio.createCourse(formData);

    request$.subscribe({
      next: () => {
        alert(this.isEditing ? 'Curso atualizado!' : 'Curso criado!');
        this.closeModals();
      },
      error: (err) => {
        console.error(err);
        alert('Erro ao salvar. Verifique o console.');
      }
    });
  }

  deleteCourse(id: number) {
    if(confirm('Excluir este curso?')) {
      this.portfolio.deleteCourse(id).subscribe(() => alert('Curso removido!'));
    }
  }

  closeModals() {
    this.showProjectModal = false;
    this.showExperienceModal = false;
    this.showCourseModal = false;
    this.showProfileModal = false;
    this.cdr.detectChanges();
  }

  resetProjectForm() {
    this.currentProject = {
      titulo: '',
      descricao: '',
      tecnologias: '',
      imagem_url: '',
      repo_url: '',
      live_url: '',
      ordem: 0
    };
  }

  logout() {
    this.autenticacao.logout();
  }
}