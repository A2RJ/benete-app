<?php

namespace App\Trait\Models;

trait UseSearch
{
    public function scopeUseSearch($query, $withType = false)
    {
        $search = request()->input('search', false);
        $startDate = request()->input('start_date', false);
        $endDate = request()->input('end_date', false);

        $query->when($search, function ($query, $search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('name', 'like', "%$search%")
                ->orWhere('tanggal_masuk', 'like', "%$search%")
                ->orWhere('asal', 'like', "%$search%")
                ->orWhere('perihal', 'like', "%$search%");
        });

        $query->when($withType, function ($query, $search) {
            $query->where('tipe', 'like', "%$search%");
        });

        $query->when($startDate, function ($query, $startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        });

        $query->when($endDate, function ($query, $endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        });
    }
}
