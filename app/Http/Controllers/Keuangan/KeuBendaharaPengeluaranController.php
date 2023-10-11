<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\KeuBendaharaPengeluaran;
use Illuminate\Http\Request;

/**
 * Class KeuBendaharaPengeluaranController
 * @package App\Http\Controllers
 */
class KeuBendaharaPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keuBendaharaPengeluarans = KeuBendaharaPengeluaran::paginate(10);

        return view('keu-bendahara-pengeluaran.index', compact('keuBendaharaPengeluarans'))
            ->with('i', (request()->input('page', 1) - 1) * $keuBendaharaPengeluarans->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keuBendaharaPengeluaran = new KeuBendaharaPengeluaran();
        return view('keu-bendahara-pengeluaran.create', compact('keuBendaharaPengeluaran'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(KeuBendaharaPengeluaran::$rules);

        $keuBendaharaPengeluaran = KeuBendaharaPengeluaran::create($request->all());

        return redirect()->route('keu-bendahara-pengeluaran.index')
            ->with('success', 'KeuBendaharaPengeluaran created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keuBendaharaPengeluaran = KeuBendaharaPengeluaran::find($id);

        return view('keu-bendahara-pengeluaran.show', compact('keuBendaharaPengeluaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keuBendaharaPengeluaran = KeuBendaharaPengeluaran::find($id);

        return view('keu-bendahara-pengeluaran.edit', compact('keuBendaharaPengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuBendaharaPengeluaran $keuBendaharaPengeluaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeuBendaharaPengeluaran $keuBendaharaPengeluaran)
    {
        request()->validate(KeuBendaharaPengeluaran::$rules);

        $keuBendaharaPengeluaran->update($request->all());

        return redirect()->route('keu-bendahara-pengeluaran.index')
            ->with('success', 'KeuBendaharaPengeluaran updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $keuBendaharaPengeluaran = KeuBendaharaPengeluaran::find($id)->delete();

        return redirect()->route('keu-bendahara-pengeluaran.index')
            ->with('success', 'KeuBendaharaPengeluaran deleted successfully');
    }
}
