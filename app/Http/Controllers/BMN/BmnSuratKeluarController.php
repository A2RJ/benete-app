<?php

namespace App\Http\Controllers\BMN;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Models\BMN\BmnSuratKeluar;
use Illuminate\Http\Request;

/**
 * Class BmnSuratKeluarController
 * @package App\Http\Controllers
 */
class BmnSuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bmnSuratKeluars = BmnSuratKeluar::paginate(10);

        return view('BMN.surat-keluar.index', compact('bmnSuratKeluars'))
            ->with('i', (request()->input('page', 1) - 1) * $bmnSuratKeluars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bmnSuratKeluar = new BmnSuratKeluar();
        return view('BMN.surat-keluar.create', compact('bmnSuratKeluar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request)
    {
        request()->validate(BmnSuratKeluar::$rules);

        $bmnSuratKeluar = BmnSuratKeluar::create($request->all());

        return redirect()->route('bmn-surat-keluars.index')
            ->with('success', 'BmnSuratKeluar created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bmnSuratKeluar = BmnSuratKeluar::find($id);

        return view('BMN.surat-keluar.show', compact('bmnSuratKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bmnSuratKeluar = BmnSuratKeluar::find($id);

        return view('BMN.surat-keluar.edit', compact('bmnSuratKeluar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BmnSuratKeluar $bmnSuratKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BmnSuratKeluar $bmnSuratKeluar)
    {
        request()->validate(BmnSuratKeluar::$rules);

        $bmnSuratKeluar->update($request->all());

        return redirect()->route('bmn-surat-keluars.index')
            ->with('success', 'BmnSuratKeluar updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bmnSuratKeluar = BmnSuratKeluar::find($id)->delete();

        return redirect()->route('bmn-surat-keluars.index')
            ->with('success', 'BmnSuratKeluar deleted successfully');
    }
}
