<?php

namespace App\Trait\Models;

trait UseStatistic
{
    public function scopeStatistics($query)
    {
        $data = $query->get();
        $statistics = array_fill_keys(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'], 0);

        foreach ($data as $dokumentasi) {
            $month = date('F', strtotime($dokumentasi->created_at));

            $statistics[$month] = $statistics[$month] ?? 0;
            $statistics[$month] += 1;
        }

        return $statistics;
    }
}
