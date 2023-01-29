export interface User {
  uid: string,
  name: string,
  surname: string,
  birth_date: Date,
  passport_number: string,
  phone: string,
  email: string,
  password: string | null,
}
