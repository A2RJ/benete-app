<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Models\Pelabuhan\PelabuhanTkbm;
use Illuminate\Http\Request;

/**
 * Class PelabuhanTkbmController
 * @package App\Http\Controllers
 */
class PelabuhanTkbmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelabuhanTkbms = PelabuhanTkbm::paginate(10);

        return view('Pelabuhan.tkbm.index', compact('pelabuhanTkbms'))
            ->with('i', (request()->input('page', 1) - 1) * $pelabuhanTkbms->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelabuhanTkbm = new PelabuhanTkbm();
        return view('Pelabuhan.tkbm.create', compact('pelabuhanTkbm'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(PelabuhanTkbm::$rules);

        $pelabuhanTkbm = PelabuhanTkbm::create($request->all());

        return redirect()->route('pelabuhan-tkbm.index')
            ->with('success', 'PelabuhanTkbm created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelabuhanTkbm = PelabuhanTkbm::find($id);

        return view('Pelabuhan.tkbm.show', compact('pelabuhanTkbm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelabuhanTkbm = PelabuhanTkbm::find($id);

        return view('Pelabuhan.tkbm.edit', compact('pelabuhanTkbm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanTkbm $pelabuhanTkbm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PelabuhanTkbm $pelabuhanTkbm)
    {
        request()->validate(PelabuhanTkbm::$rules);

        $pelabuhanTkbm->update($request->all());

        return redirect()->route('pelabuhan-tkbm.index')
            ->with('success', 'PelabuhanTkbm updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pelabuhanTkbm = PelabuhanTkbm::find($id)->delete();

        return redirect()->route('pelabuhan-tkbm.index')
            ->with('success', 'PelabuhanTkbm deleted successfully');
    }
}
