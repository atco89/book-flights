import {Component, OnInit} from '@angular/core';
import {UserFlight} from "../../models/UserFlight";
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {environment} from '../../environments/environment';
import Swal, {SweetAlertResult} from 'sweetalert2'

const headers = new HttpHeaders({
  'Authorization': `Bearer ${localStorage.getItem('token')}`,
});

@Component({
  selector: 'app-bookings',
  templateUrl: './bookings.component.html',
  styleUrls: ['./bookings.component.css']
})
export class BookingsComponent implements OnInit {
  flights!: Array<UserFlight>;
  upcomingFlights!: Array<UserFlight>;
  completedFlights!: Array<UserFlight>;
  cancelledFlights!: Array<UserFlight>;

  constructor(
    private http: HttpClient,
  ) {

  }

  ngOnInit(): void {
    this.fetchUserFlights();
  }

  completeFlight(flightTicketUid: string | undefined): void {
    Swal.fire({
      title: `Confirmation`,
      text: `Are you sure you want to complete this flight?`,
      showDenyButton: true,
      confirmButtonText: `Yes`,
      denyButtonText: `No`,
    }).then((result: SweetAlertResult): void => {
      if (result.isConfirmed) {
        this.requestCompleteFlight(flightTicketUid);
      }
    });
  }

  cancelFlight(flightTicketUid: string | undefined): void {
    Swal.fire({
      title: `Confirmation`,
      text: `Are you sure you want to complete this flight?`,
      showDenyButton: true,
      confirmButtonText: `Yes`,
      denyButtonText: `No`,
    }).then((result: SweetAlertResult): void => {
      if (result.isConfirmed) {
        this.requestCancelFlight(flightTicketUid);
      }
    });
  }

  review(flightTicketUid: string | undefined): void {
    this.reviewMessage(flightTicketUid);
  }

  protected fetchUserFlights(): void {
    this.http.get<Array<UserFlight>>(`${environment.apiUrl}/book`, {headers: headers})
      .subscribe((flights: Array<UserFlight>): void => this.groupFlights(flights));
  }

  protected requestCompleteFlight(flightTicketUid: string | undefined): void {
    // noinspection JSDeprecatedSymbols
    this.http.patch<UserFlight>(`${environment.apiUrl}/book/${flightTicketUid}`, {
      flight_status_id: 2, // Completed.
    }, {
      headers: headers,
    }).subscribe((userFlight: UserFlight): void => this.successMessage(), (error: Error) => this.errorMessage());
  }

  protected successMessage(): void {
    Swal.fire({
      title: `Notification`,
      text: `You have successfully completed this operation.`,
      icon: `success`,
    }).then((result: SweetAlertResult): void => this.fetchUserFlights());
  }

  protected errorMessage(): void {
    Swal.fire({
      title: `Notification`,
      text: `Some error occur, please try again.`,
      icon: `error`,
    }).then((result: SweetAlertResult): void => console.log(result));
  }

  protected reviewMessage(flightTicketUid: string | undefined): void {
    Swal.fire({
      title: `Flight Review`,
      text: `In order to improve our service, please take a few minutes to give us your feedback.`,
      icon: `question`,
      input: 'textarea',
      inputLabel: 'Comment',
    }).then((result: SweetAlertResult): void => {
      if (result.isConfirmed) {
        // noinspection JSDeprecatedSymbols
        this.http.patch<UserFlight>(`${environment.apiUrl}/book/${flightTicketUid}`, {
          comment: result.value,
        }, {
          headers: headers,
        }).subscribe((userFlight: UserFlight): void => this.successMessage(), (error: Error) => this.errorMessage());
      }
    });
  }

  protected requestCancelFlight(flightTicketUid: string | undefined): void {
    // noinspection JSDeprecatedSymbols
    this.http.patch<UserFlight>(`${environment.apiUrl}/book/${flightTicketUid}`, {
      flight_status_id: 3, // Cancelled.
    }, {
      headers: headers,
    }).subscribe((userFlight: UserFlight): void => this.successMessage(), (error: Error) => this.errorMessage());
  }

  protected groupFlights(flights: Array<UserFlight>): void {
    this.upcomingFlights = flights.filter((flight: UserFlight) => flight.flight_status.name == 'Upcoming');
    this.completedFlights = flights.filter((flight: UserFlight) => flight.flight_status.name == 'Completed');
    this.cancelledFlights = flights.filter((flight: UserFlight) => flight.flight_status.name == 'Cancelled');
  }
}
