import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Autenticacao } from '../../servicos/autenticacao';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './login.html',
  styleUrl: './login.css'
})
export class Login {
  email = '';
  password = '';
  isLoading = false;
  errorMessage = '';

  constructor(private autenticacao: Autenticacao, private router: Router) {}

  onSubmit() {
    if (!this.email || !this.password) {
      this.errorMessage = 'Por favor, preencha todos os campos.';
      return;
    }

    this.isLoading = true;
    this.errorMessage = '';

    this.autenticacao.login({ email: this.email, password: this.password }).subscribe({
      next: (res) => {
        this.isLoading = false;
        localStorage.setItem('token', res.token); 
        this.router.navigate(['/admin']); 
      },
      error: (err) => {
        this.isLoading = false;
        if (err.status === 401) {
          this.errorMessage = 'Email ou senha incorretos.';
        } else {
          this.errorMessage = 'Servidor offline. Tente novamente mais tarde.';
        }
      }
    });
  }
}