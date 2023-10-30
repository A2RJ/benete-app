<?php

namespace App\Charts;

use App\Models\TU\TuDisposisi;
use App\Models\TU\TuKontrakKerjaSama;
use App\Models\TU\TuSuratKeluar;
use App\Models\TU\TuSuratMasuk;
use App\Models\TU\TuSuratTugas;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyTUChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $year = date('Y');
        $disposisi = TuDisposisi::query()->whereYear('created_at', $year)->statistics();
        $kontrakKerjaSama = TuKontrakKerjaSama::query()->whereYear('created_at', $year)->statistics();
        $suratTugas = TuSuratTugas::query()->whereYear('created_at', $year)->statistics();
        $suratKeluar = TuSuratKeluar::query()->whereYear('created_at', $year)->statistics();
        $suratMasuk = TuSuratMasuk::query()->whereYear('created_at', $year)->statistics();
        return $this->chart->lineChart()
            ->setTitle("Bidang kepegawaian dan tata usaha ")
            ->setSubtitle("Statistik bidang kepegawaian dan tata usaha tahun $year")
            ->addData('Kontrak Kerja Sama', array_values($kontrakKerjaSama))
            ->addData('Surat Tugas', array_values($suratTugas))
            ->addData('Surat Keluar', array_values($suratKeluar))
            ->addData('Surat Masuk', array_values($suratMasuk))
            ->addData('Disposisi', array_values($disposisi))
            ->setXAxis(array_keys($disposisi));
    }
}
