<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Http\Requests\BMN\UpdateValidationRequest;
use App\Models\Keuangan\KeuDisposisi;
use Illuminate\Http\Request;

/**
 * Class KeuDisposisiController
 * @package App\Http\Controllers
 */
class KeuDisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $keuDisposisis = KeuDisposisi::paginate(10);

        return view('Keu.disposisi.index', compact('keuDisposisis'))
            ->with('i', (request()->input('page', 1) - 1) * $keuDisposisis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $keuDisposisi = new KeuDisposisi();
        return view('Keu.disposisi.create', compact('keuDisposisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreValidationRequest $request)
    {
        KeuDisposisi::create($request->validated());

        return redirect()->route('keu-disposisi.index')
            ->with('success', 'KeuDisposisi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KeuDisposisi $keuDisposisi)
    {
        return view('Keu.disposisi.show', compact('keuDisposisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KeuDisposisi $keuDisposisi)
    {
        return view('Keu.disposisi.edit', compact('keuDisposisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuDisposisi $keuDisposisi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KeuDisposisi $keuDisposisi)
    {
        $keuDisposisi->update($request->validated());

        return redirect()->route('keu-disposisi.index')
            ->with('success', 'KeuDisposisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KeuDisposisi $keuDisposisi)
    {
        $keuDisposisi->delete();

        return redirect()->route('keu-disposisi.index')
            ->with('success', 'KeuDisposisi deleted successfully');
    }
}
