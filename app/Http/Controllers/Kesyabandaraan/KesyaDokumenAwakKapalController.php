<?php

namespace App\Http\Controllers\Kesyabandaraan;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Models\Kesyabandaraan\KesyaDokumenAwakKapal;
use Illuminate\Http\Request;

/**
 * Class KesyaDokumenAwakKapalController
 * @package App\Http\Controllers
 */
class KesyaDokumenAwakKapalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kesyaDokumenAwakKapals = KesyaDokumenAwakKapal::paginate(10);

        return view('Kesya.dokumen-awak-kapal.index', compact('kesyaDokumenAwakKapals'))
            ->with('i', (request()->input('page', 1) - 1) * $kesyaDokumenAwakKapals->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kesyaDokumenAwakKapal = new KesyaDokumenAwakKapal();
        return view('Kesya.dokumen-awak-kapal.create', compact('kesyaDokumenAwakKapal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request)
    {
        request()->validate(KesyaDokumenAwakKapal::$rules);

        $kesyaDokumenAwakKapal = KesyaDokumenAwakKapal::create($request->all());

        return redirect()->route('kesya-dokumen-awak-kapal.index')
            ->with('success', 'KesyaDokumenAwakKapal created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kesyaDokumenAwakKapal = KesyaDokumenAwakKapal::find($id);

        return view('Kesya.dokumen-awak-kapal.show', compact('kesyaDokumenAwakKapal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kesyaDokumenAwakKapal = KesyaDokumenAwakKapal::find($id);

        return view('Kesya.dokumen-awak-kapal.edit', compact('kesyaDokumenAwakKapal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaDokumenAwakKapal $kesyaDokumenAwakKapal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KesyaDokumenAwakKapal $kesyaDokumenAwakKapal)
    {
        request()->validate(KesyaDokumenAwakKapal::$rules);

        $kesyaDokumenAwakKapal->update($request->all());

        return redirect()->route('kesya-dokumen-awak-kapal.index')
            ->with('success', 'KesyaDokumenAwakKapal updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $kesyaDokumenAwakKapal = KesyaDokumenAwakKapal::find($id)->delete();

        return redirect()->route('kesya-dokumen-awak-kapal.index')
            ->with('success', 'KesyaDokumenAwakKapal deleted successfully');
    }
}
