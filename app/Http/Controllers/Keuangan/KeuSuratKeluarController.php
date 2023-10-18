<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Keuangan\KeuSuratKeluar;
use Illuminate\Http\Request;

/**
 * Class KeuSuratKeluarController
 * @package App\Http\Controllers
 */
class KeuSuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $keuSuratKeluars = KeuSuratKeluar::paginate(10);

        return view('Keuangan.surat-keluar.index', compact('keuSuratKeluars'))
            ->with('i', (request()->input('page', 1) - 1) * $keuSuratKeluars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $keuSuratKeluar = new KeuSuratKeluar();
        return view('Keuangan.surat-keluar.create', compact('keuSuratKeluar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreValidationRequest $request)
    {
        KeuSuratKeluar::create($request->validated());

        return redirect()->route('keu-surat-keluar.index')
            ->with('success', 'KeuSuratKeluar created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KeuSuratKeluar $keuSuratKeluar)
    {
        return view('Keuangan.surat-keluar.show', compact('keuSuratKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KeuSuratKeluar $keuSuratKeluar)
    {
        return view('Keuangan.surat-keluar.edit', compact('keuSuratKeluar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuSuratKeluar $keuSuratKeluar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KeuSuratKeluar $keuSuratKeluar)
    {
        $keuSuratKeluar->update($request->validated());

        return redirect()->route('keu-surat-keluar.index')
            ->with('success', 'KeuSuratKeluar updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KeuSuratKeluar $keuSuratKeluar)
    {
        $keuSuratKeluar->delete();

        return redirect()->route('keu-surat-keluar.index')
            ->with('success', 'KeuSuratKeluar deleted successfully');
    }
}
