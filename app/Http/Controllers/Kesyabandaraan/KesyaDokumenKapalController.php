<?php

namespace App\Http\Controllers\Kesyabandaraan;

use App\Http\Controllers\Controller;
use App\Models\Kesyabandaraan\KesyaDokumenKapal;
use Illuminate\Http\Request;

/**
 * Class KesyaDokumenKapalController
 * @package App\Http\Controllers
 */
class KesyaDokumenKapalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kesyaDokumenKapals = KesyaDokumenKapal::paginate(10);

        return view('Kesya.dokumen-kapal.index', compact('kesyaDokumenKapals'))
            ->with('i', (request()->input('page', 1) - 1) * $kesyaDokumenKapals->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kesyaDokumenKapal = new KesyaDokumenKapal();
        return view('Kesya.dokumen-kapal.create', compact('kesyaDokumenKapal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(KesyaDokumenKapal::$rules);

        $kesyaDokumenKapal = KesyaDokumenKapal::create($request->all());

        return redirect()->route('kesya-dokumen-kapal.index')
            ->with('success', 'KesyaDokumenKapal created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kesyaDokumenKapal = KesyaDokumenKapal::find($id);

        return view('Kesya.dokumen-kapal.show', compact('kesyaDokumenKapal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kesyaDokumenKapal = KesyaDokumenKapal::find($id);

        return view('Kesya.dokumen-kapal.edit', compact('kesyaDokumenKapal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaDokumenKapal $kesyaDokumenKapal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KesyaDokumenKapal $kesyaDokumenKapal)
    {
        request()->validate(KesyaDokumenKapal::$rules);

        $kesyaDokumenKapal->update($request->all());

        return redirect()->route('kesya-dokumen-kapal.index')
            ->with('success', 'KesyaDokumenKapal updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $kesyaDokumenKapal = KesyaDokumenKapal::find($id)->delete();

        return redirect()->route('kesya-dokumen-kapal.index')
            ->with('success', 'KesyaDokumenKapal deleted successfully');
    }
}
