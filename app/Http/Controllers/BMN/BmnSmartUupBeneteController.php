<?php

namespace App\Http\Controllers\BMN;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Models\BMN\BmnSmartUupBenete;
use Illuminate\Http\Request;

/**
 * Class BmnSmartUupBeneteController
 * @package App\Http\Controllers
 */
class BmnSmartUupBeneteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bmnSmartUupBenetes = BmnSmartUupBenete::paginate(10);

        return view('BMN.smart-uup-benete.index', compact('bmnSmartUupBenetes'))
            ->with('i', (request()->input('page', 1) - 1) * $bmnSmartUupBenetes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bmnSmartUupBenete = new BmnSmartUupBenete();
        return view('BMN.smart-uup-benete.create', compact('bmnSmartUupBenete'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request)
    {
        request()->validate(BmnSmartUupBenete::$rules);

        $bmnSmartUupBenete = BmnSmartUupBenete::create($request->all());

        return redirect()->route('bmn-smart-uup-benetes.index')
            ->with('success', 'BmnSmartUupBenete created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bmnSmartUupBenete = BmnSmartUupBenete::find($id);

        return view('BMN.smart-uup-benete.show', compact('bmnSmartUupBenete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bmnSmartUupBenete = BmnSmartUupBenete::find($id);

        return view('BMN.smart-uup-benete.edit', compact('bmnSmartUupBenete'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BmnSmartUupBenete $bmnSmartUupBenete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BmnSmartUupBenete $bmnSmartUupBenete)
    {
        request()->validate(BmnSmartUupBenete::$rules);

        $bmnSmartUupBenete->update($request->all());

        return redirect()->route('bmn-smart-uup-benetes.index')
            ->with('success', 'BmnSmartUupBenete updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bmnSmartUupBenete = BmnSmartUupBenete::find($id)->delete();

        return redirect()->route('bmn-smart-uup-benetes.index')
            ->with('success', 'BmnSmartUupBenete deleted successfully');
    }
}
