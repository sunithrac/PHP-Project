import { Component, OnInit } from '@angular/core';
import { DoctorService } from '../../core/services/doctors.service';

@Component({
  selector: 'app-doctors',
  templateUrl: './doctors.component.html',
  styleUrls: ['./doctors.component.scss']
})
export class DoctorsComponent implements OnInit {
  doctors: any[] = [];

  constructor(private doctorService: DoctorService) {
  }

  ngOnInit() {
    this.doctorService.getDoctors().subscribe((res: any) => {
      this.doctors = res;
    });
  }
}
