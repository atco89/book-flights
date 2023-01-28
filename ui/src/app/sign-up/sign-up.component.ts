import {Component, OnInit} from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {HttpClient} from "@angular/common/http";
import {User} from "../../models/User";
import Swal from 'sweetalert2'

@Component({
  selector: 'app-sign-up',
  templateUrl: './sign-up.component.html',
  styleUrls: ['./sign-up.component.css']
})
export class SignUpComponent implements OnInit {
  form!: FormGroup;
  submitted = false;

  constructor(
    private formBuilder: FormBuilder,
    private http: HttpClient,
  ) {

  }

  ngOnInit(): void {
    this.form = this.formBuilder.group({
      'name': ['', [Validators.required, Validators.maxLength(255)]],
      'surname': ['', [Validators.required, Validators.maxLength(255)]],
      'birth_date': ['', [Validators.required, Validators.maxLength(255)]],
      'passport_number': ['', [Validators.required, Validators.maxLength(255)]],
      'phone': ['', [Validators.required, Validators.maxLength(255)]],
      'email': ['', [Validators.required, Validators.maxLength(255), Validators.email]],
      'password': ['', [Validators.required, Validators.minLength(4)]],
    });
  }

  onSubmit(): void {
    this.submitted = true;
    if (this.form.invalid) {
      return;
    }

    this.http.post<User>('http://localhost:8888/api/sign-up', this.form.value).subscribe(
      (user: User) => Swal.fire('You have successfully created an Flight World account. ' +
        'Please check your email in order to activate your account.', '', 'success'),
      error => Swal.fire('Some error occur, please try again!', '', 'error'),
      () => this.form.reset(),
    );
  }
}
