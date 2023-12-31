<?php

namespace App\Http\Controllers\BMN;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\BMN\BmnSuratKeluar;

/**
 * Class BmnSuratKeluarController
 * @package App\Http\Controllers
 */
class BmnSuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $bmnSuratKeluars = BmnSuratKeluar::useSearch();
        $ids = $bmnSuratKeluars->pluck('id')->toArray();

        return view('BMN.surat-keluar.index')
        ->with('bmnSuratKeluars', $bmnSuratKeluars->paginate(10))
            ->with('export', count($ids) ? route('export-data', [
                'ids' => implode(',', $ids),
                'model' => 'bmn_surat_keluar'
            ]) : false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $bmnSuratKeluar = new BmnSuratKeluar();
        return view('BMN.surat-keluar.create', compact('bmnSuratKeluar'));
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
        BmnSuratKeluar::create($payload);

        return redirect()->route('bmn-surat-keluar.index')
            ->with('success', 'BmnSuratKeluar created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(BmnSuratKeluar $bmnSuratKeluar)
    {
        return view('BMN.surat-keluar.show', compact('bmnSuratKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(BmnSuratKeluar $bmnSuratKeluar)
    {
        return view('BMN.surat-keluar.edit', compact('bmnSuratKeluar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BmnSuratKeluar $bmnSuratKeluar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, BmnSuratKeluar $bmnSuratKeluar)
    {
        $payload = $request->validated();
        $bmnSuratKeluar->update($payload);

        return redirect()->route('bmn-surat-keluar.index')
            ->with('success', 'BmnSuratKeluar updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(BmnSuratKeluar $bmnSuratKeluar)
    {
        $bmnSuratKeluar->delete();

        return redirect()->route('bmn-surat-keluar.index')
            ->with('success', 'BmnSuratKeluar deleted successfully');
    }
}
