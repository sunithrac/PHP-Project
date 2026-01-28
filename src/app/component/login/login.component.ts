import { CommonModule } from '@angular/common';
import { provideHttpClient, withInterceptors } from '@angular/common/http';
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { AuthInterceptor } from 'src/app/core/interceptors/auth.interceptor';

import { AuthService } from 'src/app/core/services/auth.service';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './login.component.html'
})

export class LoginComponent {
  public email: string = '';
  public password: string = '';

  constructor(private auth: AuthService) {}

  public login() {
    this.auth.login({ email: this.email, password: this.password })
      .subscribe((res: any) => {
        console.log('res', res)
        this.auth.saveToken(res.token);
        alert('Login successful');
      });
  }
}

