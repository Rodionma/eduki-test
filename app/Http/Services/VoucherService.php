<?php

namespace App\Http\Services;

use App\Http\Repositories\VoucherRepository;
use App\Models\Voucher;

class VoucherService
{
    public function __construct(private readonly VoucherRepository $voucherRepository)
    {
    }

    public function create(int $discount): Voucher
    {
        $voucher = new Voucher();
        $voucher->discount = $discount;
        $voucher->voucher_code = str()->random(7);

        $this->voucherRepository->save($voucher);

        return $voucher;
    }
}
