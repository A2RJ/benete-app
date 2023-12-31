<?php

namespace App\Http\Controllers\BMN;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\BMN\BmnSmartUupBenete;

/**
 * Class BmnSmartUupBeneteController
 * @package App\Http\Controllers
 */
class BmnSmartUupBeneteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $bmnSmartUupBenetes = BmnSmartUupBenete::useSearch();
        $ids = $bmnSmartUupBenetes->pluck('id')->toArray();

        return view('BMN.smart-uup-benete.index')
            ->with('bmnSmartUupBenetes', $bmnSmartUupBenetes->paginate(10))
            ->with('export', count($ids) ? route('export-data', ['ids' => implode(',', $ids), 'model' => 'bmn_smart_uup_benete']) : false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreValidationRequest $request)
    {
        $payload = $request->validated();
        BmnSmartUupBenete::create($payload);

        return redirect()->route('bmn-smart-uup-benete.index')
            ->with('success', 'BmnSmartUupBenete created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(BmnSmartUupBenete $bmnSmartUupBenete)
    {
        return view('BMN.smart-uup-benete.show', compact('bmnSmartUupBenete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(BmnSmartUupBenete $bmnSmartUupBenete)
    {
        return view('BMN.smart-uup-benete.edit', compact('bmnSmartUupBenete'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BmnSmartUupBenete $bmnSmartUupBenete
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, BmnSmartUupBenete $bmnSmartUupBenete)
    {
        $payload = $request->validated();
        $bmnSmartUupBenete->update($payload);

        return redirect()->route('bmn-smart-uup-benete.index')
            ->with('success', 'BmnSmartUupBenete updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(BmnSmartUupBenete $bmnSmartUupBenete)
    {
        $bmnSmartUupBenete->delete();

        return redirect()->route('bmn-smart-uup-benete.index')
            ->with('success', 'BmnSmartUupBenete deleted successfully');
    }
}
