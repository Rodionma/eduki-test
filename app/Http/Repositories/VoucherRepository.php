<?php

namespace App\Http\Repositories;

use App\Models\Voucher;

class VoucherRepository
{
    public function save(Voucher $voucher): void
    {
        $voucher->save();
    }

    public function getByCode(string $code): ?Voucher
    {
        return Voucher::where("voucher_code", $code)->first();
    }
}
