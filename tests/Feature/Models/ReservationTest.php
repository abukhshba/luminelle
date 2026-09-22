<?php

declare(strict_types=1);

use App\Enums\DiscountType;
use App\Enums\PaymentDirection;
use App\Enums\ReservationStatus;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentCategory;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->customer = Customer::create([
        'name' => 'Test Customer',
        'phone' => '0500000000',
    ]);
    $this->reservationPaymentCategory = PaymentCategory::create([
        'name' => 'Reservation Payment',
        'direction' => PaymentDirection::In,
    ]);
    $this->insuranceDepositCategory = PaymentCategory::create([
        'name' => 'Insurance Deposit',
        'direction' => PaymentDirection::In,
    ]);
    $this->insuranceRefundCategory = PaymentCategory::create([
        'name' => 'Insurance Refund',
        'direction' => PaymentDirection::Out,
    ]);
});

it('calculates total with fixed discount', function () {
    $total = Reservation::calculateTotal(10000.0, DiscountType::Fixed, 1000.0);
    expect($total)->toBe(9000.0);
});

it('calculates total with percentage discount', function () {
    $total = Reservation::calculateTotal(10000.0, DiscountType::Percentage, 10.0);
    expect($total)->toBe(9000.0);
});

it('does not allow negative totals', function () {
    $total = Reservation::calculateTotal(1000.0, DiscountType::Fixed, 2000.0);
    expect($total)->toBe(0.0);
});

it('calculates paid amount from rental payments only', function () {
    $reservation = Reservation::create([
        'customer_id' => $this->customer->id,
        'reservation_date' => now()->toDateString(),
        'delivery_date' => now()->addDay()->toDateString(),
        'return_date' => now()->addDays(3)->toDateString(),
        'subtotal' => 10000,
        'total_amount' => 10000,
        'status' => ReservationStatus::Pending,
        'created_by' => $this->user->id,
    ]);

    Payment::create([
        'reservation_id' => $reservation->id,
        'amount' => 2000,
        'date' => now()->toDateString(),
        'payment_direction' => PaymentDirection::In,
        'payment_method' => 'cash',
        'payment_category_id' => $this->reservationPaymentCategory->id,
        'created_by' => $this->user->id,
    ]);

    Payment::create([
        'reservation_id' => $reservation->id,
        'amount' => 500,
        'date' => now()->toDateString(),
        'payment_direction' => PaymentDirection::In,
        'payment_method' => 'cash',
        'payment_category_id' => $this->insuranceDepositCategory->id,
        'created_by' => $this->user->id,
    ]);

    expect($reservation->paidAmount())->toBe(2000.0);
});

it('calculates remaining amount correctly', function () {
    $reservation = Reservation::create([
        'customer_id' => $this->customer->id,
        'reservation_date' => now()->toDateString(),
        'delivery_date' => now()->addDay()->toDateString(),
        'return_date' => now()->addDays(3)->toDateString(),
        'subtotal' => 10000,
        'total_amount' => 10000,
        'status' => ReservationStatus::Pending,
        'created_by' => $this->user->id,
    ]);

    Payment::create([
        'reservation_id' => $reservation->id,
        'amount' => 3000,
        'date' => now()->toDateString(),
        'payment_direction' => PaymentDirection::In,
        'payment_method' => 'cash',
        'payment_category_id' => $this->reservationPaymentCategory->id,
        'created_by' => $this->user->id,
    ]);

    expect($reservation->remainingAmount())->toBe(7000.0);
});

it('tracks insurance collected separately', function () {
    $reservation = Reservation::create([
        'customer_id' => $this->customer->id,
        'reservation_date' => now()->toDateString(),
        'delivery_date' => now()->addDay()->toDateString(),
        'return_date' => now()->addDays(3)->toDateString(),
        'subtotal' => 10000,
        'total_amount' => 10000,
        'status' => ReservationStatus::Pending,
        'created_by' => $this->user->id,
    ]);

    Payment::create([
        'reservation_id' => $reservation->id,
        'amount' => 500,
        'date' => now()->toDateString(),
        'payment_direction' => PaymentDirection::In,
        'payment_method' => 'cash',
        'payment_category_id' => $this->insuranceDepositCategory->id,
        'created_by' => $this->user->id,
    ]);

    expect($reservation->insuranceCollected())->toBe(500.0);
    expect($reservation->insuranceBalance())->toBe(500.0);
});

it('calculates insurance balance after refund', function () {
    $reservation = Reservation::create([
        'customer_id' => $this->customer->id,
        'reservation_date' => now()->toDateString(),
        'delivery_date' => now()->addDay()->toDateString(),
        'return_date' => now()->addDays(3)->toDateString(),
        'subtotal' => 10000,
        'total_amount' => 10000,
        'status' => ReservationStatus::Pending,
        'created_by' => $this->user->id,
    ]);

    Payment::create([
        'reservation_id' => $reservation->id,
        'amount' => 500,
        'date' => now()->toDateString(),
        'payment_direction' => PaymentDirection::In,
        'payment_method' => 'cash',
        'payment_category_id' => $this->insuranceDepositCategory->id,
        'created_by' => $this->user->id,
    ]);

    Payment::create([
        'reservation_id' => $reservation->id,
        'amount' => 500,
        'date' => now()->toDateString(),
        'payment_direction' => PaymentDirection::Out,
        'payment_method' => 'cash',
        'payment_category_id' => $this->insuranceRefundCategory->id,
        'created_by' => $this->user->id,
    ]);

    expect($reservation->insuranceBalance())->toBe(0.0);
});
