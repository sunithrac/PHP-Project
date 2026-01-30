import { CommonModule } from '@angular/common';
import { provideHttpClient, withInterceptors } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormsModule, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthInterceptor } from 'src/app/core/interceptors/auth.interceptor';

import { AuthService } from 'src/app/core/services/auth.service';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './login.component.html'
})

export class LoginComponent implements OnInit{
  public email: string = '';
  public password: string = '';
  public loginForm: any;

  constructor(private auth: AuthService, private router: Router, private fb: FormBuilder) {}

  ngOnInit() {
    this.loginForm = this.fb.group({
      email: [
        '',
        [
          Validators.required,
          Validators.email
        ]
      ],
      password: [
        '',
        [
          Validators.required,
          Validators.minLength(8),
          Validators.pattern(/^(?=.*[A-Z])(?=.*\d).+$/)
        ]
      ]
    });
  }

  public login() {
    if (this.loginForm.invalid) {
      this.loginForm.markAllAsTouched();
      return;
    } else {
      this.loginSubmit()
    }
  }

  private loginSubmit() {
    this.auth.login({ email: this.email, password: this.password })
      .subscribe((res: any) => {
        this.auth.saveToken(res.token);
        alert('Login successful');
        this.router.navigate(['/dashboard']);
      });
  }
}

