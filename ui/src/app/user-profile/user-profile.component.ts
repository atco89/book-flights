import {Component, OnInit} from '@angular/core';
import {User} from "../../models/User";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {environment} from "../../environments/environment";

const headers = new HttpHeaders({
  'Authorization': `Bearer ${localStorage.getItem('token')}`,
});

@Component({
  selector: 'app-user-profile',
  templateUrl: './user-profile.component.html',
  styleUrls: ['./user-profile.component.css']
})
export class UserProfileComponent implements OnInit {
  user!: User;

  constructor(
    private http: HttpClient,
  ) {

  }

  ngOnInit(): void {
    this.http.get<User>(`${environment.apiUrl}/profile`, {headers: headers})
      .subscribe((user: User): User => this.user = user);
  }
}
