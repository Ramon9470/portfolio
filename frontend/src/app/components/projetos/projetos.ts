import { Component, OnInit, OnDestroy, Inject, PLATFORM_ID, ChangeDetectorRef } from '@angular/core';
import { CommonModule, isPlatformBrowser } from '@angular/common';
import { Portfolio } from '../../servicos/portfolio';
import { Subscription } from 'rxjs';

@Component({
  selector: 'app-projetos',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './projetos.html',
  styleUrl: './projetos.css'
})
export class Projetos implements OnInit, OnDestroy {
  projects: any[] = [];
  isBrowser: boolean;
  private refreshSubscription: Subscription | null = null;

  constructor(
    private portfolio: Portfolio,
    private cdr: ChangeDetectorRef,
    @Inject(PLATFORM_ID) platformId: Object
  ) {
    this.isBrowser = isPlatformBrowser(platformId);
  }

  ngOnInit() {
    if (this.isBrowser) {
      this.loadProjects();
      this.refreshSubscription = this.portfolio.refreshNeeded$.subscribe(() => {
        this.loadProjects();
      });
    }
  }

  ngOnDestroy() {
    if (this.refreshSubscription) {
      this.refreshSubscription.unsubscribe();
    }
  }

  loadProjects() {
    this.portfolio.getProjects().subscribe({
      next: (data) => {
        this.projects = data;
        this.cdr.markForCheck();
        this.cdr.detectChanges();
      },
      error: (err) => {
        console.error('Erro ao buscar projetos:', err);
        this.projects = [];
      }
    });
  }
}