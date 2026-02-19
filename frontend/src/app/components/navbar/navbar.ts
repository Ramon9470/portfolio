import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-navbar',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './navbar.html',
  styleUrl: './navbar.css'
})
export class Navbar {
  isMobileMenuOpen = false;
  showAboutModal = false;

  toggleMenu(){
    this.isMobileMenuOpen = !this.isMobileMenuOpen;
  }

  openAboutModal(event: Event) {
    event.preventDefault();
    this.showAboutModal = true;
    this.isMobileMenuOpen = false;
  }

  closeAboutModal() {
    this.showAboutModal = false;
  }
}