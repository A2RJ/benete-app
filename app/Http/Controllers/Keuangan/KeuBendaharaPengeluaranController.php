<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Keuangan\KeuBendaharaPengeluaran;

/**
 * Class KeuBendaharaPengeluaranController
 * @package App\Http\Controllers
 */
class KeuBendaharaPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $keuBendaharaPengeluarans = KeuBendaharaPengeluaran::useSearch();
        $ids = $keuBendaharaPengeluarans->pluck('id')->toArray();

        return view('Keuangan.bendahara-pengeluaran.index')
        ->with('keuBendaharaPengeluarans', $keuBendaharaPengeluarans->paginate(10))
            ->with('export', count($ids) ? route('export-data', [
                'ids' => implode(',', $ids),
                'model' => 'keu_bendahara_pengeluaran'
            ]) : false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $keuBendaharaPengeluaran = new KeuBendaharaPengeluaran();
        return view('Keuangan.bendahara-pengeluaran.create', compact('keuBendaharaPengeluaran'));
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
        KeuBendaharaPengeluaran::create($payload);

        return redirect()->route('keu-bendahara-pengeluaran.index')
            ->with('success', 'KeuBendaharaPengeluaran created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KeuBendaharaPengeluaran $keuBendaharaPengeluaran)
    {
        return view('Keuangan.bendahara-pengeluaran.show', compact('keuBendaharaPengeluaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KeuBendaharaPengeluaran $keuBendaharaPengeluaran)
    {
        return view('Keuangan.bendahara-pengeluaran.edit', compact('keuBendaharaPengeluaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuBendaharaPengeluaran $keuBendaharaPengeluaran
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KeuBendaharaPengeluaran $keuBendaharaPengeluaran)
    {
        $keuBendaharaPengeluaran->update($request->validated());

        return redirect()->route('keu-bendahara-pengeluaran.index')
            ->with('success', 'KeuBendaharaPengeluaran updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KeuBendaharaPengeluaran $keuBendaharaPengeluaran)
    {
        $keuBendaharaPengeluaran->delete();

        return redirect()->route('keu-bendahara-pengeluaran.index')
            ->with('success', 'KeuBendaharaPengeluaran deleted successfully');
    }
}
