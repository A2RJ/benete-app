<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Pelabuhan\PelabuhanLala;

/**
 * Class PelabuhanLalaController
 * @package App\Http\Controllers
 */
class PelabuhanLalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pelabuhanLalas = PelabuhanLala::paginate(10);

        return view('Pelabuhan.lala.index', compact('pelabuhanLalas'))
            ->with('i', (request()->input('page', 1) - 1) * $pelabuhanLalas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $pelabuhanLala = new PelabuhanLala();
        return view('Pelabuhan.lala.create', compact('pelabuhanLala'));
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
        PelabuhanLala::create($payload);

        return redirect()->route('pelabuhan-lala.index')
            ->with('success', 'PelabuhanLala created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(PelabuhanLala $pelabuhanLala)
    {
        return view('Pelabuhan.lala.show', compact('pelabuhanLala'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(PelabuhanLala $pelabuhanLala)
    {
        return view('Pelabuhan.lala.edit', compact('pelabuhanLala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanLala $pelabuhanLala
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, PelabuhanLala $pelabuhanLala)
    {
        $pelabuhanLala->update($request->validated());

        return redirect()->route('pelabuhan-lala.index')
            ->with('success', 'PelabuhanLala updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(PelabuhanLala $pelabuhanLala)
    {
        $pelabuhanLala->delete();

        return redirect()->route('pelabuhan-lala.index')
            ->with('success', 'PelabuhanLala deleted successfully');
    }
}
