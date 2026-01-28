import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from '../../../environment/environment';

@Injectable({ providedIn: 'root' })
export class AuthService {
  constructor(private http: HttpClient) {}

  public login(data: { email: string; password: string }) {
    return this.http.post(`${environment.apiURL}login`, data);
  }

  public saveToken(token: string) {
    localStorage.setItem('token', token);
  }

  public getToken() {
    return localStorage.getItem('token');
  }

  public logout() {
    localStorage.clear();
  }

  public isLoggedIn(): boolean {
    return !!this.getToken();
  }

  public getUser() {
    const token = localStorage.getItem('token');
    if (!token) return null;

    const userDetail = JSON.parse(atob(token.split('.')[1]));
    return userDetail;
}
}
