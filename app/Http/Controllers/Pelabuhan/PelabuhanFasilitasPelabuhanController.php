<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Pelabuhan\PelabuhanFasilitasPelabuhan;

/**
 * Class PelabuhanFasilitasPelabuhanController
 * @package App\Http\Controllers
 */
class PelabuhanFasilitasPelabuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pelabuhanFasilitasPelabuhans = PelabuhanFasilitasPelabuhan::paginate(10);

        return view('Pelabuhan.fasilitas-pelabuhan.index', compact('pelabuhanFasilitasPelabuhans'))
            ->with('i', (request()->input('page', 1) - 1) * $pelabuhanFasilitasPelabuhans->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $pelabuhanFasilitasPelabuhan = new PelabuhanFasilitasPelabuhan();
        return view('Pelabuhan.fasilitas-pelabuhan.create', compact('pelabuhanFasilitasPelabuhan'));
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
        PelabuhanFasilitasPelabuhan::create($payload);

        return redirect()->route('pelabuhan-fasilitas-pelabuhan.index')
            ->with('success', 'PelabuhanFasilitasPelabuhan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(PelabuhanFasilitasPelabuhan $pelabuhanFasilitasPelabuhan)
    {
        return view('Pelabuhan.fasilitas-pelabuhan.show', compact('pelabuhanFasilitasPelabuhan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(PelabuhanFasilitasPelabuhan $pelabuhanFasilitasPelabuhan)
    {
        return view('Pelabuhan.fasilitas-pelabuhan.edit', compact('pelabuhanFasilitasPelabuhan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanFasilitasPelabuhan $pelabuhanFasilitasPelabuhan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, PelabuhanFasilitasPelabuhan $pelabuhanFasilitasPelabuhan)
    {
        $pelabuhanFasilitasPelabuhan->update($request->validated());

        return redirect()->route('pelabuhan-fasilitas-pelabuhan.index')
            ->with('success', 'PelabuhanFasilitasPelabuhan updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(PelabuhanFasilitasPelabuhan $pelabuhanFasilitasPelabuhan)
    {
        $pelabuhanFasilitasPelabuhan->delete();

        return redirect()->route('pelabuhan-fasilitas-pelabuhan.index')
            ->with('success', 'PelabuhanFasilitasPelabuhan deleted successfully');
    }
}
