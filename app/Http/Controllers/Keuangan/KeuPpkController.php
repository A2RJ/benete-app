<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Http\Requests\BMN\UpdateValidationRequest;
use App\Models\Keuangan\KeuPpk;
use Illuminate\Http\Request;

/**
 * Class KeuPpkController
 * @package App\Http\Controllers
 */
class KeuPpkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $keuPpks = KeuPpk::paginate(10);

        return view('Keuangan.ppk.index', compact('keuPpks'))
            ->with('i', (request()->input('page', 1) - 1) * $keuPpks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $keuPpk = new KeuPpk();
        return view('Keuangan.ppk.create', compact('keuPpk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreValidationRequest $request)
    {
        KeuPpk::create($request->validated());

        return redirect()->route('keu-ppk.index')
            ->with('success', 'KeuPpk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KeuPpk $keuPpk)
    {
        return view('Keuangan.ppk.show', compact('keuPpk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KeuPpk $keuPpk)
    {
        return view('Keuangan.ppk.edit', compact('keuPpk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuPpk $keuPpk
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KeuPpk $keuPpk)
    {
        $keuPpk->update($request->validated());

        return redirect()->route('keu-ppk.index')
            ->with('success', 'KeuPpk updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KeuPpk $keuPpk)
    {
        $keuPpk->delete();

        return redirect()->route('keu-ppk.index')
            ->with('success', 'KeuPpk deleted successfully');
    }
}
