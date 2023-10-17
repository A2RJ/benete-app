<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Models\Keuangan\KeuSuratKeluar;
use Illuminate\Http\Request;

/**
 * Class KeuSuratKeluarController
 * @package App\Http\Controllers
 */
class KeuSuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keuSuratKeluars = KeuSuratKeluar::paginate(10);

        return view('Keuangan.surat-keluar.index', compact('keuSuratKeluars'))
            ->with('i', (request()->input('page', 1) - 1) * $keuSuratKeluars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keuSuratKeluar = new KeuSuratKeluar();
        return view('Keuangan.surat-keluar.create', compact('keuSuratKeluar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request)
    {
        request()->validate(KeuSuratKeluar::$rules);

        $keuSuratKeluar = KeuSuratKeluar::create($request->all());

        return redirect()->route('keu-surat-keluar.index')
            ->with('success', 'KeuSuratKeluar created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keuSuratKeluar = KeuSuratKeluar::find($id);

        return view('Keuangan.surat-keluar.show', compact('keuSuratKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keuSuratKeluar = KeuSuratKeluar::find($id);

        return view('Keuangan.surat-keluar.edit', compact('keuSuratKeluar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuSuratKeluar $keuSuratKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeuSuratKeluar $keuSuratKeluar)
    {
        request()->validate(KeuSuratKeluar::$rules);

        $keuSuratKeluar->update($request->all());

        return redirect()->route('keu-surat-keluar.index')
            ->with('success', 'KeuSuratKeluar updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $keuSuratKeluar = KeuSuratKeluar::find($id)->delete();

        return redirect()->route('keu-surat-keluar.index')
            ->with('success', 'KeuSuratKeluar deleted successfully');
    }
}
