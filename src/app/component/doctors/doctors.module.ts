import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';
import { DoctorsComponent } from './doctors.component';

const routes: Routes = [
{ path: '', component: DoctorsComponent }
];

@NgModule({
  declarations: [DoctorsComponent],
  imports: [CommonModule, RouterModule.forChild(routes)],
})

export class DoctorsModule { 
  constructor() {
 }
}
