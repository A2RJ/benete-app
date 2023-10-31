<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Pelabuhan\PelabuhanTkbm;

/**
 * Class PelabuhanTkbmController
 * @package App\Http\Controllers
 */
class PelabuhanTkbmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pelabuhanTkbms = PelabuhanTkbm::useSearch();
        $ids = $pelabuhanTkbms->pluck('id')->toArray();

        return view('Pelabuhan.tkbm.index')
        ->with('pelabuhanTkbms', $pelabuhanTkbms->paginate(10))
            ->with('export', route('export-data', [
                'ids' => implode(',', $ids),
                'model' => 'pelabuhan_tkbm'
            ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreValidationRequest $request)
    {
        $payload = $request->validated();
        PelabuhanTkbm::create($payload);

        return redirect()->route('pelabuhan-tkbm.index')
            ->with('success', 'PelabuhanTkbm created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(PelabuhanTkbm $pelabuhanTkbm)
    {
        return view('Pelabuhan.tkbm.show', compact('pelabuhanTkbm'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(PelabuhanTkbm $pelabuhanTkbm)
    {
        return view('Pelabuhan.tkbm.edit', compact('pelabuhanTkbm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanTkbm $pelabuhanTkbm
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, PelabuhanTkbm $pelabuhanTkbm)
    {
        $pelabuhanTkbm->update($request->validated());

        return redirect()->route('pelabuhan-tkbm.index')
            ->with('success', 'PelabuhanTkbm updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(PelabuhanTkbm $pelabuhanTkbm)
    {
        $pelabuhanTkbm->delete();

        return redirect()->route('pelabuhan-tkbm.index')
            ->with('success', 'PelabuhanTkbm deleted successfully');
    }
}
