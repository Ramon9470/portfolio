import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-tecnologias',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './tecnologias.html',
  styleUrl: './tecnologias.css'
})
export class Tecnologias {
  technologies = [
    { name: 'PHP', icon: 'devicon-php-plain', color: '#60a5fa' },
    { name: 'Laravel', icon: 'devicon-laravel-original', color: '#ef4444' },
    { name: 'Angular', icon: 'devicon-angularjs-plain', color: '#dc2626' },
    { name: 'HTML5', icon: 'devicon-html5-plain', color: '#f97316' },
    { name: 'CSS3', icon: 'devicon-css3-plain', color: '#3b82f6' },
    { name: 'JavaScript', icon: 'devicon-javascript-plain', color: '#facc15' },
    { name: 'Python', icon: 'devicon-python-plain', color: '#fde047' },
    { name: 'C#', icon: 'devicon-csharp-plain', color: '#a855f7' },
    { name: 'Bootstrap', icon: 'devicon-bootstrap-plain', color: '#9333ea' },
    { name: 'Tailwind', icon: 'devicon-tailwindcss-original', color: '#22d3ee' },
    { name: 'Sass', icon: 'devicon-sass-original', color: '#f472b6' },
    { name: 'Docker', icon: 'devicon-docker-plain', color: '#60a5fa' },
    { name: 'MySQL', icon: 'devicon-mysql-plain', color: '#93c5fd' },
    { name: 'PostgreSQL', icon: 'devicon-postgresql-plain', color: '#60a5fa' },
    { name: 'SQL Server', icon: 'devicon-microsoftsqlserver-plain', color: '#f87171' },
    { name: 'Figma', icon: 'devicon-figma-plain', color: '#F24E1E' }
  ];
}