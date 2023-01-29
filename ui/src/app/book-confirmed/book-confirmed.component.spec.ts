import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BookConfirmedComponent } from './book-confirmed.component';

describe('BookConfirmedComponent', () => {
  let component: BookConfirmedComponent;
  let fixture: ComponentFixture<BookConfirmedComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BookConfirmedComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(BookConfirmedComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
