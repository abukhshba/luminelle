<?php

declare(strict_types=1);

use App\Enums\PaymentStatus;
use App\Models\Payment;
use App\Models\Supplier;
use App\Models\SupplierBill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->supplier = Supplier::create([
        'name' => 'Test Supplier',
        'is_active' => true,
    ]);
});

it('calculates paid amount as zero when no payments', function () {
    $bill = SupplierBill::create([
        'bill_number' => 'BILL-001',
        'supplier_id' => $this->supplier->id,
        'total_amount' => 50000,
        'bill_date' => now()->toDateString(),
        'created_by' => $this->user->id,
    ]);

    expect($bill->paidAmount())->toBe(0.0);
});

it('calculates paid amount from linked payments', function () {
    $bill = SupplierBill::create([
        'bill_number' => 'BILL-001',
        'supplier_id' => $this->supplier->id,
        'total_amount' => 50000,
        'bill_date' => now()->toDateString(),
        'created_by' => $this->user->id,
    ]);

    Payment::create([
        'supplier_bill_id' => $bill->id,
        'amount' => 10000,
        'date' => now()->toDateString(),
        'payment_direction' => 'out',
        'payment_method' => 'cash',
        'created_by' => $this->user->id,
    ]);

    Payment::create([
        'supplier_bill_id' => $bill->id,
        'amount' => 15000,
        'date' => now()->toDateString(),
        'payment_direction' => 'out',
        'payment_method' => 'cash',
        'created_by' => $this->user->id,
    ]);

    expect($bill->paidAmount())->toBe(25000.0);
});

it('calculates remaining amount', function () {
    $bill = SupplierBill::create([
        'bill_number' => 'BILL-001',
        'supplier_id' => $this->supplier->id,
        'total_amount' => 50000,
        'bill_date' => now()->toDateString(),
        'created_by' => $this->user->id,
    ]);

    Payment::create([
        'supplier_bill_id' => $bill->id,
        'amount' => 30000,
        'date' => now()->toDateString(),
        'payment_direction' => 'out',
        'payment_method' => 'cash',
        'created_by' => $this->user->id,
    ]);

    expect($bill->remainingAmount())->toBe(20000.0);
});

it('returns not_paid status when no payments', function () {
    $bill = SupplierBill::create([
        'bill_number' => 'BILL-001',
        'supplier_id' => $this->supplier->id,
        'total_amount' => 50000,
        'bill_date' => now()->toDateString(),
        'created_by' => $this->user->id,
    ]);

    expect($bill->paymentStatus())->toBe(PaymentStatus::NotPaid);
});

it('returns partially_paid status when some payments exist', function () {
    $bill = SupplierBill::create([
        'bill_number' => 'BILL-001',
        'supplier_id' => $this->supplier->id,
        'total_amount' => 50000,
        'bill_date' => now()->toDateString(),
        'created_by' => $this->user->id,
    ]);

    Payment::create([
        'supplier_bill_id' => $bill->id,
        'amount' => 30000,
        'date' => now()->toDateString(),
        'payment_direction' => 'out',
        'payment_method' => 'cash',
        'created_by' => $this->user->id,
    ]);

    expect($bill->paymentStatus())->toBe(PaymentStatus::PartiallyPaid);
});

it('returns paid status when fully paid', function () {
    $bill = SupplierBill::create([
        'bill_number' => 'BILL-001',
        'supplier_id' => $this->supplier->id,
        'total_amount' => 50000,
        'bill_date' => now()->toDateString(),
        'created_by' => $this->user->id,
    ]);

    Payment::create([
        'supplier_bill_id' => $bill->id,
        'amount' => 50000,
        'date' => now()->toDateString(),
        'payment_direction' => 'out',
        'payment_method' => 'cash',
        'created_by' => $this->user->id,
    ]);

    expect($bill->paymentStatus())->toBe(PaymentStatus::Paid);
});
