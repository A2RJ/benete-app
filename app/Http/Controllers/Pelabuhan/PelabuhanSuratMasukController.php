<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Pelabuhan\PelabuhanSuratMasuk; 

/**
 * Class PelabuhanSuratMasukController
 * @package App\Http\Controllers
 */
class PelabuhanSuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pelabuhanSuratMasuks = PelabuhanSuratMasuk::useSearch();
        $ids = $pelabuhanSuratMasuks->pluck('id')->toArray();

        return view('Pelabuhan.surat-masuk.index')
        ->with('pelabuhanSuratMasuks', $pelabuhanSuratMasuks->paginate(10))
            ->with('export', count($ids) ? route('export-data', [
                'ids' => implode(',', $ids),
                'model' => 'pelabuhan_surat_masuk'
            ]) : false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $pelabuhanSuratMasuk = new PelabuhanSuratMasuk();
        return view('Pelabuhan.surat-masuk.create', compact('pelabuhanSuratMasuk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreValidationRequest $request)
    {
        $payload = $request->validated();
        PelabuhanSuratMasuk::create($payload);

        return redirect()->route('pelabuhan-surat-masuk.index')
            ->with('success', 'PelabuhanSuratMasuk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(PelabuhanSuratMasuk $pelabuhanSuratMasuk)
    {
        return view('Pelabuhan.surat-masuk.show', compact('pelabuhanSuratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(PelabuhanSuratMasuk $pelabuhanSuratMasuk)
    {
        return view('Pelabuhan.surat-masuk.edit', compact('pelabuhanSuratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanSuratMasuk $pelabuhanSuratMasuk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, PelabuhanSuratMasuk $pelabuhanSuratMasuk)
    {
        $pelabuhanSuratMasuk->update($request->validated());

        return redirect()->route('pelabuhan-surat-masuk.index')
            ->with('success', 'PelabuhanSuratMasuk updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(PelabuhanSuratMasuk $pelabuhanSuratMasuk)
    {
        $pelabuhanSuratMasuk->delete();

        return redirect()->route('pelabuhan-surat-masuk.index')
            ->with('success', 'PelabuhanSuratMasuk deleted successfully');
    }
}
