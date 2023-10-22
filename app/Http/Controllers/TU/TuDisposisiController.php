<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Http\Requests\DisposisiRequest;
use App\Models\TU\TuDisposisi;
use App\Models\TU\TuSuratMasuk;

/**
 * Class TuDisposisiController
 * @package App\Http\Controllers
 */
class TuDisposisiController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create($tuSuratMasuk)
    {
        $tuDisposisi = new TuDisposisi();
        $tuDisposisi->tu_surat_masuk_id = $tuSuratMasuk;
        return view('TU.disposisi.create', compact('tuDisposisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DisposisiRequest $request, $tuSuratMasuk)
    {
        $payload = $request->validated();
        $tuSuratMasuk->disposisi()->create($payload);

        return redirect()->route('tu-surat-masuk.index')
            ->with('success', 'TuDisposisi created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($tuSuratMasuk, TuDisposisi $tuDisposisi)
    {
        $tuDisposisi = $tuDisposisi->where('tu_surat_masuk_id', $tuSuratMasuk)->firstOrFail();
        return view('TU.disposisi.edit', compact('tuDisposisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TuDisposisi $tuDisposisi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DisposisiRequest $request, $tuSuratMasuk, TuDisposisi $tuDisposisi)
    {
        $payload = $request->validated();
        $tuDisposisi->where('tu_surat_masuk_id', $tuSuratMasuk)->update($payload);

        return redirect()->route('tu-surat-masuk.index')
            ->with('success', 'TuDisposisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(TuSuratMasuk $tuSuratMasuk)
    {
        $tuSuratMasuk->disposisi()->delete();

        return redirect()->route('tu-surat-masuk.index')
            ->with('success', 'TuDisposisi deleted successfully');
    }
}
