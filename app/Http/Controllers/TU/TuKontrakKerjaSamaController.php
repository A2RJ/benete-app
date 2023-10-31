<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\TU\TuKontrakKerjaSama;

/**
 * Class TuKontrakKerjaSamaController
 * @package App\Http\Controllers
 */
class TuKontrakKerjaSamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tuKontrakKerjaSamas = TuKontrakKerjaSama::useSearch();
        $ids = $tuKontrakKerjaSamas->pluck('id')->toArray();

        return view('TU.kontrak-kerja-sama.index')
        ->with('tuKontrakKerjaSamas', $tuKontrakKerjaSamas->paginate(10))
            ->with('export', route('export-data', [
                'ids' => implode(',', $ids),
                'model' => 'tu_kontrak_kerja_sama'
            ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $tuKontrakKerjaSama = new TuKontrakKerjaSama();
        return view('TU.kontrak-kerja-sama.create', compact('tuKontrakKerjaSama'));
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
        TuKontrakKerjaSama::create($payload);

        return redirect()->route('tu-kontrak-kerja-sama.index')
            ->with('success', 'TuKontrakKerjaSama created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(TuKontrakKerjaSama $tuKontrakKerjaSama)
    { 
        return view('TU.kontrak-kerja-sama.show', compact('tuKontrakKerjaSama'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(TuKontrakKerjaSama $tuKontrakKerjaSama)
    { 
        return view('TU.kontrak-kerja-sama.edit', compact('tuKontrakKerjaSama'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TuKontrakKerjaSama $tuKontrakKerjaSama
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, TuKontrakKerjaSama $tuKontrakKerjaSama)
    {
        $tuKontrakKerjaSama->update($request->validated());

        return redirect()->route('tu-kontrak-kerja-sama.index')
            ->with('success', 'TuKontrakKerjaSama updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(TuKontrakKerjaSama $tuKontrakKerjaSama)
    {
        $tuKontrakKerjaSama->delete();

        return redirect()->route('tu-kontrak-kerja-sama.index')
            ->with('success', 'TuKontrakKerjaSama deleted successfully');
    }
}
