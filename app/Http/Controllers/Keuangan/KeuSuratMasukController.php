<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Models\Keuangan\KeuSuratMasuk;
use Illuminate\Http\Request;

/**
 * Class KeuSuratMasukController
 * @package App\Http\Controllers
 */
class KeuSuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keuSuratMasuks = KeuSuratMasuk::paginate(10);

        return view('Keuangan.surat-masuk.index', compact('keuSuratMasuks'))
            ->with('i', (request()->input('page', 1) - 1) * $keuSuratMasuks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keuSuratMasuk = new KeuSuratMasuk();
        return view('Keuangan.surat-masuk.create', compact('keuSuratMasuk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(KeuSuratMasuk::$rules);

        $keuSuratMasuk = KeuSuratMasuk::create($request->all());

        return redirect()->route('Keuangan.surat-masuk.index')
            ->with('success', 'KeuSuratMasuk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keuSuratMasuk = KeuSuratMasuk::find($id);

        return view('Keuangan.surat-masuk.show', compact('keuSuratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keuSuratMasuk = KeuSuratMasuk::find($id);

        return view('Keuangan.surat-masuk.edit', compact('keuSuratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuSuratMasuk $keuSuratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeuSuratMasuk $keuSuratMasuk)
    {
        request()->validate(KeuSuratMasuk::$rules);

        $keuSuratMasuk->update($request->all());

        return redirect()->route('Keuangan.surat-masuk.index')
            ->with('success', 'KeuSuratMasuk updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $keuSuratMasuk = KeuSuratMasuk::find($id)->delete();

        return redirect()->route('Keuangan.surat-masuk.index')
            ->with('success', 'KeuSuratMasuk deleted successfully');
    }
}
