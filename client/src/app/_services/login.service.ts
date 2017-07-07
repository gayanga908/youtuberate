/**
 * Created by Tharindu Gayanga on 3/1/2017.
 */

import { Injectable } from '@angular/core';
import { Http, Headers, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map'
import { tokenNotExpired } from 'angular2-jwt';

@Injectable()
export class LoginService {
    constructor(private http: Http) { }

    login(username: string, password: string) {
        return this.http.post('http://localhost/pronw3/server/index.php/auth/', JSON.stringify({ username: username, password: password }))
            .map(res => res.json());

            // });
    }
    loggedIn() {
        return tokenNotExpired();
    }


}