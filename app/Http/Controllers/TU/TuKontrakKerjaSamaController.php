<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Models\TU\TuKontrakKerjaSama;
use Illuminate\Http\Request;

/**
 * Class TuKontrakKerjaSamaController
 * @package App\Http\Controllers
 */
class TuKontrakKerjaSamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tuKontrakKerjaSamas = TuKontrakKerjaSama::paginate(10);

        return view('TU.kontrak-kerja-sama.index', compact('tuKontrakKerjaSamas'))
            ->with('i', (request()->input('page', 1) - 1) * $tuKontrakKerjaSamas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tuKontrakKerjaSama = new TuKontrakKerjaSama();
        return view('TU.kontrak-kerja-sama.create', compact('tuKontrakKerjaSama'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request)
    {
        request()->validate(TuKontrakKerjaSama::$rules);

        $tuKontrakKerjaSama = TuKontrakKerjaSama::create($request->all());

        return redirect()->route('tu-kontrak-kerja-sama.index')
            ->with('success', 'TuKontrakKerjaSama created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tuKontrakKerjaSama = TuKontrakKerjaSama::find($id);

        return view('TU.kontrak-kerja-sama.show', compact('tuKontrakKerjaSama'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tuKontrakKerjaSama = TuKontrakKerjaSama::find($id);

        return view('TU.kontrak-kerja-sama.edit', compact('tuKontrakKerjaSama'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TuKontrakKerjaSama $tuKontrakKerjaSama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TuKontrakKerjaSama $tuKontrakKerjaSama)
    {
        request()->validate(TuKontrakKerjaSama::$rules);

        $tuKontrakKerjaSama->update($request->all());

        return redirect()->route('tu-kontrak-kerja-sama.index')
            ->with('success', 'TuKontrakKerjaSama updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tuKontrakKerjaSama = TuKontrakKerjaSama::find($id)->delete();

        return redirect()->route('tu-kontrak-kerja-sama.index')
            ->with('success', 'TuKontrakKerjaSama deleted successfully');
    }
}
