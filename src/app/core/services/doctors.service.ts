import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/environment/environment';

@Injectable({ providedIn: 'root' })
export class DoctorService {
  constructor(private http: HttpClient) {}

  getDoctors() {
    console.log('11', `${environment.apiURL}`)
    return this.http.get(`${environment.apiURL}doctors`);
  }
}

