<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\TU\TuSuratTugas;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Class TuSuratTugaController
 * @package App\Http\Controllers
 */
class TuSuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tuSuratTugas = TuSuratTugas::useSearch();
        $ids = $tuSuratTugas->pluck('id')->toArray();

        return view('TU.surat-tugas.index')
        ->with('tuSuratTugas', $tuSuratTugas->paginate(10))
            ->with('export', count($ids) ? route('export-data', [
                'ids' => implode(',', $ids),
                'model' => 'tu_surat_tugas'
            ]) : false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        $tuSuratTugas = new TuSuratTugas();
        return view('TU.surat-tugas.create', compact('tuSuratTugas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreValidationRequest $request): RedirectResponse
    {
        $payload = $request->validated();
        TuSuratTugas::create($payload);

        return redirect()->route('tu-surat-tugas.index')
            ->with('success', 'TuSuratTugas created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(TuSuratTugas $tuSuratTugas): View
    {
        return view('TU.surat-tugas.show', compact('tuSuratTugas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(TuSuratTugas $tuSuratTugas): View
    {
        return view('TU.surat-tugas.edit', compact('tuSuratTugas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TuSuratTugas $tuSuratTugas
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, TuSuratTugas $tuSuratTugas): RedirectResponse
    {
        $tuSuratTugas->update($request->validated());

        return redirect()->route('tu-surat-tugas.index')
            ->with('success', 'TuSuratTugas updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(TuSuratTugas $tuSuratTugas)
    {
        $tuSuratTugas->delete();

        return redirect()->route('tu-surat-tugas.index')
            ->with('success', 'TuSuratTugas deleted successfully');
    }
}
