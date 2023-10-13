<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Models\TU\TuSuratMasuk;
use Illuminate\Http\Request;

/**
 * Class TuSuratMasukController
 * @package App\Http\Controllers
 */
class TuSuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tuSuratMasuks = TuSuratMasuk::paginate(10);

        return view('TU.surat-masuk.index', compact('tuSuratMasuks'))
            ->with('i', (request()->input('page', 1) - 1) * $tuSuratMasuks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tuSuratMasuk = new TuSuratMasuk();
        return view('TU.surat-masuk.create', compact('tuSuratMasuk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TuSuratMasuk::$rules);

        $tuSuratMasuk = TuSuratMasuk::create($request->all());

        return redirect()->route('tu-surat-masuk.index')
            ->with('success', 'TuSuratMasuk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tuSuratMasuk = TuSuratMasuk::find($id);

        return view('TU.surat-masuk.show', compact('tuSuratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tuSuratMasuk = TuSuratMasuk::find($id);

        return view('TU.surat-masuk.edit', compact('tuSuratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TuSuratMasuk $tuSuratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TuSuratMasuk $tuSuratMasuk)
    {
        request()->validate(TuSuratMasuk::$rules);

        $tuSuratMasuk->update($request->all());

        return redirect()->route('tu-surat-masuk.index')
            ->with('success', 'TuSuratMasuk updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tuSuratMasuk = TuSuratMasuk::find($id)->delete();

        return redirect()->route('tu-surat-masuk.index')
            ->with('success', 'TuSuratMasuk deleted successfully');
    }
}
