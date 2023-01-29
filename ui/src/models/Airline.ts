import {Country} from "./Country";

export interface Airline {
  uid: string,
  code: string,
  name: string,
  image_path: string,
  country: Country,
}
