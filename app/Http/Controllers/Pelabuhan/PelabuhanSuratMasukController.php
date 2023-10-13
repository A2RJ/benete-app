<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Models\Pelabuhan\PelabuhanSuratMasuk;
use Illuminate\Http\Request;

/**
 * Class PelabuhanSuratMasukController
 * @package App\Http\Controllers
 */
class PelabuhanSuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelabuhanSuratMasuks = PelabuhanSuratMasuk::paginate(10);

        return view('Pelabuhan.surat-masuk.index', compact('pelabuhanSuratMasuks'))
            ->with('i', (request()->input('page', 1) - 1) * $pelabuhanSuratMasuks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelabuhanSuratMasuk = new PelabuhanSuratMasuk();
        return view('Pelabuhan.surat-masuk.create', compact('pelabuhanSuratMasuk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(PelabuhanSuratMasuk::$rules);

        $pelabuhanSuratMasuk = PelabuhanSuratMasuk::create($request->all());

        return redirect()->route('pelabuhan-surat-masuk.index')
            ->with('success', 'PelabuhanSuratMasuk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelabuhanSuratMasuk = PelabuhanSuratMasuk::find($id);

        return view('Pelabuhan.surat-masuk.show', compact('pelabuhanSuratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelabuhanSuratMasuk = PelabuhanSuratMasuk::find($id);

        return view('Pelabuhan.surat-masuk.edit', compact('pelabuhanSuratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanSuratMasuk $pelabuhanSuratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PelabuhanSuratMasuk $pelabuhanSuratMasuk)
    {
        request()->validate(PelabuhanSuratMasuk::$rules);

        $pelabuhanSuratMasuk->update($request->all());

        return redirect()->route('pelabuhan-surat-masuk.index')
            ->with('success', 'PelabuhanSuratMasuk updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pelabuhanSuratMasuk = PelabuhanSuratMasuk::find($id)->delete();

        return redirect()->route('pelabuhan-surat-masuk.index')
            ->with('success', 'PelabuhanSuratMasuk deleted successfully');
    }
}
