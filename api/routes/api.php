<?php

use App\Http\Controllers\AddFlightToFavouritesController;
use App\Http\Controllers\BookFlightController;
use App\Http\Controllers\DeleteFavouriteFlightController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\FetchAllAirports;
use App\Http\Controllers\FetchAllBookedFlightsController;
use App\Http\Controllers\FetchAllFavouriteFlightsController;
use App\Http\Controllers\FetchAllFlightsController;
use App\Http\Controllers\FetchBookedFlightController;
use App\Http\Controllers\FetchFlightController;
use App\Http\Controllers\FetchProfileController;
use App\Http\Controllers\ModifyBookedFlightController;
use App\Http\Controllers\ModifyProfileController;
use App\Http\Controllers\SignInController;
use App\Http\Controllers\SignOutController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

Route::post('sign-up', SignUpController::class)->name('sign.up');
Route::post('sign-in', SignInController::class)->name('sign.in');
Route::post('sign-out', SignOutController::class)->name('sign.out');

Route::group(['prefix' => 'account-activation',], function (): void {
    Route::group(['prefix' => '{activationCode}',], function (): void {
        Route::get('', EmailVerificationController::class)->name('account.activation');
    });
});

Route::group(['prefix' => 'airport',], function (): void {
    Route::get('', FetchAllAirports::class)->name('fetch.all.airports');
});

Route::group(['prefix' => 'flight',], function (): void {
    Route::get('', FetchAllFlightsController::class)->name('fetch.all.flights');
    Route::group(['prefix' => '{flightUid}',], function (): void {
        Route::get('', FetchFlightController::class)->name('fetch.flight');
    });
});

Route::group(['prefix' => 'book',], function (): void {
    Route::get('', FetchAllBookedFlightsController::class)->name('fetch.all.booked.flights');
    Route::group(['prefix' => '{flightTicketUid}',], function (): void {
        Route::post('', BookFlightController::class)->name('book.flight');
        Route::patch('', ModifyBookedFlightController::class)->name('modify.booked.flight');
        Route::get('', FetchBookedFlightController::class)->name('fetch.booked.flight');
    });
});

Route::group(['prefix' => 'profile',], function (): void {
    Route::get('', FetchProfileController::class)->name('fetch.profile');
    Route::patch('', ModifyProfileController::class)->name('modify.profile');
});

Route::group(['prefix' => 'favourite',], function (): void {
    Route::get('', FetchAllFavouriteFlightsController::class)->name('fetch.all.favourite.flights');
    Route::group(['prefix' => '{flightTicketUid}',], function (): void {
        Route::post('', AddFlightToFavouritesController::class)->name('add.flight.to.favourites');
        Route::delete('', DeleteFavouriteFlightController::class)->name('add.flight.to.favourites');
    });
});
