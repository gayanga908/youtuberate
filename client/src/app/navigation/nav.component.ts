import {Component, OnChanges, NgZone, ChangeDetectorRef} from "@angular/core";

/**
 * Created by Tharindu Gayanga on 3/16/2017.
 */

@Component({

    selector: "nav",
    template:`

<div class="navbar ">
  <div class="container-fluid">
  <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active">
        <a [routerLink]=" ['../search'] "
        routerLinkActive="active" [routerLinkActiveOptions]= "{exact: true}">
        Search Videos
        </a> 
        </li>
        <li> 
        <ng-container *ngIf="!curr">
      <a [routerLink]=" ['../login'] "
        routerLinkActive="active" [routerLinkActiveOptions]= "{exact: true}">
        Sign-in
      </a>
      </ng-container>
      </li>
      <ng-container *ngIf="curr">
        <li>
        <a [routerLink]=" ['../logout'] "
        routerLinkActive="active" [routerLinkActiveOptions]= "{exact: true}">
        Sign-out
      </a>
</li>
        <li>
        <a [routerLink]=" ['../profile'] "
        routerLinkActive="active" [routerLinkActiveOptions]= "{exact: true}">
        Bookmarks
      </a>
      </li>
      </ng-container>
        </ul>
        </div>
  </div>
  </div>
  <!--<a [routerLink]=" ['./'] "-->
        <!--routerLinkActive="active" [routerLinkActiveOptions]= "{exact: true}">-->
        <!--Index-->
      <!--</a>-->
      <!--<a [routerLink]=" ['../home'] "-->
        <!--routerLinkActive="active" [routerLinkActiveOptions]= "{exact: true}">-->
        <!--Home-->
      <!--</a>-->
      <!--<a [routerLink]=" ['./detail'] "-->
        <!--routerLinkActive="active" [routerLinkActiveOptions]= "{exact: true}">-->
        <!--Detail-->
      <!--</a>-->
      <!--<a [routerLink]=" ['./barrel'] "-->
        <!--routerLinkActive="active" [routerLinkActiveOptions]= "{exact: true}">-->
        <!--Barrel-->
      <!--</a>-->
      <!--<ng-container *ngIf="!curr">-->
      <!--<a [routerLink]=" ['../login'] "-->
        <!--routerLinkActive="active" [routerLinkActiveOptions]= "{exact: true}">-->
        <!--Login-->
      <!--</a>-->
      <!--</ng-container>-->
      <!--<a [routerLink]=" ['../search'] "-->
        <!--routerLinkActive="active" [routerLinkActiveOptions]= "{exact: true}">-->
        <!--Search Videos-->
      <!--</a> -->
      <!--<ng-container *ngIf="curr">-->
      <!--<a [routerLink]=" ['../logout'] "-->
        <!--routerLinkActive="active" [routerLinkActiveOptions]= "{exact: true}">-->
        <!--Logout-->
      <!--</a>-->


      <!--<a [routerLink]=" ['../profile'] "-->
        <!--routerLinkActive="active" [routerLinkActiveOptions]= "{exact: true}">-->
        <!--Bookmarks-->
      <!--</a>-->
      <!--</ng-container>-->
`
    // templateUrl: 'profile.component.html'
})

export class NavComponent   {
    public curr;
    constructor() {
        this.curr = localStorage.getItem('currentUser');


            // console.log('curr '+this.curr);



        // ref.detectChanges();
    }
    // ngOnChanges(): void {
    //     this.curr = localStorage.getItem('currentUser');
    // }
}
