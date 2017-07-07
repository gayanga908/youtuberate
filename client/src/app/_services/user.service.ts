/**
 * Created by Tharindu Gayanga on 3/6/2017.
 */

import {Injectable} from "@angular/core";
import { User } from '../_models/user';
import { Http, Headers, RequestOptions, Response } from '@angular/http';

@Injectable()
export class UserService {
    constructor(private http: Http) { }

    create(user: User) {
        return this.http.post('http://localhost/pronw3/server/index.php/user/', user).map((response: Response) => response.json());
    }
    private jwt() {
        // create authorization header with jwt token
        let currentUser = JSON.parse(localStorage.getItem('currentUser'));
        if (currentUser && currentUser.id_token) {
            let headers = new Headers({ 'Authorization': 'Bearer ' + currentUser.id_token });
            return new RequestOptions({ headers: headers });
        }
    }
}
