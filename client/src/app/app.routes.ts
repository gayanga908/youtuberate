import { Routes } from '@angular/router';
import { HomeComponent } from './home';
import { AboutComponent } from './about';
import { NoContentComponent } from './no-content';
import { SearchVideos } from './search/search.component';
import { LoginComponent } from './login/login.component'
import { LogoutComponent } from './logout/logout.component';
import { DataResolver } from './app.resolver';
import { AuthGuard } from './_services/auth-guard.service';
import { ProfileComponent } from './profile/profile.component';
import { RegisterComponent } from './register/register.component';

export const ROUTES: Routes = [
  { path: '',      component:  SearchVideos},
  { path: 'home',  component: HomeComponent },
  { path: 'search', component: SearchVideos },
  { path: 'register', component: RegisterComponent },

  { path: 'login', component: LoginComponent },
  { path: 'logout', component: LogoutComponent },
  { path: 'profile', component: ProfileComponent, canActivate: [AuthGuard] },
  { path: 'detail', loadChildren: './+detail#DetailModule', canActivate: [AuthGuard]},
  { path: 'barrel', loadChildren: './+barrel#BarrelModule'},
  { path: '**',    component: NoContentComponent },

];
