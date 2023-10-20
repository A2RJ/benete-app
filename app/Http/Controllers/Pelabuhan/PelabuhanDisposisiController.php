<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Http\Requests\DisposisiRequest;
use App\Models\Pelabuhan\PelabuhanDisposisi;
use App\Models\Pelabuhan\PelabuhanSuratMasuk;

/**
 * Class PelabuhanDisposisiController
 * @package App\Http\Controllers
 */
class PelabuhanDisposisiController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create($pelabuhanSuratmasuk)
    {
        $pelabuhanDisposisi = new PelabuhanDisposisi();
        $pelabuhanDisposisi->pelabuhan_surat_masuk_id = $pelabuhanSuratmasuk;
        return view('Pelabuhan.disposisi.create', compact('pelabuhanDisposisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DisposisiRequest $request, PelabuhanSuratMasuk $pelabuhanSuratMasuk)
    {
        $payload = $request->validated();
        $pelabuhanSuratMasuk->disposisi()->create($payload);

        return redirect()->route('pelabuhan-surat-masuk.index')
            ->with('success', 'PelabuhanDisposisi created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($pelabuhanSuratMasuk, PelabuhanDisposisi $pelabuhanDisposisi)
    {
        $pelabuhanDisposisi = $pelabuhanDisposisi->where('pelabuhan_surat_masuk_id', $pelabuhanSuratMasuk)->firstOrFail();
        return view('Pelabuhan.disposisi.edit', compact('pelabuhanDisposisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanDisposisi $pelabuhanDisposisi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DisposisiRequest $request, $pelabuhanSuratMasuk, PelabuhanDisposisi $pelabuhanDisposisi)
    {
        $payload = $request->validated();
        $pelabuhanDisposisi->where('pelabuhan_surat_masuk_id', $pelabuhanSuratMasuk)->update($payload);

        return redirect()->route('pelabuhan-surat-masuk.index')
            ->with('success', 'PelabuhanDisposisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(PelabuhanSuratMasuk $pelabuhanSuratMasuk)
    {
        $pelabuhanSuratMasuk->disposisi()->forceDelete();

        return redirect()->route('pelabuhan-surat-masuk.index')
            ->with('success', 'PelabuhanDisposisi deleted successfully');
    }
}
