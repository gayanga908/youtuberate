import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map'
import { tokenNotExpired } from 'angular2-jwt';
import { AuthHttp } from 'angular2-jwt';

@Injectable()
export class BookmarkService {

    constructor(private http: Http, public authHttp: AuthHttp) {

    }

    bookmark(video) {
        let currentUser = JSON.parse(localStorage.getItem('currentUser'));
        if (currentUser && currentUser.id_token) {
            let headers = new Headers({ 'Authorization': currentUser.id_token });
            return this.http.post('http://localhost/pronw3/server/index.php/videos/', video, {headers: headers}).map((response: Response) => response.json());
        }

    }

    getBookmarks(){
        let currentUser = JSON.parse(localStorage.getItem('currentUser'));
        if (currentUser && currentUser.id_token) {
            let headers = new Headers({ 'Authorization': currentUser.id_token });
            return this.http.get('http://localhost/pronw3/server/index.php/user/', {headers: headers}).map((response: Response) => response.json());
        }
    }

}
