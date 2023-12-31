<?php

namespace App\Http\Controllers\Kesyahbandaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Kesyahbandaran\KesyaDokumenAwakKapal;

/**
 * Class KesyaDokumenAwakKapalController
 * @package App\Http\Controllers
 */
class KesyaDokumenAwakKapalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kesyaDokumenAwakKapals = KesyaDokumenAwakKapal::useSearch();
        $ids = $kesyaDokumenAwakKapals->pluck('id')->toArray();

        return view('Kesya.dokumen-awak-kapal.index')
        ->with('kesyaDokumenAwakKapals', $kesyaDokumenAwakKapals->paginate(10))
            ->with('export', count($ids) ? route('export-data', [
                'ids' => implode(',', $ids),
                'model' => 'kesya_dokumen_awak_kapal'
            ]) : false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $kesyaDokumenAwakKapal = new KesyaDokumenAwakKapal();
        return view('Kesya.dokumen-awak-kapal.create', compact('kesyaDokumenAwakKapal'));
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
        KesyaDokumenAwakKapal::create($payload);

        return redirect()->route('kesya-dokumen-awak-kapal.index')
            ->with('success', 'KesyaDokumenAwakKapal created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KesyaDokumenAwakKapal $kesyaDokumenAwakKapal)
    {
        return view('Kesya.dokumen-awak-kapal.show', compact('kesyaDokumenAwakKapal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KesyaDokumenAwakKapal $kesyaDokumenAwakKapal)
    {
        return view('Kesya.dokumen-awak-kapal.edit', compact('kesyaDokumenAwakKapal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaDokumenAwakKapal $kesyaDokumenAwakKapal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KesyaDokumenAwakKapal $kesyaDokumenAwakKapal)
    {
        $kesyaDokumenAwakKapal->update($request->validated());

        return redirect()->route('kesya-dokumen-awak-kapal.index')
            ->with('success', 'KesyaDokumenAwakKapal updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KesyaDokumenAwakKapal $kesyaDokumenAwakKapal)
    {
        $kesyaDokumenAwakKapal->delete();

        return redirect()->route('kesya-dokumen-awak-kapal.index')
            ->with('success', 'KesyaDokumenAwakKapal deleted successfully');
    }
}
