<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Keuangan\KeuBendaharaPenerimaan;

/**
 * Class KeuBendaharaPenerimaanController
 * @package App\Http\Controllers
 */
class KeuBendaharaPenerimaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $keuBendaharaPenerimaans = KeuBendaharaPenerimaan::paginate(10);

        return view('Keuangan.bendahara-penerimaan.index', compact('keuBendaharaPenerimaans'))
            ->with('i', (request()->input('page', 1) - 1) * $keuBendaharaPenerimaans->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $keuBendaharaPenerimaan = new KeuBendaharaPenerimaan();
        return view('Keuangan.bendahara-penerimaan.create', compact('keuBendaharaPenerimaan'));
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
        KeuBendaharaPenerimaan::create($payload);

        return redirect()->route('keu-bendahara-penerimaan.index')
            ->with('success', 'KeuBendaharaPenerimaan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KeuBendaharaPenerimaan $keuBendaharaPenerimaan)
    {
        return view('Keuangan.bendahara-penerimaan.show', compact('keuBendaharaPenerimaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KeuBendaharaPenerimaan $keuBendaharaPenerimaan)
    {
        return view('Keuangan.bendahara-penerimaan.edit', compact('keuBendaharaPenerimaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuBendaharaPenerimaan $keuBendaharaPenerimaan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KeuBendaharaPenerimaan $keuBendaharaPenerimaan)
    {
        $keuBendaharaPenerimaan->update($request->validated());

        return redirect()->route('keu-bendahara-penerimaan.index')
            ->with('success', 'KeuBendaharaPenerimaan updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KeuBendaharaPenerimaan $keuBendaharaPenerimaan)
    {
        $keuBendaharaPenerimaan->delete();

        return redirect()->route('keu-bendahara-penerimaan.index')
            ->with('success', 'KeuBendaharaPenerimaan deleted successfully');
    }
}
