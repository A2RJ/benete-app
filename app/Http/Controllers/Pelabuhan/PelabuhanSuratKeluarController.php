<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Pelabuhan\PelabuhanSuratKeluar;

/**
 * Class PelabuhanSuratKeluarController
 * @package App\Http\Controllers
 */
class PelabuhanSuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pelabuhanSuratKeluars = PelabuhanSuratKeluar::useSearch();
        $ids = $pelabuhanSuratKeluars->pluck('id')->toArray();

        return view('Pelabuhan.surat-keluar.index')
        ->with('pelabuhanSuratKeluars', $pelabuhanSuratKeluars->paginate(10))
            ->with('export', count($ids) ? route('export-data', [
                'ids' => implode(',', $ids),
                'model' => 'pelabuhan_surat_keluar'
            ]) : false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $pelabuhanSuratKeluar = new PelabuhanSuratKeluar();
        return view('Pelabuhan.surat-keluar.create', compact('pelabuhanSuratKeluar'));
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
        PelabuhanSuratKeluar::create($payload);

        return redirect()->route('pelabuhan-surat-keluar.index')
            ->with('success', 'PelabuhanSuratKeluar created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(PelabuhanSuratKeluar $pelabuhanSuratKeluar)
    {
        return view('Pelabuhan.surat-keluar.show', compact('pelabuhanSuratKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(PelabuhanSuratKeluar $pelabuhanSuratKeluar)
    {
        return view('Pelabuhan.surat-keluar.edit', compact('pelabuhanSuratKeluar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanSuratKeluar $pelabuhanSuratKeluar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, PelabuhanSuratKeluar $pelabuhanSuratKeluar)
    {
        $pelabuhanSuratKeluar->update($request->validated());

        return redirect()->route('pelabuhan-surat-keluar.index')
            ->with('success', 'PelabuhanSuratKeluar updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(PelabuhanSuratKeluar $pelabuhanSuratKeluar)
    {
        $pelabuhanSuratKeluar->delete();

        return redirect()->route('pelabuhan-surat-keluar.index')
            ->with('success', 'PelabuhanSuratKeluar deleted successfully');
    }
}
