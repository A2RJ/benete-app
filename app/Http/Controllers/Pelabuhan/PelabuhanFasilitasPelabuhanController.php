<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Models\Pelabuhan\PelabuhanFasilitasPelabuhan;
use Illuminate\Http\Request;

/**
 * Class PelabuhanFasilitasPelabuhanController
 * @package App\Http\Controllers
 */
class PelabuhanFasilitasPelabuhanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request)
    {
        request()->validate(PelabuhanFasilitasPelabuhan::$rules);

        $pelabuhanFasilitasPelabuhan = PelabuhanFasilitasPelabuhan::create($request->all());

        return redirect()->route('pelabuhan-fasilitas-pelabuhan.index')
            ->with('success', 'PelabuhanFasilitasPelabuhan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelabuhanFasilitasPelabuhan = PelabuhanFasilitasPelabuhan::find($id);

        return view('Pelabuhan.fasilitas-pelabuhan.show', compact('pelabuhanFasilitasPelabuhan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelabuhanFasilitasPelabuhan = PelabuhanFasilitasPelabuhan::find($id);

        return view('Pelabuhan.fasilitas-pelabuhan.edit', compact('pelabuhanFasilitasPelabuhan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanFasilitasPelabuhan $pelabuhanFasilitasPelabuhan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PelabuhanFasilitasPelabuhan $pelabuhanFasilitasPelabuhan)
    {
        request()->validate(PelabuhanFasilitasPelabuhan::$rules);

        $pelabuhanFasilitasPelabuhan->update($request->all());

        return redirect()->route('pelabuhan-fasilitas-pelabuhan.index')
            ->with('success', 'PelabuhanFasilitasPelabuhan updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pelabuhanFasilitasPelabuhan = PelabuhanFasilitasPelabuhan::find($id)->delete();

        return redirect()->route('pelabuhan-fasilitas-pelabuhan.index')
            ->with('success', 'PelabuhanFasilitasPelabuhan deleted successfully');
    }
}
