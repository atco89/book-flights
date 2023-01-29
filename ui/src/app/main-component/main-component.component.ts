import {Component, OnInit} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {Airport} from "../../models/Airport";
import {Flight} from "../../models/Flight";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {environment} from '../../environments/environment';

@Component({
  selector: 'app-main-component',
  templateUrl: './main-component.component.html',
  styleUrls: ['./main-component.component.css']
})
export class MainComponentComponent implements OnInit {
  airports = new Array<Airport>();
  flights = new Array<Flight>();
  form!: FormGroup;
  currentDateTime = new Date();

  constructor(
    private http: HttpClient,
    private formBuilder: FormBuilder,
  ) {
    this.form = this.formBuilder.group({
      'departure': ['', [Validators.required]],
      'arrival': ['', [Validators.required]],
      'departureDate': ['', [Validators.required]],
    });
  }

  ngOnInit(): void {
    this.http.get<Array<Airport>>(`${environment.apiUrl}/airport`)
      .subscribe(airports => this.airports = airports);
  }

  onSearch(): void {
    let values = this.form.value;

    let departure = values['departure'];
    let arrival = values['arrival'];

    this.http.get<Array<Flight>>(`${environment.apiUrl}/flight?departure=${departure}&arrival=${arrival}`)
      .subscribe(flights => this.flights = flights);
  }
}
