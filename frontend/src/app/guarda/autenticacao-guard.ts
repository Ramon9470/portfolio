import { CanActivateFn, Router } from '@angular/router';
import { inject, PLATFORM_ID } from '@angular/core';
import { Autenticacao } from '../servicos/autenticacao';
import { isPlatformBrowser } from '@angular/common';

export const autenticacaoGuard: CanActivateFn = (route, state) => {
  const autenticacao = inject(Autenticacao);
  const router = inject(Router);
  const platformId = inject(PLATFORM_ID);

  if (!isPlatformBrowser(platformId)){
    return true;
  }

  if (autenticacao.isLoggedIn()) {
    return true;
  }

  router.navigate(['/login']); 
  return false;
};