/**
 * Created by Tharindu Gayanga on 2/11/2017.
 */
import { Component, OnInit } from '@angular/core';
import { SearchService } from "../_services/search.service";
import { ControlGroup } from "@angular/forms/di";
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { BookmarkService } from '../_services/bookmark.service';
import {JwtHelper} from "angular2-jwt"
import {Router} from "@angular/router";

declare var swal: any;

@Component({
    selector: "search",
    templateUrl: './search.component.html',
    providers: [SearchService],
    styleUrls: [ './search.component.css' ],
})
export class SearchVideos implements OnInit{
    ratedVideos: String;
    unratedVideos: String;
    order: string = 'score_und';
    loading = false;
    private curr;
    private btnName : string;
    jwtHelper: JwtHelper = new JwtHelper();
    searchForm:FormGroup;
    constructor(private _searchService: SearchService, private _formBuilder:FormBuilder, private bookmarkService: BookmarkService,  private router: Router,) {
        this.curr = localStorage.getItem('currentUser');
        if (this.curr){
            this.btnName = "logout";
        } else {
            this.btnName = "login";
        }
    }

    onSubmit(value) {
        this.loading = true;
        this._searchService.getSearchList(value)
            .subscribe(
                data => {
                    this.loading = false;
                    this.ratedVideos = data.rated;
                    this.unratedVideos = data.unrated;
                        },
                error => {
                    this.loading = false;
                    swal("Sorry!", "Something went wrong", "error");
                console.log(error);},
                () => console.log("video search successful")
            )

    }

    bookmarkVideo( video){
        let user = JSON.parse(localStorage.getItem("currentUser"));
         if ( !(this.jwtHelper.isTokenExpired(user.id_token))){
            this.bookmarkService.bookmark(video)
                .subscribe(
                    data => {
                        swal("Success", data.msg, "success");
                        console.log(data);
                    },
                    error => {
                        swal("Error", error, "error");
                        console.log(error);
                    },
                    () => console.log(this.jwtHelper.isTokenExpired(this.curr.id_token))
                );
        } else {
             swal("Error", "Authentication Token expired. please login again", "error");
            this.router.navigate(['/login']);
        }

    }

    ngOnInit():any{

        this.searchForm = this._formBuilder.group({
            'search_key': ['', Validators.required]
        })
    }
}
