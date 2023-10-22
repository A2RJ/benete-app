<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Pelabuhan\PelabuhanKeagenan;

/**
 * Class PelabuhanKeagenanController
 * @package App\Http\Controllers
 */
class PelabuhanKeagenanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pelabuhanKeagenans = PelabuhanKeagenan::paginate(10);

        return view('Pelabuhan.keagenan.index', compact('pelabuhanKeagenans'))
            ->with('i', (request()->input('page', 1) - 1) * $pelabuhanKeagenans->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $pelabuhanKeagenan = new PelabuhanKeagenan();
        return view('Pelabuhan.keagenan.create', compact('pelabuhanKeagenan'));
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
        PelabuhanKeagenan::create($payload);

        return redirect()->route('pelabuhan-keagenan.index')
            ->with('success', 'PelabuhanKeagenan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(PelabuhanKeagenan $pelabuhanKeagenan)
    {  
        return view('Pelabuhan.keagenan.show', compact('pelabuhanKeagenan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(PelabuhanKeagenan $pelabuhanKeagenan)
    { 
        return view('Pelabuhan.keagenan.edit', compact('pelabuhanKeagenan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanKeagenan $pelabuhanKeagenan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, PelabuhanKeagenan $pelabuhanKeagenan)
    {
        $pelabuhanKeagenan->update($request->validated());

        return redirect()->route('pelabuhan-keagenan.index')
            ->with('success', 'PelabuhanKeagenan updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(PelabuhanKeagenan $pelabuhanKeagenan)
    {
        $pelabuhanKeagenan->delete();

        return redirect()->route('pelabuhan-keagenan.index')
            ->with('success', 'PelabuhanKeagenan deleted successfully');
    }
}
