import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/core/services/auth.service';
import { AppointmentService } from '../../core/services/appointment-history.service';
import { DoctorService } from '../../core/services/doctors.service';
import { FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})
export class DashboardComponent {
  user: any;
  doctors: any[] = [];

  public bookingForm: any
  public today = new Date().toISOString().split('T')[0];

  constructor(
    private auth: AuthService,
    private doctorService: DoctorService,
    private appointmentService: AppointmentService,
    private router: Router,
    private fb: FormBuilder
  ) {
    this.user = this.auth.getUser();
    this.bookingForm = this.fb.group({
      doctor_id: ['', Validators.required],
      date: ['', Validators.required],
      time: ['', Validators.required],
      user_id: [this.user.user_id]
    });
    this.loadDoctors();
  }

  loadDoctors() {
    this.doctorService.getDoctors()
      .subscribe((res: any) => this.doctors = res);
  }

  book() {
      if (this.bookingForm.invalid) {
        this.bookingForm.markAllAsTouched();
        return;
      }

      const payload = this.bookingForm.value;

      this.appointmentService.booking(payload).subscribe({
        next: () => alert('Appointment booked'),
        error: err => alert(err.error.message)
      });
    }

  goToHistory() {
    this.router.navigate(['/appointment-history']);
  }
}
