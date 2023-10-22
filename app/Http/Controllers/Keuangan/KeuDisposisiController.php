<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Http\Requests\DisposisiRequest;
use App\Models\Keuangan\KeuDisposisi;
use App\Models\Keuangan\KeuSuratMasuk;

/**
 * Class KeuDisposisiController
 * @package App\Http\Controllers
 */
class KeuDisposisiController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(KeuSuratMasuk $keuSuratMasuk)
    {
        $keuDisposisi = new KeuDisposisi();
        $keuDisposisi->keu_surat_masuk_id = $keuSuratMasuk->id;
        return view('Keuangan.disposisi.create', compact('keuDisposisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DisposisiRequest $request, KeuSuratMasuk $keuSuratMasuk)
    {
        $payload = $request->validated();
        $keuSuratMasuk->disposisi()->create($payload);

        return redirect()->route('keu-surat-masuk.index')
            ->with('success', 'KeuDisposisi created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($keuSuratMasuk, KeuDisposisi $keuDisposisi)
    {
        $keuDisposisi = $keuDisposisi->where('keu_surat_masuk_id', $keuSuratMasuk)->firstOrFail();
        return view('Keuangan.disposisi.edit', compact('keuDisposisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuDisposisi $keuDisposisi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DisposisiRequest $request, $keuSuratMasuk, KeuDisposisi $keuDisposisi)
    {
        $payload = $request->validated();
        $keuDisposisi->where('keu_surat_masuk_id', $keuSuratMasuk)->update($payload);

        return redirect()->route('keu-surat-masuk.index')
            ->with('success', 'KeuDisposisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KeuSuratMasuk $keuSuratMasuk)
    {
        $keuSuratMasuk->disposisi()->delete();

        return redirect()->route('keu-surat-masuk.index')
            ->with('success', 'KeuDisposisi deleted successfully');
    }
}
