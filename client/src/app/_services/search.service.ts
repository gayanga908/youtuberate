/**
 * Created by Tharindu Gayanga on 2/12/2017.
 */
import {Injectable} from "@angular/core"
import {Http} from "@angular/http";
import {URLSearchParams} from "@angular/http"
import 'rxjs/add/operator/map'

@Injectable()

export class SearchService{
    constructor(private _http: Http){}

    getSearchList(value){
        let params = new URLSearchParams();
        params.set('search_key', value);
        return this._http.get('http://localhost/pronw3/server/index.php/videos/' , { search: params })
            .map(res => res.json());

    }
}