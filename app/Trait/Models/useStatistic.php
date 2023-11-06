<?php

namespace App\Trait\Models;

use Illuminate\Support\Facades\Log;

trait UseStatistic
{
    public function scopeStatistics($query)
    {
        $data = $query->get();
        $statistics = array_fill_keys(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'], 0);

        foreach ($data as $dokumentasi) {
            $month = date('F', strtotime($dokumentasi->created_at));
            $statistics[$month] += 1;
        }

        Log::info(json_encode($statistics));
        return $statistics;
    }
}
