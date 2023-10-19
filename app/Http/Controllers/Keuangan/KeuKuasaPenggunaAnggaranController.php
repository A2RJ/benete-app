<?php

namespace App\Http\Controllers\Keuangan;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Keuangan\KeuKuasaPenggunaAnggaran;
use Illuminate\Http\Request;

/**
 * Class KeuKuasaPenggunaAnggaranController
 * @package App\Http\Controllers
 */
class KeuKuasaPenggunaAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $keuKuasaPenggunaAnggarans = KeuKuasaPenggunaAnggaran::paginate(10);

        return view('Keuangan.kuasa-pengguna-anggaran.index', compact('keuKuasaPenggunaAnggarans'))
            ->with('i', (request()->input('page', 1) - 1) * $keuKuasaPenggunaAnggarans->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $keuKuasaPenggunaAnggaran = new KeuKuasaPenggunaAnggaran();
        return view('Keuangan.kuasa-pengguna-anggaran.create', compact('keuKuasaPenggunaAnggaran'));
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
        KeuKuasaPenggunaAnggaran::create($payload);

        return redirect()->route('keu-kuasa-pengguna-anggaran.index')
            ->with('success', 'KeuKuasaPenggunaAnggaran created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KeuKuasaPenggunaAnggaran $keuKuasaPenggunaAnggaran)
    {
        return view('Keuangan.kuasa-pengguna-anggaran.show', compact('keuKuasaPenggunaAnggaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KeuKuasaPenggunaAnggaran $keuKuasaPenggunaAnggaran)
    {
        return view('Keuangan.kuasa-pengguna-anggaran.edit', compact('keuKuasaPenggunaAnggaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuKuasaPenggunaAnggaran $keuKuasaPenggunaAnggaran
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KeuKuasaPenggunaAnggaran $keuKuasaPenggunaAnggaran)
    {
        $keuKuasaPenggunaAnggaran->update($request->validated());

        return redirect()->route('keu-kuasa-pengguna-anggaran.index')
            ->with('success', 'KeuKuasaPenggunaAnggaran updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KeuKuasaPenggunaAnggaran $keuKuasaPenggunaAnggaran)
    {
        $keuKuasaPenggunaAnggaran->delete();

        return redirect()->route('keu-kuasa-pengguna-anggaran.index')
            ->with('success', 'KeuKuasaPenggunaAnggaran deleted successfully');
    }
}
