<?php

namespace App\Charts;

use App\Models\BMN\BmnBendaharaMateril;
use App\Models\BMN\BmnDisposisi;
use App\Models\BMN\BmnSmartUupBenete;
use App\Models\BMN\BmnSuratKeluar;
use App\Models\BMN\BmnSuratMasuk;
use App\Models\Dokumentasi;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyBmnChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $year = date('Y');
        $bendahara = BmnBendaharaMateril::query()->whereYear('created_at', $year)->statistics();
        $uup = BmnSmartUupBenete::query()->whereYear('created_at', $year)->statistics();
        $suratKeluar = BmnSuratKeluar::query()->whereYear('created_at', $year)->statistics();
        $suratMasuk = BmnSuratMasuk::query()->whereYear('created_at', $year)->statistics();
        $disposisi = BmnDisposisi::query()->whereYear('created_at', $year)->statistics();
        $dokumentasi = Dokumentasi::query()->role()->whereYear('created_at', $year)->statistics();
        
        return $this->chart->lineChart()
            ->setTitle("Bidang pengelola bmn dan persediaan")
            ->setSubtitle("Statistik bidang pengelola bmn dan persediaan tahun $year.")
            ->addData("Bendahara Materil", array_values($bendahara))
            ->addData("Smart UUP", array_values($uup))
            ->addData("Surat Keluar", array_values($suratKeluar))
            ->addData("Surat Masuk", array_values($suratMasuk))
            ->addData("Disposisi", array_values($disposisi))
            ->addData('Dokumentasi', array_values($dokumentasi))
            ->setXAxis(array_keys($bendahara));
    }
}
