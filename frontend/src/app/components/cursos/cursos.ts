import { Component, OnInit, Inject, PLATFORM_ID, ChangeDetectorRef } from '@angular/core';
import { CommonModule, isPlatformBrowser } from '@angular/common';
import { Portfolio} from '../../servicos/portfolio';

@Component({
  selector: 'app-cursos',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './cursos.html',
  styleUrl: './cursos.css'
})

export class Cursos implements OnInit {
  courses: any = null; 
  
  isBrowser: boolean;

  constructor(
    private portfolio: Portfolio,
    private cdr: ChangeDetectorRef,
    @Inject(PLATFORM_ID) platformId: Object
  ) {
    this.isBrowser = isPlatformBrowser(platformId);
  }

  ngOnInit() {
    if (this.isBrowser) {
      setTimeout(() => {
        this.loadCourses();
      }, 100);
    }
  }

  loadCourses() {
    this.portfolio.getCourses().subscribe({
      next: (data) => {
        this.courses = data;
        this.cdr.detectChanges();
      },
      error: (err) => {
        console.error('Erro ao buscar cursos.', err);
        this.courses = [];
        this.cdr.detectChanges();
      }
    });
  }
}