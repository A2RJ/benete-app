<?php

namespace App\Http\Controllers\TU;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\TU\TuSuratKeluar;
use Illuminate\Http\Request;

/**
 * Class TuSuratKeluarController
 * @package App\Http\Controllers
 */
class TuSuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tuSuratKeluars = TuSuratKeluar::paginate(10);

        return view('TU.surat-keluar.index', compact('tuSuratKeluars'))
            ->with('i', (request()->input('page', 1) - 1) * $tuSuratKeluars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $tuSuratKeluar = new TuSuratKeluar();
        return view('TU.surat-keluar.create', compact('tuSuratKeluar'));
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
        TuSuratKeluar::create($payload);

        return redirect()->route('tu-surat-keluar.index')
            ->with('success', 'TuSuratKeluar created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(TuSuratKeluar $tuSuratKeluar)
    {
        return view('TU.surat-keluar.show', compact('tuSuratKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(TuSuratKeluar $tuSuratKeluar)
    {
        return view('TU.surat-keluar.edit', compact('tuSuratKeluar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TuSuratKeluar $tuSuratKeluar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, TuSuratKeluar $tuSuratKeluar)
    {
        $tuSuratKeluar->update($request->validated());

        return redirect()->route('tu-surat-keluar.index')
            ->with('success', 'TuSuratKeluar updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(TuSuratKeluar $tuSuratKeluar)
    {
        $tuSuratKeluar->delete();

        return redirect()->route('tu-surat-keluar.index')
            ->with('success', 'TuSuratKeluar deleted successfully');
    }
}
