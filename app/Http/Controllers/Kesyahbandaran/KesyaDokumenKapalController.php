<?php

namespace App\Http\Controllers\Kesyahbandaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Kesyahbandaran\KesyaDokumenKapal;

/**
 * Class KesyaDokumenKapalController
 * @package App\Http\Controllers
 */
class KesyaDokumenKapalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kesyaDokumenKapals = KesyaDokumenKapal::paginate(10);

        return view('Kesya.dokumen-kapal.index', compact('kesyaDokumenKapals'))
            ->with('i', (request()->input('page', 1) - 1) * $kesyaDokumenKapals->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $kesyaDokumenKapal = new KesyaDokumenKapal();
        return view('Kesya.dokumen-kapal.create', compact('kesyaDokumenKapal'));
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
        KesyaDokumenKapal::create($payload);

        return redirect()->route('kesya-dokumen-kapal.index')
            ->with('success', 'KesyaDokumenKapal created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KesyaDokumenKapal $kesyaDokumenKapal)
    {
        return view('Kesya.dokumen-kapal.show', compact('kesyaDokumenKapal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KesyaDokumenKapal $kesyaDokumenKapal)
    {
        return view('Kesya.dokumen-kapal.edit', compact('kesyaDokumenKapal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaDokumenKapal $kesyaDokumenKapal
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KesyaDokumenKapal $kesyaDokumenKapal)
    {
        $kesyaDokumenKapal->update($request->validated());

        return redirect()->route('kesya-dokumen-kapal.index')
            ->with('success', 'KesyaDokumenKapal updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KesyaDokumenKapal $kesyaDokumenKapal)
    {
        $kesyaDokumenKapal->delete();

        return redirect()->route('kesya-dokumen-kapal.index')
            ->with('success', 'KesyaDokumenKapal deleted successfully');
    }
}
