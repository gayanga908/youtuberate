/**
 * Created by Tharindu Gayanga on 2/28/2017.
 */

import { Component, OnInit } from "@angular/core";
import {Router, ActivatedRoute} from '@angular/router';
import {Http, Headers, RequestOptions, URLSearchParams} from '@angular/http';
import { LoginService } from '../_services/login.service';
declare var swal: any;

@Component({
    selector: "login",
    templateUrl: 'login.component.html',
    styleUrls: [ './login.component.css' ]
})



export class LoginComponent implements OnInit{
    username: String;
    returnUrl: string;

    constructor(private route: ActivatedRoute, public router: Router, public http: Http, private loginService: LoginService, ) {
        this.returnUrl = this.route.snapshot.queryParams['returnUrl'] || '/';

    }




    ngOnInit() {
    }
    login(event, username, password) {
        if (username && password) {
            this.loginService.login(username, password)
                .subscribe(
                    data => {
                        let user = data;

                        if (user.username) {
                            localStorage.setItem('currentUser', JSON.stringify(user));
                            this.router.navigate([this.returnUrl]);
                        } else {
                            swal("Error", user.error, "error");
                        }
                    },
                    error => {
                        swal("Error", error.text(), "error");
                        console.log(error.text());
                    }
                );
        }
    }

    logout() {
        // remove user from local storage to log user out
        localStorage.removeItem('currentUser');
        this.router.navigate(['/login']);
    }
}
