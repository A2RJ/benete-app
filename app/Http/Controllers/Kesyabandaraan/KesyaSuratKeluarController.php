<?php

namespace App\Http\Controllers\Kesyabandaraan;

use App\Http\Controllers\Controller;
use App\Models\Kesyabandaraan\KesyaSuratKeluar;
use Illuminate\Http\Request;

/**
 * Class KesyaSuratKeluarController
 * @package App\Http\Controllers
 */
class KesyaSuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kesyaSuratKeluars = KesyaSuratKeluar::paginate(10);

        return view('Kesya.surat-keluar.index', compact('kesyaSuratKeluars'))
            ->with('i', (request()->input('page', 1) - 1) * $kesyaSuratKeluars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kesyaSuratKeluar = new KesyaSuratKeluar();
        return view('Kesya.surat-keluar.create', compact('kesyaSuratKeluar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(KesyaSuratKeluar::$rules);

        $kesyaSuratKeluar = KesyaSuratKeluar::create($request->all());

        return redirect()->route('Kesya.surat-keluar.index')
            ->with('success', 'KesyaSuratKeluar created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kesyaSuratKeluar = KesyaSuratKeluar::find($id);

        return view('Kesya.surat-keluar.show', compact('kesyaSuratKeluar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kesyaSuratKeluar = KesyaSuratKeluar::find($id);

        return view('Kesya.surat-keluar.edit', compact('kesyaSuratKeluar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaSuratKeluar $kesyaSuratKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KesyaSuratKeluar $kesyaSuratKeluar)
    {
        request()->validate(KesyaSuratKeluar::$rules);

        $kesyaSuratKeluar->update($request->all());

        return redirect()->route('Kesya.surat-keluar.index')
            ->with('success', 'KesyaSuratKeluar updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $kesyaSuratKeluar = KesyaSuratKeluar::find($id)->delete();

        return redirect()->route('Kesya.surat-keluar.index')
            ->with('success', 'KesyaSuratKeluar deleted successfully');
    }
}
