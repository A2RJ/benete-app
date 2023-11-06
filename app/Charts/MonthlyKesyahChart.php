<?php

namespace App\Charts;

use App\Models\Dokumentasi;
use App\Models\Kesyahbandaran\KesyabandaranModel;
use App\Models\Kesyahbandaran\KesyaDisposisi;
use App\Models\Kesyahbandaran\KesyaDokumenAwakKapal;
use App\Models\Kesyahbandaran\KesyaDokumenKapal;
use App\Models\Kesyahbandaran\KesyaPatroli;
use App\Models\Kesyahbandaran\KesyaSuratKeluar;
use App\Models\Kesyahbandaran\KesyaSuratMasuk;
use App\Models\Kesyahbandaran\KesyaTertibBanar;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyKesyahChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $year = date('Y');
        $dokumenAwakKapal = KesyaDokumenAwakKapal::query()->whereYear('created_at', $year)->statistics();
        $dokumenKapal = KesyaDokumenKapal::query()->whereYear('created_at', $year)->statistics();
        $kesyah = KesyabandaranModel::query()->whereYear('created_at', $year)->statistics();
        $patroli = KesyaPatroli::query()->whereYear('created_at', $year)->statistics();
        $suratKeluar = KesyaSuratKeluar::query()->whereYear('created_at', $year)->statistics();
        $suratMasuk = KesyaSuratMasuk::query()->whereYear('created_at', $year)->statistics();
        $disposisi = KesyaDisposisi::query()->whereYear('created_at', $year)->statistics();
        $tertib = KesyaTertibBanar::query()->whereYear('created_at', $year)->statistics();
        $dokumentasi = Dokumentasi::query()->role()->whereYear('created_at', $year)->statistics();
        
        return $this->chart->lineChart()
            ->setTitle("Bidang kesyahbandaran")
            ->setSubtitle("Statistik bidang kesyahbandaran tahun $year.")
            ->addData('Dokumen awak kapal', array_values($dokumenAwakKapal))
            ->addData('Dokumen Kapal', array_values($dokumenKapal))
            ->addData('Kesyahbandaran', array_values($kesyah))
            ->addData('Patroli', array_values($patroli))
            ->addData('Surat Keluar', array_values($suratKeluar))
            ->addData('Surat Masuk', array_values($suratMasuk))
            ->addData('Disposisi', array_values($disposisi))
            ->addData('Tertib Banar', array_values($tertib))
            ->addData('Dokumentasi', array_values($dokumentasi))
            ->setXAxis(array_keys($dokumenAwakKapal));
    }
}
