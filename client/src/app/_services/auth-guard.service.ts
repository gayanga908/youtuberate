import { Injectable } from '@angular/core';
import {Router, CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, ActivatedRoute} from '@angular/router';
import {JwtHelper} from "angular2-jwt"
declare var swal: any;

@Injectable()
export class AuthGuard implements CanActivate {
    returnUrl: string;
    jwtHelper: JwtHelper = new JwtHelper();
    loggedIn : boolean = false;
    constructor(private route: ActivatedRoute, private router: Router) {
        this.returnUrl = this.route.snapshot.queryParams['returnUrl'] || '/';
    }

    ngOnInit() {


    }

    canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {
        let user = JSON.parse(localStorage.getItem("currentUser"));
        // let token = user.id_token;

        if (localStorage.getItem('currentUser') && (user.id_token) && !(this.jwtHelper.isTokenExpired(user.id_token))) {
            // logged in so return true
            this.loggedIn = true;
            return true;
        } else {
            // not logged in so redirect to login page with the return url
            swal("Error", "User Access Token is expired. Please Sign in again", "error");
            this.router.navigate(['/login'], {queryParams: {returnUrl: state.url}});
            return false;
        }


    }
}