import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/core/services/auth.service';
import { AppointmentService } from '../../core/services/appointment-history.service';
import { DoctorService } from '../../core/services/doctors.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent {
  user: any;
  doctors: any[] = [];

  booking = {
    doctor_id: '',
    date: '',
    time: ''
  };

  constructor(
    private auth: AuthService,
    private doctorService: DoctorService,
    private appointmentService: AppointmentService,
    private router: Router
  ) {
    this.user = this.auth.getUser();
    this.loadDoctors();
  }

  loadDoctors() {
    this.doctorService.getDoctors()
      .subscribe((res: any) => this.doctors = res);
  }

  book() {
    this.appointmentService.booking(this.booking)
      .subscribe(() => alert('Appointment booked successfully'));
  }

  goToHistory() {
    this.router.navigate(['/appointment-history']);
  }
}
