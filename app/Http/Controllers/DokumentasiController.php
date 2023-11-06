<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class KeuDokumentasiController
 * @package App\Http\Controllers
 */
class DokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $keuDokumentasis = Dokumentasi::role()->searchFile();
        $ids = $keuDokumentasis->pluck('id')->toArray();

        return view('dokumentasi.index')
            ->with('keuDokumentasis', $keuDokumentasis->paginate(10))
            ->with('export', route('export-data', [
                'ids' => implode(',', $ids),
                'model' => 'keu_dokumentasi'
            ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $dokumentasi = new Dokumentasi();
        return view('dokumentasi.create', compact('dokumentasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        request()->validate(Dokumentasi::$rules);

        Dokumentasi::create($request->all());

        return redirect()->route('dokumentasi.index')
            ->with('success', 'Dokumentasi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $dokumentasi = Dokumentasi::find($id);

        return view('dokumentasi.show', compact('dokumentasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $dokumentasi = Dokumentasi::find($id);

        return view('dokumentasi.edit', compact('dokumentasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Dokumentasi $dokumentasi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Dokumentasi $dokumentasi)
    {
        request()->validate(Dokumentasi::$rules);

        $dokumentasi->update($request->all());

        return redirect()->route('dokumentasi.index')
            ->with('success', 'Dokumentasi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        Dokumentasi::find($id)->delete();

        return redirect()->route('dokumentasi.index')
            ->with('success', 'Dokumentasi deleted successfully');
    }
}
