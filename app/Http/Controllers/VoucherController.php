<?php

namespace App\Http\Controllers;

use App\Http\Services\VoucherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function __construct(private readonly VoucherService $voucherService)
    {
    }

    public function generate(Request $request): JsonResponse
    {
        $voucher = $this->voucherService->create($request->input('discount'));

        return new JsonResponse(['code' => $voucher->voucher_code]);
    }
}
