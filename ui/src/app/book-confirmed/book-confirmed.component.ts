import {Component, OnInit} from '@angular/core';
import {UserFlight} from "../../models/UserFlight";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {environment} from '../../environments/environment';
import {ActivatedRoute} from "@angular/router";

@Component({
  selector: 'app-book-confirmed',
  templateUrl: './book-confirmed.component.html',
  styleUrls: ['./book-confirmed.component.css']
})
export class BookConfirmedComponent implements OnInit {
  currentDateTime = new Date();
  userFlight!: UserFlight;

  constructor(
    private http: HttpClient,
    private activatedRoute: ActivatedRoute,
  ) {
  }

  ngOnInit(): void {
    let flightTicketUid = this.activatedRoute.snapshot.paramMap.get('flightTicketUid');
    this.http.get<UserFlight>(`${environment.apiUrl}/book/${flightTicketUid}`, {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      }),
    }).subscribe((userFlight: UserFlight) => this.userFlight = userFlight);
  }
}
