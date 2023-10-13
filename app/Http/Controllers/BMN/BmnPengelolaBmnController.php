<?php

namespace App\Http\Controllers\BMN;

use App\Http\Controllers\Controller;
use App\Models\BMN\BmnPengelolaBmn;
use Illuminate\Http\Request;

/**
 * Class BmnPengelolaBmnController
 * @package App\Http\Controllers
 */
class BmnPengelolaBmnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bmnPengelolaBmns = BmnPengelolaBmn::paginate(10);

        return view('BMN.pengelola-bmn.index', compact('bmnPengelolaBmns'))
            ->with('i', (request()->input('page', 1) - 1) * $bmnPengelolaBmns->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bmnPengelolaBmn = new BmnPengelolaBmn();
        return view('BMN.pengelola-bmn.create', compact('bmnPengelolaBmn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BmnPengelolaBmn::$rules);

        $bmnPengelolaBmn = BmnPengelolaBmn::create($request->all());

        return redirect()->route('bmn-pengelola-bmns.index')
            ->with('success', 'BmnPengelolaBmn created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bmnPengelolaBmn = BmnPengelolaBmn::find($id);

        return view('BMN.pengelola-bmn.show', compact('bmnPengelolaBmn'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bmnPengelolaBmn = BmnPengelolaBmn::find($id);

        return view('BMN.pengelola-bmn.edit', compact('bmnPengelolaBmn'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BmnPengelolaBmn $bmnPengelolaBmn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BmnPengelolaBmn $bmnPengelolaBmn)
    {
        request()->validate(BmnPengelolaBmn::$rules);

        $bmnPengelolaBmn->update($request->all());

        return redirect()->route('bmn-pengelola-bmns.index')
            ->with('success', 'BmnPengelolaBmn updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bmnPengelolaBmn = BmnPengelolaBmn::find($id)->delete();

        return redirect()->route('bmn-pengelola-bmns.index')
            ->with('success', 'BmnPengelolaBmn deleted successfully');
    }
}
