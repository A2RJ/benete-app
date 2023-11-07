<?php

namespace App\Http\Controllers\Kesyahbandaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Kesyahbandaran\KesyabandaranModel;

/**
 * Class KesyahbandaranController
 * @package App\Http\Controllers
 */
class KesyahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kesyahbandaran = KesyabandaranModel::useSearch();
        $ids = $kesyahbandaran->pluck('id')->toArray();

        return view('Kesya.kesyahbandaran.index')
        ->with('kesyahbandaran', $kesyahbandaran->paginate(10))
            ->with('export', count($ids) ? route('export-data', [
                'ids' => implode(',', $ids),
                'model' => 'kesyahbandaran'
            ]) : false);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $kesyahbandaran = new KesyabandaranModel();
        return view('Kesya.kesyahbandaran.create', compact('kesyahbandaran'));
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
        KesyabandaranModel::create($payload);

        return redirect()->route('kesyahbandaran.index')
            ->with('success', 'Kesya created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KesyabandaranModel $kesyahbandaran)
    {
        return view('Kesya.kesyahbandaran.show', compact('kesyahbandaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KesyabandaranModel $kesyahbandaran)
    {
        return view('Kesya.kesyahbandaran.edit', compact('kesyahbandaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyabandaranModel $kesyahbandaran
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KesyabandaranModel $kesyahbandaran)
    {
        $kesyahbandaran->update($request->validated());

        return redirect()->route('kesyahbandaran.index')
            ->with('success', 'Kesya updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KesyabandaranModel $kesyahbandaran)
    {
        $kesyahbandaran->delete();

        return redirect()->route('kesyahbandaran.index')
            ->with('success', 'Kesya deleted successfully');
    }
}
