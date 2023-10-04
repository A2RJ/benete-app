<?php

namespace App\Http\Controllers;

use App\Models\KeuBendaharaPenerimaan;
use Illuminate\Http\Request;

/**
 * Class KeuBendaharaPenerimaanController
 * @package App\Http\Controllers
 */
class KeuBendaharaPenerimaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keuBendaharaPenerimaans = KeuBendaharaPenerimaan::paginate(10);

        return view('keu-bendahara-penerimaan.index', compact('keuBendaharaPenerimaans'))
            ->with('i', (request()->input('page', 1) - 1) * $keuBendaharaPenerimaans->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keuBendaharaPenerimaan = new KeuBendaharaPenerimaan();
        return view('keu-bendahara-penerimaan.create', compact('keuBendaharaPenerimaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(KeuBendaharaPenerimaan::$rules);

        $keuBendaharaPenerimaan = KeuBendaharaPenerimaan::create($request->all());

        return redirect()->route('keu-bendahara-penerimaan.index')
            ->with('success', 'KeuBendaharaPenerimaan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keuBendaharaPenerimaan = KeuBendaharaPenerimaan::find($id);

        return view('keu-bendahara-penerimaan.show', compact('keuBendaharaPenerimaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keuBendaharaPenerimaan = KeuBendaharaPenerimaan::find($id);

        return view('keu-bendahara-penerimaan.edit', compact('keuBendaharaPenerimaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuBendaharaPenerimaan $keuBendaharaPenerimaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeuBendaharaPenerimaan $keuBendaharaPenerimaan)
    {
        request()->validate(KeuBendaharaPenerimaan::$rules);

        $keuBendaharaPenerimaan->update($request->all());

        return redirect()->route('keu-bendahara-penerimaan.index')
            ->with('success', 'KeuBendaharaPenerimaan updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $keuBendaharaPenerimaan = KeuBendaharaPenerimaan::find($id)->delete();

        return redirect()->route('keu-bendahara-penerimaan.index')
            ->with('success', 'KeuBendaharaPenerimaan deleted successfully');
    }
}
