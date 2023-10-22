<?php

namespace App\Http\Controllers\Kesyabandaraan;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Kesyabandaraan\Kesyabandaran;

/**
 * Class KesyabandaranController
 * @package App\Http\Controllers
 */
class KesyabandaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kesyabandaran = Kesyabandaran::paginate(10);

        return view('Kesya.kesyabandaran.index', compact('kesyabandaran'))
            ->with('i', (request()->input('page', 1) - 1) * $kesyabandaran->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $kesyabandaran = new Kesyabandaran();
        return view('Kesya.kesyabandaran.create', compact('kesyabandaran'));
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
        Kesyabandaran::create($payload);

        return redirect()->route('kesya-kesyabandaran.index')
            ->with('success', 'Kesyabandaran created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Kesyabandaran $kesyabandaran)
    {
        return view('Kesya.kesyabandaran.show', compact('kesyabandaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Kesyabandaran $kesyabandaran)
    {
        return view('Kesya.kesyabandaran.edit', compact('kesyabandaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Kesyabandaran $kesyabandaran
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, Kesyabandaran $kesyabandaran)
    {
        $kesyabandaran->update($request->validated());

        return redirect()->route('kesya-kesyabandaran.index')
            ->with('success', 'Kesyabandaran updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Kesyabandaran $kesyabandaran)
    {
        $kesyabandaran->delete();

        return redirect()->route('kesya-kesyabandaran.index')
            ->with('success', 'Kesyabandaran deleted successfully');
    }
}
