/**
 * Created by Tharindu Gayanga on 3/5/2017.
 */
import { Component } from "@angular/core";
import { Router } from '@angular/router';

import { UserService } from '../_services/user.service';
declare var swal: any;
@Component({

    selector: "register",
    templateUrl: 'register.component.html'
})

export class RegisterComponent{

    model: any = {};
    loading = false;

    constructor(
        private router: Router,
        private userService: UserService) { }

    register() {
        this.loading = true;
        console.log(this.model);
        this.userService.create(this.model)
            .subscribe(
                data => {

                    if (!data.error){
                        this.loading = false;
                        swal("Success", "Registration successful", "success");
                        //  redirecting to the login page
                        this.router.navigate(['/login']);
                    } else {
                        this.loading = false;
                        swal("Error", data.error, "error");
                        this.router.navigate(['/login']);
                    }

                },
                error => {
                    swal("Error", error, "error");
                    this.loading = false;
                });
    }
}