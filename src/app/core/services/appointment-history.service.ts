import { HttpClient } from "@angular/common/http";
import { Injectable } from "@angular/core";
import { environment } from "src/environment/environment";

@Injectable({ providedIn: 'root' })
export class AppointmentService {
  constructor(private http: HttpClient) {}

  public booking(data: any) {
    return this.http.post(`${environment.apiURL}appointments/booking`, data);
  }

  public history() {
    return this.http.get(`${environment.apiURL}appointments/history`);
  }

  public cancel(id: number) {
    return this.http.post(`${environment.apiURL}appointments/cancel`, { id });
  }
}
