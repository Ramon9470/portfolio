import { HttpInterceptorFn } from '@angular/common/http';
import { inject } from '@angular/core';
import { Autenticacao } from '../servicos/autenticacao';

export const autenticacaoInterceptor: HttpInterceptorFn = (req, next) => {
  const autenticacao = inject(Autenticacao);
  const token = autenticacao.getToken();

  if (token) {
    const cloned = req.clone({
      setHeaders: {
        Authorization: `Bearer ${token}`
      }
    });
    return next(cloned);
  }
  
  return next(req);
};