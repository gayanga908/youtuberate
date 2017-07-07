import {OnInit, Component} from "@angular/core";
import {Router} from "@angular/router";

/**
 * Created by Tharindu Gayanga on 3/17/2017.
 */
@Component({
    template:` <img class="loading-img" src="https://cdn.edureka.co/imgver.1488378393/img/loader.gif" />`
})
export class LogoutComponent implements OnInit{
    constructor(public router: Router) {

    }

    ngOnInit() {
        localStorage.removeItem('currentUser');
        this.router.navigate(['/login']);



    }
}
