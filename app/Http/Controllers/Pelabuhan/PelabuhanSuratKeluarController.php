<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Models\Pelabuhan\PelabuhanSuratKeluar;
use Illuminate\Http\Request;

/**
 * Class PelabuhanSuratKeluarController
 * @package App\Http\Controllers
 */
class PelabuhanSuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelabuhanSuratKeluars = PelabuhanSuratKeluar::paginate(10);

        return view('Pelabuhan.surat-keluar.index', compact('pelabuhanSuratKeluars'))
            ->with('i', (request()->input('page', 1) - 1) * $pelabuhanSuratKeluars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelabuhanSuratKeluar = new PelabuhanSuratKeluar();
        return view('Pelabuhan.surat-keluar.create', compact('pelabuhanSuratKeluar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(PelabuhanSuratKeluar::$rules);

        $pelabuhanSuratKeluar = PelabuhanSuratKeluar::create($request->all());

        return redirect()->route('pelabuhan-surat-keluar.index')
            ->with('success', 'PelabuhanSuratKeluar created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelabuhanSuratKeluar = PelabuhanSuratKeluar::find($id);

        return view('Pelabuhan.surat-keluar.show', compact('pelabuhanSuratKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelabuhanSuratKeluar = PelabuhanSuratKeluar::find($id);

        return view('Pelabuhan.surat-keluar.edit', compact('pelabuhanSuratKeluar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanSuratKeluar $pelabuhanSuratKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PelabuhanSuratKeluar $pelabuhanSuratKeluar)
    {
        request()->validate(PelabuhanSuratKeluar::$rules);

        $pelabuhanSuratKeluar->update($request->all());

        return redirect()->route('pelabuhan-surat-keluar.index')
            ->with('success', 'PelabuhanSuratKeluar updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pelabuhanSuratKeluar = PelabuhanSuratKeluar::find($id)->delete();

        return redirect()->route('pelabuhan-surat-keluar.index')
            ->with('success', 'PelabuhanSuratKeluar deleted successfully');
    }
}
