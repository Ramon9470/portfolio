import { Component, OnInit, Inject, PLATFORM_ID, ChangeDetectorRef } from '@angular/core';
import { CommonModule, isPlatformBrowser } from '@angular/common';
import { Portfolio } from '../../servicos/portfolio';
import { Navbar } from '../../components/navbar/navbar';
import { Inicio } from '../../components/inicio/inicio';
import { Tecnologias } from '../../components/tecnologias/tecnologias';
import { Projetos } from '../../components/projetos/projetos';
import { Cursos } from '../../components/cursos/cursos';
import { Footer } from '../../components/footer/footer';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [CommonModule, Navbar, Inicio, Tecnologias, Projetos, Cursos, Footer],
  templateUrl: './home.html',
  styleUrl: './home.css'
})
export class Home implements OnInit {
  isBrowser: boolean;
  personalInfo: any = null;

  constructor(
    private portfolio: Portfolio,
    private cdr: ChangeDetectorRef,
    @Inject(PLATFORM_ID) platformId: Object
  ) {
    this.isBrowser = isPlatformBrowser(platformId);
  }

  ngOnInit() {
    if (this.isBrowser) {
      this.loadData();
      this.portfolio.refreshNeeded$.subscribe({
        next: () => {
          this.loadData();
        }
      });
    }
  }

  loadData() {
    this.portfolio.getPersonalInfos().subscribe({
      next: (data) => {
        this.personalInfo = data;
        this.cdr.detectChanges();
      },
      error: (err) => {
        console.warn('API offline ou sem dados...', err);
        this.personalInfo = { nome_completo: 'Ramon Ferreira', titulo: 'Desenvolvedor' };
        this.cdr.detectChanges();
      }
    });
  }
}