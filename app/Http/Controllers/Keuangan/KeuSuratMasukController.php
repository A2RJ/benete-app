<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Keuangan\KeuSuratMasuk;

/**
 * Class KeuSuratMasukController
 * @package App\Http\Controllers
 */
class KeuSuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $keuSuratMasuks = KeuSuratMasuk::paginate(10);

        return view('Keuangan.surat-masuk.index', compact('keuSuratMasuks'))
            ->with('i', (request()->input('page', 1) - 1) * $keuSuratMasuks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $keuSuratMasuk = new KeuSuratMasuk();
        return view('Keuangan.surat-masuk.create', compact('keuSuratMasuk'));
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
        KeuSuratMasuk::create($payload);

        return redirect()->route('keu-surat-masuk.index')
            ->with('success', 'KeuSuratMasuk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KeuSuratMasuk $keuSuratMasuk)
    {
        return view('Keuangan.surat-masuk.show', compact('keuSuratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KeuSuratMasuk $keuSuratMasuk)
    {
        return view('Keuangan.surat-masuk.edit', compact('keuSuratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuSuratMasuk $keuSuratMasuk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KeuSuratMasuk $keuSuratMasuk)
    {
        $keuSuratMasuk->update($request->validated());

        return redirect()->route('keu-surat-masuk.index')
            ->with('success', 'KeuSuratMasuk updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KeuSuratMasuk $keuSuratMasuk)
    {
        $keuSuratMasuk->delete();

        return redirect()->route('keu-surat-masuk.index')
            ->with('success', 'KeuSuratMasuk deleted successfully');
    }
}
