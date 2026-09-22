<?php

declare(strict_types=1);

namespace App\Filament\Resources\Reservations\Pages;

use App\Enums\PaymentDirection;
use App\Enums\PaymentMethod;
use App\Enums\PaymentState;
use App\Filament\Resources\Reservations\ReservationResource;
use App\Models\Payment;
use App\Models\PaymentCategory;
use Filament\Resources\Pages\CreateRecord;

class CreateReservation extends CreateRecord
{
    protected static string $resource = ReservationResource::class;

    private float $downPayment = 0;

    private float $insuranceAmount = 0;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->downPayment = (float) ($data['down_payment'] ?? 0);
        $this->insuranceAmount = (float) ($data['insurance_amount'] ?? 0);

        return $data;
    }

    protected function afterCreate(): void
    {
        $reservation = $this->getRecord();

        if ($this->downPayment > 0) {
            $rentalCategory = PaymentCategory::where('name', 'Reservation Payment')->first();

            Payment::create([
                'amount' => $this->downPayment,
                'date' => today(),
                'payment_direction' => PaymentDirection::In,
                'payment_method' => PaymentMethod::Cash,
                'status' => PaymentState::Draft,
                'payment_category_id' => $rentalCategory?->id,
                'reservation_id' => $reservation->id,
                'customer_id' => $reservation->customer_id,
                'created_by' => auth()->id(),
            ]);
        }

        if ($this->insuranceAmount > 0) {
            $insuranceCategory = PaymentCategory::where('name', 'Insurance Deposit')->first();

            Payment::create([
                'amount' => $this->insuranceAmount,
                'date' => today(),
                'payment_direction' => PaymentDirection::In,
                'payment_method' => PaymentMethod::Cash,
                'status' => PaymentState::Draft,
                'payment_category_id' => $insuranceCategory?->id,
                'reservation_id' => $reservation->id,
                'customer_id' => $reservation->customer_id,
                'created_by' => auth()->id(),
            ]);
        }
    }
}
