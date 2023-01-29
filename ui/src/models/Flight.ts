import {Airline} from "./Airline";
import {Aircraft} from "./Aircraft";
import {Airport} from "./Airport";
import {Ticket} from "./Ticket";

export interface Flight {
  uid: string,
  flight_iata: string,
  flight_number: string,
  dep_time: string,
  arr_time: string,
  duration: string,
  airline: Airline,
  aircraft: Aircraft,
  departure_airport: Airport,
  arrival_airport: Airport,
  tickets: Array<Ticket>,
}
