<?php

namespace App\Http\Controllers;

use App\Models\KeuPejabatPengadaan;
use Illuminate\Http\Request;

/**
 * Class KeuPejabatPengadaanController
 * @package App\Http\Controllers
 */
class KeuPejabatPengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keuPejabatPengadaans = KeuPejabatPengadaan::paginate(10);

        return view('keu-pejabat-pengadaan.index', compact('keuPejabatPengadaans'))
            ->with('i', (request()->input('page', 1) - 1) * $keuPejabatPengadaans->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keuPejabatPengadaan = new KeuPejabatPengadaan();
        return view('keu-pejabat-pengadaan.create', compact('keuPejabatPengadaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(KeuPejabatPengadaan::$rules);

        $keuPejabatPengadaan = KeuPejabatPengadaan::create($request->all());

        return redirect()->route('keu-pejabat-pengadaan.index')
            ->with('success', 'KeuPejabatPengadaan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keuPejabatPengadaan = KeuPejabatPengadaan::find($id);

        return view('keu-pejabat-pengadaan.show', compact('keuPejabatPengadaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keuPejabatPengadaan = KeuPejabatPengadaan::find($id);

        return view('keu-pejabat-pengadaan.edit', compact('keuPejabatPengadaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuPejabatPengadaan $keuPejabatPengadaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeuPejabatPengadaan $keuPejabatPengadaan)
    {
        request()->validate(KeuPejabatPengadaan::$rules);

        $keuPejabatPengadaan->update($request->all());

        return redirect()->route('keu-pejabat-pengadaan.index')
            ->with('success', 'KeuPejabatPengadaan updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $keuPejabatPengadaan = KeuPejabatPengadaan::find($id)->delete();

        return redirect()->route('keu-pejabat-pengadaan.index')
            ->with('success', 'KeuPejabatPengadaan deleted successfully');
    }
}
