import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-tech-stack',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './tech-stack.html',
  styleUrl: './tech-stack.css'
})
export class TechStack {
  technologies = [
    { name: 'PHP', icon: 'devicon-php-plain', color: 'text-blue-400' },
    { name: 'Laravel', icon: 'devicon-laravel-original', color: 'text-red-500' },
    { name: 'Angular', icon: 'devicon-angularjs-plain', color: 'text-red-600' },
    { name: 'HTML5', icon: 'devicon-html5-plain', color: 'text-orange-500' },
    { name: 'CSS3', icon: 'devicon-css3-plain', color: 'text-blue-500' },
    { name: 'JavaScript', icon: 'devicon-javascript-plain', color: 'text-yellow-400' },
    { name: 'Python', icon: 'devicon-python-plain', color: 'text-yellow-300' },
    { name: 'C#', icon: 'devicon-csharp-plain', color: 'text-purple-500' },
    { name: 'Bootstrap', icon: 'devicon-bootstrap-plain', color: 'text-purple-600' },
    { name: 'Tailwind', icon: 'devicon-tailwindcss-original', color: 'text-cyan-400' },
    { name: 'Sass', icon: 'devicon-sass-original', color: 'text-pink-400' },
    { name: 'Docker', icon: 'devicon-docker-plain', color: 'text-blue-400' },
    { name: 'MySQL', icon: 'devicon-mysql-plain', color: 'text-blue-300' },
    { name: 'PostgreSQL', icon: 'devicon-postgresql-plain', color: 'text-blue-400' },
    { name: 'SQL Server', icon: 'devicon-microsoftsqlserver-plain', color: 'text-red-400' },
    {
      "name": "Figma",
      "icon": "devicon-figma-plain",
      "color": "text-[#F24E1E]"
    }
  ];
}