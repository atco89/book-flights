import {Component, OnInit} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {User} from "../../models/User";

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.css']
})
export class SignUpComponent implements OnInit {

  constructor(
    private http: HttpClient,
  ) {

  }

  ngOnInit(): void {

  }

  onSubmit(user: User): void {
    this.http.post<User>('http://localhost:8888/api/sign-up', user)
      .subscribe(data => console.log(data));
  }
}
