<?php

namespace App\Http\Controllers\Kesyabandaraan;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Models\Kesyabandaraan\KesyaSuratMasuk;
use Illuminate\Http\Request;

/**
 * Class KesyaSuratMasukController
 * @package App\Http\Controllers
 */
class KesyaSuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kesyaSuratMasuks = KesyaSuratMasuk::paginate(10);

        return view('Kesya.surat-masuk.index', compact('kesyaSuratMasuks'))
            ->with('i', (request()->input('page', 1) - 1) * $kesyaSuratMasuks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kesyaSuratMasuk = new KesyaSuratMasuk();
        return view('Kesya.surat-masuk.create', compact('kesyaSuratMasuk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request)
    {
        request()->validate(KesyaSuratMasuk::$rules);

        $kesyaSuratMasuk = KesyaSuratMasuk::create($request->all());

        return redirect()->route('kesya-surat-masuk.index')
            ->with('success', 'KesyaSuratMasuk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kesyaSuratMasuk = KesyaSuratMasuk::find($id);

        return view('Kesya.surat-masuk.show', compact('kesyaSuratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kesyaSuratMasuk = KesyaSuratMasuk::find($id);

        return view('Kesya.surat-masuk.edit', compact('kesyaSuratMasuk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaSuratMasuk $kesyaSuratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KesyaSuratMasuk $kesyaSuratMasuk)
    {
        request()->validate(KesyaSuratMasuk::$rules);

        $kesyaSuratMasuk->update($request->all());

        return redirect()->route('kesya-surat-masuk.index')
            ->with('success', 'KesyaSuratMasuk updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $kesyaSuratMasuk = KesyaSuratMasuk::find($id)->delete();

        return redirect()->route('kesya-surat-masuk.index')
            ->with('success', 'KesyaSuratMasuk deleted successfully');
    }
}
