import { Routes } from '@angular/router';
import { Home } from './paginas/home/home';
import { Login } from './paginas/login/login';
import { Admin } from './paginas/admin/admin';
import { autenticacaoGuard } from './guarda/autenticacao-guard';

export const routes: Routes = [
  { path: '', component: Home },
  { path: 'login', component: Login },
  { 
    path: 'admin', 
    component: Admin, 
    canActivate: [autenticacaoGuard]
  },
  { path: '**', redirectTo: '' }
];