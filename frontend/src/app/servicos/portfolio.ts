import { Injectable, Inject, PLATFORM_ID } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, Subject, tap } from 'rxjs';
import { isPlatformBrowser } from '@angular/common';

@Injectable({
  providedIn: 'root'
})
export class Portfolio {
  private apiUrl = 'http://localhost:8081/api/v1';

  private _refreshNeeded$ = new Subject<void>();

  get refreshNeeded$() {
    return this._refreshNeeded$.asObservable();
  }

  constructor(
    private http: HttpClient,
    @Inject(PLATFORM_ID) private platformId: Object
  ) { }

  private getPublicHeaders() {
    return new HttpHeaders({
      'Cache-Control': 'no-cache, no-store, must-revalidate',
      'Pragma': 'no-cache'
    });
  }

  private getAuthHeaders() {
    let token = '';
    if (isPlatformBrowser(this.platformId)) {
      token = localStorage.getItem('auth_token') || '';
    }
    
    return new HttpHeaders({
      'Authorization': `Bearer ${token}`,
      'Content-Type': 'application/json'
    });
  }

  getPersonalInfos(): Observable<any> {
    return this.http.get(`${this.apiUrl}/me`, { headers: this.getPublicHeaders() });
  }

  getProjects(): Observable<any> {
    return this.http.get(`${this.apiUrl}/projects`, { headers: this.getPublicHeaders() });
  }

  getCourses(): Observable<any> {
    return this.http.get(`${this.apiUrl}/courses`, { headers: this.getPublicHeaders() });
  }

  getExperiences(): Observable<any[]> {
    return this.http.get<any[]>(`${this.apiUrl}/experiences`, { headers: this.getPublicHeaders() });
  }

  createProject(projectData: any) {
    let headers = this.getAuthHeaders();
    
    if (projectData instanceof FormData) {
      headers = headers.delete('Content-Type');
    }

    return this.http.post(`${this.apiUrl}/projects`, projectData, { headers })
      .pipe(tap(() => this._refreshNeeded$.next()));
  }

  updateProject(id: number, projectData: any) {
    let headers = this.getAuthHeaders();
    
    if (projectData instanceof FormData) {
      headers = headers.delete('Content-Type');
    }

    return this.http.post(`${this.apiUrl}/projects/${id}?_method=PUT`, projectData, { headers })
      .pipe(tap(() => this._refreshNeeded$.next()));
  }

  deleteProject(id: number) {
    return this.http.delete(`${this.apiUrl}/projects/${id}`, { headers: this.getAuthHeaders() })
      .pipe(tap(() => this._refreshNeeded$.next()));
  }

  createExperience(expData: any) {
    return this.http.post(`${this.apiUrl}/experiences`, expData, { headers: this.getAuthHeaders() })
      .pipe(tap(() => this._refreshNeeded$.next()));
  }

  updateExperience(id: number, expData: any) {
    return this.http.put(`${this.apiUrl}/experiences/${id}`, expData, { headers: this.getAuthHeaders() })
      .pipe(tap(() => this._refreshNeeded$.next()));
  }

  deleteExperience(id: number) {
    return this.http.delete(`${this.apiUrl}/experiences/${id}`, { headers: this.getAuthHeaders() })
      .pipe(tap(() => this._refreshNeeded$.next()));
  }

  createCourse(courseData: any) {
    let headers = this.getAuthHeaders();
    
    if (courseData instanceof FormData) {
      headers = headers.delete('Content-Type');
    }

    return this.http.post(`${this.apiUrl}/courses`, courseData, { headers })
      .pipe(tap(() => this['_refreshNeeded$'].next()));
  }

  updateCourse(id: number, courseData: any) {
    let headers = this.getAuthHeaders();
    
    if (courseData instanceof FormData) {
      headers = headers.delete('Content-Type');
    }

    return this.http.post(`${this.apiUrl}/courses/${id}?_method=PUT`, courseData, { headers })
      .pipe(tap(() => this['_refreshNeeded$'].next()));
  }

  deleteCourse(id: number) {
    return this.http.delete(`${this.apiUrl}/courses/${id}`, { headers: this.getAuthHeaders() })
      .pipe(tap(() => this['_refreshNeeded$'].next()));
  }

  updatePersonalInfos(infoData: any) {

    let headers = this.getAuthHeaders();

    if (infoData instanceof FormData) {
      headers = headers.delete('Content-Type');
      return this.http.post(`${this.apiUrl}/me?_method=PUT`, infoData, { headers })
        .pipe(tap(() => this._refreshNeeded$.next()));
    }

    return this.http.put(`${this.apiUrl}/me`, infoData, { headers: this.getAuthHeaders() })
      .pipe(tap(() => this._refreshNeeded$.next()));
  }
}