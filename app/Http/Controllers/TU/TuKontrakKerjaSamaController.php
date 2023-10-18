<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Http\Requests\BMN\UpdateValidationRequest;
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
     * @return \Illuminate\Contracts\View\View
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
     * @return \Illuminate\Contracts\View\View
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreValidationRequest $request)
    {
        TuKontrakKerjaSama::create($request->validated());

        return redirect()->route('tu-kontrak-kerja-sama.index')
            ->with('success', 'TuKontrakKerjaSama created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(TuKontrakKerjaSama $tuKontrakKerjaSama)
    { 
        return view('TU.kontrak-kerja-sama.show', compact('tuKontrakKerjaSama'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(TuKontrakKerjaSama $tuKontrakKerjaSama)
    { 
        return view('TU.kontrak-kerja-sama.edit', compact('tuKontrakKerjaSama'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TuKontrakKerjaSama $tuKontrakKerjaSama
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, TuKontrakKerjaSama $tuKontrakKerjaSama)
    {
        $tuKontrakKerjaSama->update($request->validated());

        return redirect()->route('tu-kontrak-kerja-sama.index')
            ->with('success', 'TuKontrakKerjaSama updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(TuKontrakKerjaSama $tuKontrakKerjaSama)
    {
        $tuKontrakKerjaSama->delete();

        return redirect()->route('tu-kontrak-kerja-sama.index')
            ->with('success', 'TuKontrakKerjaSama deleted successfully');
    }
}
