import {City} from "./City";

export interface Airport {
  uid: string,
  code: string,
  name: string,
  city: City,
}
