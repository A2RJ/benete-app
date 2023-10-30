<?php

namespace App\Trait\Models;

trait UseStatistic
{
    public function scopeStatistics()
    {
        $month = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $statistics = [];

        for ($i = 1; $i <= 12; $i++) {
            $statistics[$month[$i - 1]] = self::whereMonth('created_at', $i)->count();
        }

        return $statistics;
    }
}
