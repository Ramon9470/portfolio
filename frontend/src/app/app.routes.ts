import { Routes } from '@angular/router';
import { Login } from './pages/login/login';
import { Home } from './pages/home/home';
import { Admin } from './pages/admin/admin';
import { authGuard } from './guards/auth-guard';

export const routes: Routes = [
    { path: '', component: Home },
    { path: 'portal-login-secreto', component: Login },
    { path: 'painel-admin-ramon', component: Admin, canActivate: [authGuard] },
    { path: 'login', redirectTo: '', pathMatch: 'full' },
    { path: 'admin', redirectTo: '', pathMatch: 'full' },
    { path: 'dashboard', redirectTo: '', pathMatch: 'full' },

    { path: '**', redirectTo: '' }
];