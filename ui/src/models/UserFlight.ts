import {Ticket} from "./Ticket";
import {FlightStatus} from "./FlightStatus";
import {User} from "./User";

export interface UserFlight {
  uid: string,
  user: User,
  ticket: Ticket,
  flight_status: FlightStatus,
  rate: number | null,
  comment: string | null,
}
