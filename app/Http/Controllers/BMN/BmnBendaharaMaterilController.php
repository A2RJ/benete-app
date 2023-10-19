<?php

namespace App\Http\Controllers\BMN;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\BMN\BmnBendaharaMateril; 

class BmnBendaharaMaterilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
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
     * @return \Illuminate\Contracts\View\View
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreValidationRequest $request)
    {
        $payload = $request->validated();
        $payload['lampiran'] = FileHelper::upload($request, 'lampiran', 'bmn/bendahara_materil');
        BmnBendaharaMateril::create($payload);

        return redirect()->route('bmn-bendahara-materils.index')
            ->with('success', 'BmnBendaharaMateril created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function show(BmnBendaharaMateril $bmnBendaharaMateril)
    {
        return view('BMN.bendahara-materil.show', compact('bmnBendaharaMateril'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function edit(BmnBendaharaMateril $bmnBendaharaMateril)
    {
        return view('BMN.bendahara-materil.edit', compact('bmnBendaharaMateril'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BmnBendaharaMateril $bmnBendaharaMateril
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, BmnBendaharaMateril $bmnBendaharaMateril)
    {
        $bmnBendaharaMateril->update($request->validated());

        return redirect()->route('bmn-bendahara-materils.index')
            ->with('success', 'BmnBendaharaMateril updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(BmnBendaharaMateril $bmnBendaharaMateril)
    {
        $bmnBendaharaMateril->delete();

        return redirect()->route('bmn-bendahara-materils.index')
            ->with('success', 'BmnBendaharaMateril deleted successfully');
    }
}
