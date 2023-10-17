<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Models\TU\TuSuratTugas;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class TuSuratTugaController
 * @package App\Http\Controllers
 */
class TuSuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tuSuratTugas = TuSuratTugas::sdsdsd(10);

        return view('TU.surat-tugas.index', compact('tuSuratTugas'))
            ->with('i', (request()->input('page', 1) - 1) * $tuSuratTugas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $tuSuratTuga = new TuSuratTugas();
        return view('TU.surat-tugas.create', compact('tuSuratTuga'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request): RedirectResponse
    {
        request()->validate(TuSuratTugas::$rules);

        $tuSuratTuga = TuSuratTugas::create($request->all());

        return redirect()->route('tu-surat-tugas.index')
            ->with('success', 'TuSuratTugas created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $tuSuratTuga = TuSuratTugas::find($id);

        return view('TU.surat-tugas.show', compact('tuSuratTuga'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $tuSuratTuga = TuSuratTugas::find($id);

        return view('TU.surat-tugas.edit', compact('tuSuratTuga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TuSuratTugas $tuSuratTuga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TuSuratTugas $tuSuratTuga): RedirectResponse
    {
        request()->validate(TuSuratTugas::$rules);

        $tuSuratTuga->update($request->all());

        return redirect()->route('tu-surat-tugas.index')
            ->with('success', 'TuSuratTugas updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tuSuratTuga = TuSuratTugas::find($id)->delete();

        return redirect()->route('tu-surat-tugas.index')
            ->with('success', 'TuSuratTugas deleted successfully');
    }
}
