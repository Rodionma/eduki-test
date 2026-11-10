<?php

namespace App\Http\Services;

use App\Http\Repositories\VoucherRepository;

class ItemService
{
    public function __construct(public VoucherRepository $voucherRepository)
    {
    }

    public function apply(array $items): array
    {
        $voucher = $this->voucherRepository->getByCode($items['code']);

        if (!$voucher) {
            return $items;
        }

        $total = array_sum(array_column($items['items'], 'price'));

        $discount = min($voucher->discount, $total);

        if ($total <= 0) {
            $discount = 0;
        }

        $shares = [];
        $remainders = [];
        $distributedDiscount = 0;

        foreach ($items['items'] as $index => $item) {
            $numerator = $item['price'] * $discount;

            $share = $total > 0
                ? intdiv($numerator, $total)
                : 0;

            $remainder = $total > 0
                ? $numerator % $total
                : 0;

            $shares[$index] = $share;
            $distributedDiscount += $share;

            $remainders[] = [
                'index' => $index,
                'remainder' => $remainder,
            ];
        }

        // Сортуємо за найбільшою остачею.
        usort($remainders, function ($a, $b) {
            return $b['remainder'] <=> $a['remainder'];
        });

        $remaining = $discount - $distributedDiscount;

        for ($i = 0; $i < $remaining; $i++) {
            $index = $remainders[$i]['index'];
            $shares[$index]++;
        }

        $itemsResult = [
            'code' => $items['code'],
            'items' => [],
        ];

        foreach ($items['items'] as $index => $item) {
            $item['price_with_discount'] =
                $item['price'] - $shares[$index];

            $itemsResult['items'][] = $item;
        }

        return $itemsResult;
    }


}
