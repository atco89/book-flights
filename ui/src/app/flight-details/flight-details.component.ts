import {Component, OnInit} from '@angular/core';
import {Flight} from "../../models/Flight";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {ActivatedRoute, Router} from "@angular/router";
import {environment} from '../../environments/environment';
import {UserFlight} from "../../models/UserFlight";

@Component({
  selector: 'app-flight-details',
  templateUrl: './flight-details.component.html',
  styleUrls: ['./flight-details.component.css']
})
export class FlightDetailsComponent implements OnInit {
  flight!: Flight

  constructor(
    private http: HttpClient,
    private route: ActivatedRoute,
    private router: Router,
  ) {
  }

  ngOnInit(): void {
    let flightUid = this.route.snapshot.paramMap.get('flightUid');
    this.http.get<Flight>(`${environment.apiUrl}/flight/${flightUid}`)
      .subscribe(flight => this.flight = flight);
  }

  book(flightTicketUid: string | undefined): void {
    this.http.post<UserFlight>(`${environment.apiUrl}/book/${flightTicketUid}`, null, {
      headers: new HttpHeaders({
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      }),
    }).subscribe((userFlight: UserFlight) =>
      this.router.navigate(['/flight/', userFlight.ticket.uid, 'booked']));
  }
}
