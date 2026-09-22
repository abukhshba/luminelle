<?php

declare(strict_types=1);

use App\Enums\ReservationStatus;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Dress;
use App\Models\Reservation;
use App\Models\ReservationItem;
use App\Models\User;
use App\Services\DressAvailabilityService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->service = new DressAvailabilityService;
    $this->user = User::factory()->create();
    $this->customer = Customer::create([
        'name' => 'Test Customer',
        'phone' => '0500000000',
    ]);
    $category = Category::create([
        'name' => 'Evening Gowns',
        'slug' => 'evening-gowns',
    ]);
    $this->dress = Dress::create([
        'code' => 'DR-001',
        'title' => 'Test Dress',
        'category_id' => $category->id,
        'rental_price' => 1500,
    ]);
});

it('returns true when no reservations exist for dress', function () {
    expect($this->service->isAvailable($this->dress->id, '2026-10-01', '2026-10-05'))->toBeTrue();
});

it('returns false when dates exactly overlap an existing reservation', function () {
    $reservation = Reservation::create([
        'customer_id' => $this->customer->id,
        'reservation_date' => '2026-09-28',
        'delivery_date' => '2026-10-01',
        'return_date' => '2026-10-05',
        'subtotal' => 1500,
        'total_amount' => 1500,
        'status' => ReservationStatus::Confirmed->value,
        'created_by' => $this->user->id,
    ]);

    ReservationItem::create([
        'reservation_id' => $reservation->id,
        'dress_id' => $this->dress->id,
        'price' => 1500,
        'total' => 1500,
    ]);

    expect($this->service->isAvailable($this->dress->id, '2026-10-01', '2026-10-05'))->toBeFalse();
});

it('returns false when dates partially overlap an existing reservation', function () {
    $reservation = Reservation::create([
        'customer_id' => $this->customer->id,
        'reservation_date' => '2026-09-28',
        'delivery_date' => '2026-10-03',
        'return_date' => '2026-10-10',
        'subtotal' => 1500,
        'total_amount' => 1500,
        'status' => ReservationStatus::Confirmed->value,
        'created_by' => $this->user->id,
    ]);

    ReservationItem::create([
        'reservation_id' => $reservation->id,
        'dress_id' => $this->dress->id,
        'price' => 1500,
        'total' => 1500,
    ]);

    expect($this->service->isAvailable($this->dress->id, '2026-10-01', '2026-10-05'))->toBeFalse();
});

it('returns true when a cancelled reservation overlaps the dates', function () {
    $reservation = Reservation::create([
        'customer_id' => $this->customer->id,
        'reservation_date' => '2026-09-28',
        'delivery_date' => '2026-10-01',
        'return_date' => '2026-10-05',
        'subtotal' => 1500,
        'total_amount' => 1500,
        'status' => ReservationStatus::Cancelled->value,
        'created_by' => $this->user->id,
    ]);

    ReservationItem::create([
        'reservation_id' => $reservation->id,
        'dress_id' => $this->dress->id,
        'price' => 1500,
        'total' => 1500,
    ]);

    expect($this->service->isAvailable($this->dress->id, '2026-10-01', '2026-10-05'))->toBeTrue();
});

it('returns true when excluded reservation is the only conflict', function () {
    $reservation = Reservation::create([
        'customer_id' => $this->customer->id,
        'reservation_date' => '2026-09-28',
        'delivery_date' => '2026-10-01',
        'return_date' => '2026-10-05',
        'subtotal' => 1500,
        'total_amount' => 1500,
        'status' => ReservationStatus::Confirmed->value,
        'created_by' => $this->user->id,
    ]);

    ReservationItem::create([
        'reservation_id' => $reservation->id,
        'dress_id' => $this->dress->id,
        'price' => 1500,
        'total' => 1500,
    ]);

    expect($this->service->isAvailable($this->dress->id, '2026-10-01', '2026-10-05', $reservation->id))->toBeTrue();
});

it('returns true for non-overlapping adjacent dates', function () {
    $reservation = Reservation::create([
        'customer_id' => $this->customer->id,
        'reservation_date' => '2026-09-28',
        'delivery_date' => '2026-10-01',
        'return_date' => '2026-10-05',
        'subtotal' => 1500,
        'total_amount' => 1500,
        'status' => ReservationStatus::Confirmed->value,
        'created_by' => $this->user->id,
    ]);

    ReservationItem::create([
        'reservation_id' => $reservation->id,
        'dress_id' => $this->dress->id,
        'price' => 1500,
        'total' => 1500,
    ]);

    expect($this->service->isAvailable($this->dress->id, '2026-10-06', '2026-10-10'))->toBeTrue();
});
