import { Component, OnInit, Inject, PLATFORM_ID, ChangeDetectorRef } from '@angular/core';
import { CommonModule, isPlatformBrowser } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { AuthService } from '../../services/auth';
import { PortfolioService } from '../../services/portfolio';

@Component({
  selector: 'app-admin',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './admin.html', 
  styleUrl: './admin.css',
  host: { 'ngSkipHydration': 'true' } 
})

export class Admin implements OnInit {
  projects: any[] = [];
  experiences: any[] = [];
  isBrowser: boolean;

  showProjectModal = false;
  showExperienceModal = false;
  isEditing = false;

  currentProject: any = {
    title: '',
    description: '',
    tech_stack: '',
    image_url: '',
    repo_url: '',
    live_url: '',
    order: 0
  };
  
  currentExperience: any = {
    id: null,
    company: '',
    role: '',
    period: '',
    description: ''
  };

  constructor(
    private authService: AuthService,
    private portfolioService: PortfolioService,
    private cdr: ChangeDetectorRef,
    @Inject(PLATFORM_ID) platformId: Object
  ) {
    this.isBrowser = isPlatformBrowser(platformId);
  }

  ngOnInit() {
    if (this.isBrowser) {
      setTimeout(() => {
        this.loadProjects();
        this.loadExperiences();
      }, 100);
    }
  }

  loadProjects() {
    this.portfolioService.getProjects().subscribe({
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
    this.portfolioService.getExperiences().subscribe({
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

  openNewProjectModal(){
    this.isEditing = false;
    this.resetProjectForm();
    this.showProjectModal = true;
  }

  openEditProjectModal(project: any) {
    this.isEditing = true;
    this.currentProject = { ...project };
    
    if (Array.isArray(this.currentProject.tech_stack)) {
      this.currentProject.tech_stack = this.currentProject.tech_stack.join(', ');
    } else if (typeof this.currentProject.tech_stack === 'string' && this.currentProject.tech_stack.startsWith('[')) {
       try {
         this.currentProject.tech_stack = JSON.parse(this.currentProject.tech_stack).join(', ');
       } catch (e) { }
    }
    
    this.showProjectModal = true;
  }

  saveProject() {
    const dataToSend = { ...this.currentProject };
    
    if (typeof dataToSend.tech_stack === 'string') {
      dataToSend.tech_stack = dataToSend.tech_stack.split(',').map((item: string) => item.trim());
    }

    if (this.isEditing) {
      this.portfolioService.updateProject(this.currentProject.id, dataToSend).subscribe(() => {
        alert('Projeto atualizado!');
        this.closeModals();
        this.loadProjects();
      });
    } else {
      this.portfolioService.createProject(dataToSend).subscribe(() => {
        alert('Projeto criado!');
        this.closeModals();
        this.loadProjects();
      });
    }
  }
 
  deleteProject(id: number) {
    if(confirm('Tem certeza que deseja excluir este projeto?')) {
      this.portfolioService.deleteProject(id).subscribe(() => {
        this.loadProjects();
        alert('Projeto excluído!');
      });
    }
  }

  openNewExperienceModal() {
    this.isEditing = false;
    this.currentExperience = { id: null, company: '', role: '', period: '', description: '' };
    this.showExperienceModal = true;
  }

  openEditExperienceModal(exp: any) {
    this.isEditing = true;
    this.currentExperience = { ...exp };
    this.showExperienceModal = true;
  }

  saveExperience() {
    if (this.isEditing) {
      this.portfolioService.updateExperience(this.currentExperience.id, this.currentExperience).subscribe(() => {
        alert('Experiência atualizada!');
        this.closeModals();
        this.loadExperiences();
      });
    } else {
      this.portfolioService.createExperience(this.currentExperience).subscribe(() => {
        alert('Experiência criada!');
        this.closeModals();
        this.loadExperiences();
      });
    }
  }

  deleteExperience(id: number) {
    if(confirm('Tem certeza que deseja excluir esta experiência?')) {
      this.portfolioService.deleteExperience(id).subscribe(() => {
        this.loadExperiences();
        alert('Experiência apagada!');
      });
    }
  }

  closeModals() {
    this.showProjectModal = false;
    this.showExperienceModal = false;
  }
  
  resetProjectForm() {
    this.currentProject = {
      title: '', description: '', tech_stack: '', image_url: '', repo_url: '', live_url: '', order: 0
    };
  }

  logout() {
    this.authService.logout();
  }
}