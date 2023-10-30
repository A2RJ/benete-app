<?php

namespace App\Charts;

use App\Models\Keuangan\KeuBendaharaPenerimaan;
use App\Models\Keuangan\KeuBendaharaPengeluaran;
use App\Models\Keuangan\KeuDisposisi;
use App\Models\Keuangan\KeuKuasaPenggunaAnggaran;
use App\Models\Keuangan\KeuPejabatPengadaan;
use App\Models\Keuangan\KeuPpk;
use App\Models\Keuangan\KeuSuratKeluar;
use App\Models\Keuangan\KeuSuratMasuk;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class MonthlyKeuanganChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $year = date('Y');
        $bendaharaPenerimaan = KeuBendaharaPenerimaan::query()->whereYear('created_at', $year)->statistics();
        $bendaharaPengeluaran = KeuBendaharaPengeluaran::query()->whereYear('created_at', $year)->statistics();
        $kuasaPenggunaAnggaran = KeuKuasaPenggunaAnggaran::query()->whereYear('created_at', $year)->statistics();
        $pejabatPengadaan = KeuPejabatPengadaan::query()->whereYear('created_at', $year)->statistics();
        $ppk = KeuPpk::query()->whereYear('created_at', $year)->statistics();
        $suratKeluar = KeuSuratKeluar::query()->whereYear('created_at', $year)->statistics();
        $suratMasuk = KeuSuratMasuk::query()->whereYear('created_at', $year)->statistics();
        $disposisi = KeuDisposisi::query()->whereYear('created_at', $year)->statistics();
        return $this->chart->lineChart()
            ->setTitle("Bidang Keuangan")
            ->setSubtitle("Statistik data bidang keuangan tahun $year")
            ->addData('Bendahara Penerimaan', array_values($bendaharaPenerimaan))
            ->addData('Bendahara Pengeluaran', array_values($bendaharaPengeluaran))
            ->addData('Kuasa Pengguna Anggaran', array_values($kuasaPenggunaAnggaran))
            ->addData('Pejabat Pengadaan', array_values($pejabatPengadaan))
            ->addData('Pejabat Pembuat Komitmen', array_values($ppk))
            ->addData('Surat Keluar', array_values($suratKeluar))
            ->addData('Surat Masuk', array_values($suratMasuk))
            ->addData('Disposisi', array_values($disposisi))
            ->setXAxis(array_keys($bendaharaPenerimaan));
    }
}
