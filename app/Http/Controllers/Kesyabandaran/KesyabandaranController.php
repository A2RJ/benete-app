<?php

namespace App\Http\Controllers\Kesyahbandaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Kesyahbandaran\Kesyahbandaran;

/**
 * Class KesyahbandaranController
 * @package App\Http\Controllers
 */
class KesyahbandaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kesyahbandaran = Kesyahbandaran::paginate(10);

        return view('Kesya.kesyahbandaran.index', compact('kesyahbandaran'))
        ->with('i', (request()->input('page', 1) - 1) * $kesyahbandaran->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $kesyahbandaran = new Kesyahbandaran();
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
        Kesyahbandaran::create($payload);

        return redirect()->route('kesya-kesyahbandaran.index')
        ->with('success', 'Kesyahbandaran created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Kesyahbandaran $kesyahbandaran)
    {
        return view('Kesya.kesyahbandaran.show', compact('kesyahbandaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Kesyahbandaran $kesyahbandaran)
    {
        return view('Kesya.kesyahbandaran.edit', compact('kesyahbandaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Kesyahbandaran $kesyahbandaran
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, Kesyahbandaran $kesyahbandaran)
    {
        $kesyahbandaran->update($request->validated());

        return redirect()->route('kesya-kesyahbandaran.index')
        ->with('success', 'Kesyahbandaran updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Kesyahbandaran $kesyahbandaran)
    {
        $kesyahbandaran->delete();

        return redirect()->route('kesya-kesyahbandaran.index')
        ->with('success', 'Kesyahbandaran deleted successfully');
    }
}
