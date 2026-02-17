import { Component, OnInit, Inject, PLATFORM_ID, ChangeDetectorRef } from '@angular/core';
import { CommonModule, isPlatformBrowser } from '@angular/common';
import { PortfolioService } from '../../services/portfolio';

import { Navbar } from '../../components/navbar/navbar';
import { Hero } from '../../components/hero/hero';
import { TechStack } from '../../components/tech-stack/tech-stack';
import { Projects } from '../../components/projects/projects';
import { Courses } from '../../components/courses/courses';
import { Footer} from '../../components/footer/footer';

@Component({
  selector: 'app-home',
  standalone: true,
  imports: [
    CommonModule,
    Navbar,
    Hero,
    TechStack,
    Projects,
    Courses,
    Footer
  ],
  templateUrl: './home.html',
  styleUrl: './home.css'
})
export class Home implements OnInit {
  isBrowser: boolean;
  
  personalInfo: any = null;

  constructor(
    private portfolioService: PortfolioService,
    private cdr: ChangeDetectorRef,
    @Inject(PLATFORM_ID) platformId: Object
  ) {
    this.isBrowser = isPlatformBrowser(platformId);
  }

  ngOnInit() {
    if (this.isBrowser) {
      setTimeout(() => {
        this.loadData();
      }, 100);
    }
  }

  loadData() {
    this.portfolioService.getPersonalInfos().subscribe({
      next: (data) => {
        this.personalInfo = data;
        this.cdr.detectChanges();
      },
      error: () => console.warn('Aguardando dados pessoais...')
    });
  }
}