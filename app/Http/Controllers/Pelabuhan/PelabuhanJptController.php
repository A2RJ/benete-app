<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Pelabuhan\PelabuhanJpt;

/**
 * Class PelabuhanJptController
 * @package App\Http\Controllers
 */
class PelabuhanJptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pelabuhanJpts = PelabuhanJpt::useSearch();
        $ids = $pelabuhanJpts->pluck('id')->toArray();

        return view('Pelabuhan.jpt.index')
        ->with('pelabuhanJpts', $pelabuhanJpts->paginate(10))
            ->with('export', route('export-data', [
                'ids' => implode(',', $ids),
                'model' => 'pelabuhan_jpt'
            ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $pelabuhanJpt = new PelabuhanJpt();
        return view('Pelabuhan.jpt.create', compact('pelabuhanJpt'));
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
        PelabuhanJpt::create($payload);

        return redirect()->route('pelabuhan-jpt.index')
            ->with('success', 'PelabuhanJpt created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(PelabuhanJpt $pelabuhanJpt)
    {
        return view('Pelabuhan.jpt.show', compact('pelabuhanJpt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(PelabuhanJpt $pelabuhanJpt)
    {
        return view('Pelabuhan.jpt.edit', compact('pelabuhanJpt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanJpt $pelabuhanJpt
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, PelabuhanJpt $pelabuhanJpt)
    {
        $payload = $request->validated();
        $pelabuhanJpt->update($payload);

        return redirect()->route('pelabuhan-jpt.index')
            ->with('success', 'PelabuhanJpt updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(PelabuhanJpt $pelabuhanJpt)
    {
        $pelabuhanJpt->delete();

        return redirect()->route('pelabuhan-jpt.index')
            ->with('success', 'PelabuhanJpt deleted successfully');
    }
}
