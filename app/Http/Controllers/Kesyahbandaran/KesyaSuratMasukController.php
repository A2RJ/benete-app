<?php

namespace App\Http\Controllers\Kesyahbandaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Kesyahbandaran\KesyaSuratMasuk;

/**
 * Class KesyaSuratMasukController
 * @package App\Http\Controllers
 */
class KesyaSuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kesyaSuratMasuks = KesyaSuratMasuk::useSearch()->paginate(10);

        return view('Kesya.surat-masuk.index', compact('kesyaSuratMasuks'))
            ->with('i', (request()->input('page', 1) - 1) * $kesyaSuratMasuks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $kesyaSuratMasuk = new KesyaSuratMasuk();
        return view('Kesya.surat-masuk.create', compact('kesyaSuratMasuk'));
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
        KesyaSuratMasuk::create($payload);

        return redirect()->route('kesya-surat-masuk.index')
            ->with('success', 'KesyaSuratMasuk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KesyaSuratMasuk $kesyaSuratMasuk)
    {
        return view('Kesya.surat-masuk.show', compact('kesyaSuratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KesyaSuratMasuk $kesyaSuratMasuk)
    {
        return view('Kesya.surat-masuk.edit', compact('kesyaSuratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaSuratMasuk $kesyaSuratMasuk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KesyaSuratMasuk $kesyaSuratMasuk)
    {
        $kesyaSuratMasuk->update($request->validated());

        return redirect()->route('kesya-surat-masuk.index')
            ->with('success', 'KesyaSuratMasuk updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KesyaSuratMasuk $kesyaSuratMasuk)
    {
        $kesyaSuratMasuk->delete();

        return redirect()->route('kesya-surat-masuk.index')
            ->with('success', 'KesyaSuratMasuk deleted successfully');
    }
}
