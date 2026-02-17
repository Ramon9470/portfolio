import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PortfolioService {
  private apiUrl = 'http://localhost:8081/api/v1';

  constructor(private http: HttpClient) { }

  private getHeaders() {
    return new HttpHeaders({
      'Cache-Control': 'no-cache, no-store, must-revalidate',
      'Pragma': 'no-cache',
      'Expires': '0'
    });
  }

  getPersonalInfos(): Observable<any> {
    return this.http.get(`${this.apiUrl}/me`, { headers: this.getHeaders() });
  }

  getProjects(): Observable<any> {
    return this.http.get(`${this.apiUrl}/projects`, { headers: this.getHeaders() });
  }

  getCourses(): Observable<any> {
    return this.http.get(`${this.apiUrl}/courses`, { headers: this.getHeaders() });
  }

  getExperiences() {
    return this.http.get<any[]>(`${this.apiUrl}/experiences`, { headers: this.getHeaders() });
  }

  deleteProject(id: number){
    return this.http.delete(`${this.apiUrl}/projects/${id}`);
  }

  createProject(projectData: any){
    return this.http.post(`${this.apiUrl}/projects`, projectData);
  }

  updateProject(id: number, projectData: any){
    return this.http.put(`${this.apiUrl}/projects/${id}`, projectData);
  }

  createExperience(expData: any) {
    return this.http.post(`${this.apiUrl}/experiences`, expData);
  }

  updateExperience(id: number, expData: any) {
    return this.http.put(`${this.apiUrl}/experiences/${id}`, expData);
  }

  deleteExperience(id: number) {
    return this.http.delete(`${this.apiUrl}/experiences/${id}`);
  }
}