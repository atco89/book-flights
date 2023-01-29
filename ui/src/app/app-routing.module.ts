import {NgModule} from '@angular/core';
import {RouterModule, Routes} from '@angular/router';
import {SignUpComponent} from "./sign-up/sign-up.component";
import {SignInComponent} from "./sign-in/sign-in.component";
import {MainComponentComponent} from "./main-component/main-component.component";
import {AccountActivationComponent} from "./account-activation/account-activation.component";
import {FlightDetailsComponent} from "./flight-details/flight-details.component";
import {BookConfirmedComponent} from "./book-confirmed/book-confirmed.component";

const routes: Routes = [
  {path: "sign-up", component: SignUpComponent},
  {path: "sign-in", component: SignInComponent},
  {path: "", component: MainComponentComponent},
  {path: "account-activation", component: AccountActivationComponent},
  {path: "flight/:flightUid", component: FlightDetailsComponent},
  {path: "flight/:flightTicketUid/booked", component: BookConfirmedComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule {
}
