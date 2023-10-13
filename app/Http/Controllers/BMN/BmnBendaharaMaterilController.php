<?php

namespace App\Http\Controllers\BMN;

use App\Http\Controllers\Controller;
use App\Models\BMN\BmnBendaharaMateril;
use Illuminate\Http\Request;

/**
 * Class BmnBendaharaMaterilController
 * @package App\Http\Controllers
 */
class BmnBendaharaMaterilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bmnBendaharaMaterils = BmnBendaharaMateril::paginate(10);

        return view('BMN.bendahara-materil.index', compact('bmnBendaharaMaterils'))
            ->with('i', (request()->input('page', 1) - 1) * $bmnBendaharaMaterils->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bmnBendaharaMateril = new BmnBendaharaMateril();
        return view('BMN.bendahara-materil.create', compact('bmnBendaharaMateril'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BmnBendaharaMateril::$rules);

        $bmnBendaharaMateril = BmnBendaharaMateril::create($request->all());

        return redirect()->route('bmn-bendahara-materils.index')
            ->with('success', 'BmnBendaharaMateril created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bmnBendaharaMateril = BmnBendaharaMateril::find($id);

        return view('BMN.bendahara-materil.show', compact('bmnBendaharaMateril'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bmnBendaharaMateril = BmnBendaharaMateril::find($id);

        return view('BMN.bendahara-materil.edit', compact('bmnBendaharaMateril'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BmnBendaharaMateril $bmnBendaharaMateril
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BmnBendaharaMateril $bmnBendaharaMateril)
    {
        request()->validate(BmnBendaharaMateril::$rules);

        $bmnBendaharaMateril->update($request->all());

        return redirect()->route('bmn-bendahara-materils.index')
            ->with('success', 'BmnBendaharaMateril updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bmnBendaharaMateril = BmnBendaharaMateril::find($id)->delete();

        return redirect()->route('bmn-bendahara-materils.index')
            ->with('success', 'BmnBendaharaMateril deleted successfully');
    }
}
