<?php

namespace App\Http\Controllers\Kesyahbandaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Kesyahbandaran\KesyaSuratKeluar;

/**
 * Class KesyaSuratKeluarController
 * @package App\Http\Controllers
 */
class KesyaSuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kesyaSuratKeluars = KesyaSuratKeluar::useSearch();
        $ids = $kesyaSuratKeluars->pluck('id')->toArray();

        return view('Kesya.surat-keluar.index')
        ->with('kesyaSuratKeluars', $kesyaSuratKeluars->paginate(10))
            ->with('export', route('export-data', [
                'ids' => implode(',', $ids),
                'model' => 'kesya_surat_keluar'
            ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $kesyaSuratKeluar = new KesyaSuratKeluar();
        return view('Kesya.surat-keluar.create', compact('kesyaSuratKeluar'));
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
        KesyaSuratKeluar::create($payload);

        return redirect()->route('kesya-surat-keluar.index')
            ->with('success', 'KesyaSuratKeluar created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KesyaSuratKeluar $kesyaSuratKeluar)
    {
        return view('Kesya.surat-keluar.show', compact('kesyaSuratKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KesyaSuratKeluar $kesyaSuratKeluar)
    {
        return view('Kesya.surat-keluar.edit', compact('kesyaSuratKeluar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaSuratKeluar $kesyaSuratKeluar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KesyaSuratKeluar $kesyaSuratKeluar)
    {
        $kesyaSuratKeluar->update($request->validated());

        return redirect()->route('kesya-surat-keluar.index')
            ->with('success', 'KesyaSuratKeluar updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KesyaSuratKeluar $kesyaSuratKeluar)
    {
        $kesyaSuratKeluar->delete();

        return redirect()->route('kesya-surat-keluar.index')
            ->with('success', 'KesyaSuratKeluar deleted successfully');
    }
}
