<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Http\Requests\BMN\UpdateValidationRequest;
use App\Models\Pelabuhan\PelabuhanLala;
use Illuminate\Http\Request;

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
        request()->validate(PelabuhanLala::$rules);

        $pelabuhanLala = PelabuhanLala::create($request->all());

        return redirect()->route('pelabuhan-lala.index')
            ->with('success', 'PelabuhanLala created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $pelabuhanLala = PelabuhanLala::find($id);

        return view('Pelabuhan.lala.show', compact('pelabuhanLala'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $pelabuhanLala = PelabuhanLala::find($id);

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
        request()->validate(PelabuhanLala::$rules);

        $pelabuhanLala->update($request->all());

        return redirect()->route('pelabuhan-lala.index')
            ->with('success', 'PelabuhanLala updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pelabuhanLala = PelabuhanLala::find($id)->delete();

        return redirect()->route('pelabuhan-lala.index')
            ->with('success', 'PelabuhanLala deleted successfully');
    }
}
