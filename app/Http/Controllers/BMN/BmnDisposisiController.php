<?php

namespace App\Http\Controllers\BMN;

use App\Http\Controllers\Controller;
use App\Http\Requests\DisposisiRequest;
use App\Models\BMN\BmnDisposisi;
use App\Models\BMN\BmnSuratMasuk;

/**
 * Class BmnDisposisiController
 * @package App\Http\Controllers
 */
class BmnDisposisiController extends Controller
{
    public function create($bmnSuratMasuk)
    {
        $bmnDisposisi = new BmnDisposisi();
        $bmnDisposisi->bmn_surat_masuk_id = $bmnSuratMasuk;
        return view('BMN.disposisi.create', compact('bmnDisposisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DisposisiRequest $request, BmnSuratMasuk $bmnSuratMasuk)
    {
        $payload = $request->validated();
        $bmnSuratMasuk->disposisi()->create($payload);

        return redirect()->route('bmn-surat-masuk.index')
            ->with('success', 'BmnDisposisi created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function edit($bmnSuratMasuk, BmnDisposisi $bmnDisposisi)
    {
        $bmnDisposisi = $bmnDisposisi->where('bmn_surat_masuk_id', $bmnSuratMasuk)->firstOrFail();
        return view('BMN.disposisi.edit', compact('bmnDisposisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BmnDisposisi $bmnDisposisi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DisposisiRequest $request, $bmnSuratMasuk, BmnDisposisi $bmnDisposisi)
    {
        $payload = $request->validated();
        $bmnDisposisi->where('bmn_surat_masuk_id', $bmnSuratMasuk)->update($payload);

        return redirect()->route('bmn-surat-masuk.index')
            ->with('success', 'BmnDisposisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(BmnSuratMasuk $bmnSuratMasuk)
    {
        $bmnSuratMasuk->disposisi()->forceDelete();

        return redirect()->route('bmn-surat-masuk.index')
            ->with('success', 'BmnDisposisi deleted successfully');
    }
}
