<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Models\Pelabuhan\PelabuhanKeagenan;
use Illuminate\Http\Request;

/**
 * Class PelabuhanKeagenanController
 * @package App\Http\Controllers
 */
class PelabuhanKeagenanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request)
    {
        request()->validate(PelabuhanKeagenan::$rules);

        $pelabuhanKeagenan = PelabuhanKeagenan::create($request->all());

        return redirect()->route('pelabuhan-keagenan.index')
            ->with('success', 'PelabuhanKeagenan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelabuhanKeagenan = PelabuhanKeagenan::find($id);

        return view('Pelabuhan.keagenan.show', compact('pelabuhanKeagenan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelabuhanKeagenan = PelabuhanKeagenan::find($id);

        return view('Pelabuhan.keagenan.edit', compact('pelabuhanKeagenan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanKeagenan $pelabuhanKeagenan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PelabuhanKeagenan $pelabuhanKeagenan)
    {
        request()->validate(PelabuhanKeagenan::$rules);

        $pelabuhanKeagenan->update($request->all());

        return redirect()->route('pelabuhan-keagenan.index')
            ->with('success', 'PelabuhanKeagenan updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pelabuhanKeagenan = PelabuhanKeagenan::find($id)->delete();

        return redirect()->route('pelabuhan-keagenan.index')
            ->with('success', 'PelabuhanKeagenan deleted successfully');
    }
}
