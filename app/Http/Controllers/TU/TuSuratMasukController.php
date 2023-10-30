<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\TU\TuSuratMasuk;

/**
 * Class TuSuratMasukController
 * @package App\Http\Controllers
 */
class TuSuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tuSuratMasuks = TuSuratMasuk::useSearch();
        $ids = $tuSuratMasuks->pluck('id')->toArray();
        $exportUrl = route('export-data', ['ids' => implode(',', $ids), 'model' => 'tu_surat_masuk']);

        return view('TU.surat-masuk.index')
        ->with('tuSuratMasuks', $tuSuratMasuks->paginate(10))
            ->with('export', $exportUrl);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $tuSuratMasuk = new TuSuratMasuk();
        return view('TU.surat-masuk.create', compact('tuSuratMasuk'));
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
        TuSuratMasuk::create($payload);

        return redirect()->route('tu-surat-masuk.index')
            ->with('success', 'TuSuratMasuk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(TuSuratMasuk $tuSuratMasuk)
    {
        return view('TU.surat-masuk.show', compact('tuSuratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(TuSuratMasuk $tuSuratMasuk)
    {
        return view('TU.surat-masuk.edit', compact('tuSuratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TuSuratMasuk $tuSuratMasuk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, TuSuratMasuk $tuSuratMasuk)
    {
        $tuSuratMasuk->update($request->validated());

        return redirect()->route('tu-surat-masuk.index')
            ->with('success', 'TuSuratMasuk updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(TuSuratMasuk $tuSuratMasuk)
    {
        $tuSuratMasuk->delete();

        return redirect()->route('tu-surat-masuk.index')
            ->with('success', 'TuSuratMasuk deleted successfully');
    }
}
