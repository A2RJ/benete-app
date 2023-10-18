<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Keuangan\KeuPejabatPengadaan;
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
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $keuPejabatPengadaans = KeuPejabatPengadaan::paginate(10);

        return view('Keuangan.pejabat-pengadaan.index', compact('keuPejabatPengadaans'))
            ->with('i', (request()->input('page', 1) - 1) * $keuPejabatPengadaans->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $keuPejabatPengadaan = new KeuPejabatPengadaan();
        return view('Keuangan.pejabat-pengadaan.create', compact('keuPejabatPengadaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreValidationRequest $request)
    {
        KeuPejabatPengadaan::create($request->validated());

        return redirect()->route('keu-pejabat-pengadaan.index')
            ->with('success', 'KeuPejabatPengadaan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KeuPejabatPengadaan $keuPejabatPengadaan)
    {
        return view('Keuangan.pejabat-pengadaan.show', compact('keuPejabatPengadaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KeuPejabatPengadaan $keuPejabatPengadaan)
    {
        return view('Keuangan.pejabat-pengadaan.edit', compact('keuPejabatPengadaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuPejabatPengadaan $keuPejabatPengadaan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KeuPejabatPengadaan $keuPejabatPengadaan)
    {
        $keuPejabatPengadaan->update($request->validated());

        return redirect()->route('keu-pejabat-pengadaan.index')
            ->with('success', 'KeuPejabatPengadaan updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KeuPejabatPengadaan $keuPejabatPengadaan)
    {
        $keuPejabatPengadaan->delete();

        return redirect()->route('keu-pejabat-pengadaan.index')
            ->with('success', 'KeuPejabatPengadaan deleted successfully');
    }
}
