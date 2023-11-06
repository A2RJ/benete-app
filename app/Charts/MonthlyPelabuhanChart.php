<?php

namespace App\Charts;

use App\Models\Dokumentasi;
use App\Models\Pelabuhan\PelabuhanDisposisi;
use App\Models\Pelabuhan\PelabuhanFasilitasPelabuhan;
use App\Models\Pelabuhan\PelabuhanJpt;
use App\Models\Pelabuhan\PelabuhanKeagenan;
use App\Models\Pelabuhan\PelabuhanLala;
use App\Models\Pelabuhan\PelabuhanPbm;
use App\Models\Pelabuhan\PelabuhanSuratKeluar;
use App\Models\Pelabuhan\PelabuhanSuratMasuk;
use App\Models\Pelabuhan\PelabuhanTkbm;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyPelabuhanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $year = date('Y');
        $disposisi = PelabuhanDisposisi::query()->whereYear('created_at', $year)->statistics();
        $fasilitasPelabuhan = PelabuhanFasilitasPelabuhan::query()->whereYear('created_at', $year)->statistics();
        $jpt = PelabuhanJpt::query()->whereYear('created_at', $year)->statistics();
        $keagenan = PelabuhanKeagenan::query()->whereYear('created_at', $year)->statistics();
        $lala = PelabuhanLala::query()->whereYear('created_at', $year)->statistics();
        $pbm = PelabuhanPbm::query()->whereYear('created_at', $year)->statistics();
        $tkbm = PelabuhanTkbm::query()->whereYear('created_at', $year)->statistics();
        $suratKeluar = PelabuhanSuratKeluar::query()->whereYear('created_at', $year)->statistics();
        $suratMasuk = PelabuhanSuratMasuk::query()->whereYear('created_at', $year)->statistics();
        $dokumentasi = Dokumentasi::query()->role()->whereYear('created_at', $year)->statistics();
        
        return $this->chart->lineChart()
            ->setTitle("Bidang kepelabuhan")
            ->setSubtitle("Statistik bidang kepelabuhan tahun $year")
            ->addData('Fasilitas Pelabuhan', array_values($fasilitasPelabuhan))
            ->addData('Keagenan', array_values($keagenan))
            ->addData('LALA', array_values($lala))
            ->addData('PBM', array_values($pbm))
            ->addData('JPT', array_values($jpt))
            ->addData('TKBM', array_values($tkbm))
            ->addData('Surat Keluar', array_values($suratKeluar))
            ->addData('Surat Masuk', array_values($suratMasuk))
            ->addData('Disposisi', array_values($disposisi))
            ->addData('Dokumentasi', array_values($dokumentasi))
            ->setXAxis(array_keys($disposisi));
    }
}
