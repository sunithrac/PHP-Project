import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AppointmentService } from '../../core/services/appointment-history.service';

@Component({
  selector: 'app-appointment',
  templateUrl: './appointment-history.component.html',
  styleUrls: ['./appointment-history.component.scss']
})
export class AppointmentHistoryComponent {

  public doctor: any;
  date = '';
  time = '';
  history: any[] = [];

  constructor(
    private appointmentService: AppointmentService,
    private router: Router
  ) {
    this.doctor = history.state.doctor;
    this.loadHistory();
  }

  book() {
    const payload = {
      doctor_id: this.doctor.id,
      date: this.date,
      time: this.time
    };

    this.appointmentService.booking(payload).subscribe(() => {
      alert('Appointment booked');
      this.loadHistory();
    });
  }

  loadHistory() {
    this.appointmentService.history().subscribe((res: any) => {
      this.history = res;
    });
  }

  cancel(id: number) {
    this.appointmentService.cancel(id).subscribe(() => {
      alert('Appointment cancelled');
      this.loadHistory();
    });
  }

}
