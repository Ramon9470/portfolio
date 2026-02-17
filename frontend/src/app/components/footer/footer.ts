import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PortfolioService } from '../../services/portfolio';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-footer',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './footer.html',
  styleUrl: './footer.css'
})
export class Footer implements OnInit {
  personalInfo$!: Observable<any>;

  constructor(private portfolio: PortfolioService) {}

  ngOnInit(): void {
    this.personalInfo$ = this.portfolio.getPersonalInfos();
  }

  sendToWhatsapp(name: string, message: string, phone: string) {
    if (!name || !message) {
      alert('Por favor, preencha seu nome e mensagem!');
      return;
    }
    const cleanPhone = phone.replace(/\D/g, ''); 
    
    const text = `Olá! Meu nome é *${name}*. ${message}`;
    
    const url = `https://wa.me/${cleanPhone}?text=${encodeURIComponent(text)}`;
    
    window.open(url, '_blank');
  }
}