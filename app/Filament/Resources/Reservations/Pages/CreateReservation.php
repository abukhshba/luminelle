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

    public function mount(): void
    {
        parent::mount();

        if (request()->filled('dress_id')) {
            $dressId = (int) request('dress_id');
            $price = (float) request('price', 0);

            $this->form->fill([
                'items' => [[
                    'dress_id' => $dressId,
                    'price' => $price,
                    'discount' => 0,
                    'total' => $price,
                    'notes' => null,
                ]],
                'total_amount' => $price,
                'down_payment' => 0,
                'remaining_amount' => $price,
                'subtotal' => $price,
            ]);
        }
    }

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
