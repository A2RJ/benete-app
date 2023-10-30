<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Pelabuhan\PelabuhanPbm;

/**
 * Class PelabuhanPbmController
 * @package App\Http\Controllers
 */
class PelabuhanPbmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pelabuhanPbms = PelabuhanPbm::useSearch()->paginate(10);

        return view('Pelabuhan.pbm.index', compact('pelabuhanPbms'))
            ->with('i', (request()->input('page', 1) - 1) * $pelabuhanPbms->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $pelabuhanPbm = new PelabuhanPbm();
        return view('Pelabuhan.pbm.create', compact('pelabuhanPbm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreValidationRequest $request)
    {
        $payload = $request->validated();
        PelabuhanPbm::create($payload);

        return redirect()->route('pelabuhan-pbm.index')
            ->with('success', 'PelabuhanPbm created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(PelabuhanPbm $pelabuhanPbm)
    {
        return view('Pelabuhan.pbm.show', compact('pelabuhanPbm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(PelabuhanPbm $pelabuhanPbm)
    {
        return view('Pelabuhan.pbm.edit', compact('pelabuhanPbm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanPbm $pelabuhanPbm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, PelabuhanPbm $pelabuhanPbm)
    {
        $pelabuhanPbm->update($request->validated());

        return redirect()->route('pelabuhan-pbm.index')
            ->with('success', 'PelabuhanPbm updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(PelabuhanPbm $pelabuhanPbm)
    {
        $pelabuhanPbm->delete();

        return redirect()->route('pelabuhan-pbm.index')
            ->with('success', 'PelabuhanPbm deleted successfully');
    }
}
