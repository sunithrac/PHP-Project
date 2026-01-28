import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AppointmentHistoryComponent } from './appointment-history.component';
import { Routes, RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';

const routes: Routes = [
{ path: '', component: AppointmentHistoryComponent }
];

@NgModule({
  declarations: [AppointmentHistoryComponent],
  imports: [CommonModule, RouterModule.forChild(routes), FormsModule],
  exports: [RouterModule]
})
export class AppointmentModule { }
