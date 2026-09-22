<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\ReservationStatus;
use App\Models\ReservationItem;

class DressAvailabilityService
{
    public function isAvailable(
        int $dressId,
        string $deliveryDate,
        string $returnDate,
        ?int $excludeReservationId = null
    ): bool {
        $query = ReservationItem::query()
            ->where('dress_id', $dressId)
            ->whereHas('reservation', function ($q) use ($deliveryDate, $returnDate, $excludeReservationId) {
                $q->whereNotIn('status', [ReservationStatus::Cancelled->value])
                    ->where('delivery_date', '<=', $returnDate)
                    ->where('return_date', '>=', $deliveryDate);

                if ($excludeReservationId !== null) {
                    $q->where('id', '!=', $excludeReservationId);
                }
            });

        return $query->doesntExist();
    }
}
