import {TravelClass} from "./TravelClass";
import {Flight} from "./Flight";

export interface Ticket {
  uid: string,
  capacity: number,
  price: number,
  flight: Flight | null,
  travel_class: Array<TravelClass>,
}
