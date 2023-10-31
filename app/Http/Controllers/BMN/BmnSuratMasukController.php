<?php

namespace App\Http\Controllers\BMN;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\BMN\BmnSuratMasuk;

/**
 * Class BmnSuratMasukController
 * @package App\Http\Controllers
 */
class BmnSuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $bmnSuratMasuks = BmnSuratMasuk::useSearch();
        $ids = $bmnSuratMasuks->pluck('id')->toArray();

        return view('BMN.surat-masuk.index')
        ->with('bmnSuratMasuks', $bmnSuratMasuks->paginate(10))
            ->with('export', route('export-data', [
                'ids' => implode(',', $ids),
                'model' => 'bmn_surat_masuk'
            ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $bmnSuratMasuk = new BmnSuratMasuk();
        return view('BMN.surat-masuk.create', compact('bmnSuratMasuk'));
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
        BmnSuratMasuk::create($payload);

        return redirect()->route('bmn-surat-masuk.index')
            ->with('success', 'BmnSuratMasuk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(BmnSuratMasuk $bmnSuratMasuk)
    {
        return view('BMN.surat-masuk.show', compact('bmnSuratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(BmnSuratMasuk $bmnSuratMasuk)
    {
        return view('BMN.surat-masuk.edit', compact('bmnSuratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BmnSuratMasuk $bmnSuratMasuk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, BmnSuratMasuk $bmnSuratMasuk)
    {
        $payload = $request->validated();
        $bmnSuratMasuk->update($payload);

        return redirect()->route('bmn-surat-masuk.index')
            ->with('success', 'BmnSuratMasuk updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(BmnSuratMasuk $bmnSuratMasuk)
    {
        $bmnSuratMasuk->delete();

        return redirect()->route('bmn-surat-masuk.index')
            ->with('success', 'BmnSuratMasuk deleted successfully');
    }
}
