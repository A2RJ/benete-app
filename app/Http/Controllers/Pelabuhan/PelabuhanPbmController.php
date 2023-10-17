<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Models\Pelabuhan\PelabuhanPbm;
use Illuminate\Http\Request;

/**
 * Class PelabuhanPbmController
 * @package App\Http\Controllers
 */
class PelabuhanPbmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelabuhanPbms = PelabuhanPbm::paginate(10);

        return view('Pelabuhan.pbm.index', compact('pelabuhanPbms'))
            ->with('i', (request()->input('page', 1) - 1) * $pelabuhanPbms->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request)
    {
        request()->validate(PelabuhanPbm::$rules);

        $pelabuhanPbm = PelabuhanPbm::create($request->all());

        return redirect()->route('pelabuhan-pbm.index')
            ->with('success', 'PelabuhanPbm created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelabuhanPbm = PelabuhanPbm::find($id);

        return view('Pelabuhan.pbm.show', compact('pelabuhanPbm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelabuhanPbm = PelabuhanPbm::find($id);

        return view('Pelabuhan.pbm.edit', compact('pelabuhanPbm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanPbm $pelabuhanPbm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PelabuhanPbm $pelabuhanPbm)
    {
        request()->validate(PelabuhanPbm::$rules);

        $pelabuhanPbm->update($request->all());

        return redirect()->route('pelabuhan-pbm.index')
            ->with('success', 'PelabuhanPbm updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pelabuhanPbm = PelabuhanPbm::find($id)->delete();

        return redirect()->route('pelabuhan-pbm.index')
            ->with('success', 'PelabuhanPbm deleted successfully');
    }
}
