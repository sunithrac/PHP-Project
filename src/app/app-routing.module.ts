import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthGuard } from './core/guards/auth.guard';

const routes: Routes = [
  {
    path: 'login',
    loadComponent: () =>
      import('./component/login/login.component')
        .then(c => c.LoginComponent)
  },
  {
    path: 'register',
    loadComponent: () =>
      import('./component/register/register.component')
        .then(c => c.RegisterComponent)
  },
  {
    path: 'appointment-history',
    canActivate: [AuthGuard],
    loadChildren: () =>
      import('./component/appointment-history/appointment-history.module')
      .then(m => m.AppointmentModule)
  },
  {
    path: 'doctors',
    canActivate: [AuthGuard],
    loadChildren: () =>
      import('./component/doctors/doctors.module')
      .then(m => m.DoctorsModule)
  },
  {
    path: 'dashboard',
    canActivate: [AuthGuard],
    loadChildren: () =>
      import('./component/dashboard/dashboard.module')
        .then(c => c.DashboardModule)
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {}
