<?php

namespace App\Http\Controllers\BMN;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Models\BMN\BmnSuratMasuk;
use Illuminate\Http\Request;

/**
 * Class BmnSuratMasukController
 * @package App\Http\Controllers
 */
class BmnSuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bmnSuratMasuks = BmnSuratMasuk::paginate(10);

        return view('BMN.surat-masuk.index', compact('bmnSuratMasuks'))
            ->with('i', (request()->input('page', 1) - 1) * $bmnSuratMasuks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bmnSuratMasuk = new BmnSuratMasuk();
        return view('BMN.surat-masuk.create', compact('bmnSuratMasuk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request)
    {
        request()->validate(BmnSuratMasuk::$rules);

        $bmnSuratMasuk = BmnSuratMasuk::create($request->all());

        return redirect()->route('bmn-surat-masuks.index')
            ->with('success', 'BmnSuratMasuk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bmnSuratMasuk = BmnSuratMasuk::find($id);

        return view('BMN.surat-masuk.show', compact('bmnSuratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bmnSuratMasuk = BmnSuratMasuk::find($id);

        return view('BMN.surat-masuk.edit', compact('bmnSuratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BmnSuratMasuk $bmnSuratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BmnSuratMasuk $bmnSuratMasuk)
    {
        request()->validate(BmnSuratMasuk::$rules);

        $bmnSuratMasuk->update($request->all());

        return redirect()->route('bmn-surat-masuks.index')
            ->with('success', 'BmnSuratMasuk updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bmnSuratMasuk = BmnSuratMasuk::find($id)->delete();

        return redirect()->route('bmn-surat-masuks.index')
            ->with('success', 'BmnSuratMasuk deleted successfully');
    }
}
