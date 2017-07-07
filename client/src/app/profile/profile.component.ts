/**
 * Created by Tharindu Gayanga on 3/4/2017.
 */
import {OnInit, Component} from "@angular/core";
import {JwtHelper} from "angular2-jwt"
import { tokenNotExpired } from 'angular2-jwt';
import { AuthGuard } from '../_services/auth-guard.service';
import { BookmarkService } from '../_services/bookmark.service';
declare var swal: any;
@Component({

    selector: "profile",
    templateUrl: 'profile.component.html'
})


export class ProfileComponent implements OnInit{
    public curr;
    private btnName : string;
    private bookmarks;
    constructor(private authGuard: AuthGuard, private bookmarkService: BookmarkService) {
        this.curr = localStorage.getItem('currentUser');
        this.displayUserBookmarks();
    }

    ngOnInit() {
        console.log(this.authGuard.loggedIn);
    }

    displayUserBookmarks(){
        this.bookmarkService.getBookmarks()
            .subscribe(
                data => {
                    this.bookmarks = data;
                    console.log(data);
                },
                error => {
                    swal("Error", error, "error");
                    console.log(error);},
                () => console.log("Load Profile page successful")
            )

    }


}