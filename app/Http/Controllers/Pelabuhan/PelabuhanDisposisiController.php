<?php

namespace App\Http\Controllers\Pelabuhan;

use App\Http\Controllers\Controller;
use App\Models\Pelabuhan\PelabuhanDisposisi;
use Illuminate\Http\Request;

/**
 * Class PelabuhanDisposisiController
 * @package App\Http\Controllers
 */
class PelabuhanDisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelabuhanDisposisis = PelabuhanDisposisi::paginate(10);

        return view('Pelabuhan.disposisi.index', compact('pelabuhanDisposisis'))
            ->with('i', (request()->input('page', 1) - 1) * $pelabuhanDisposisis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelabuhanDisposisi = new PelabuhanDisposisi();
        return view('Pelabuhan.disposisi.create', compact('pelabuhanDisposisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(PelabuhanDisposisi::$rules);

        $pelabuhanDisposisi = PelabuhanDisposisi::create($request->all());

        return redirect()->route('pelabuhan-disposisi.index')
            ->with('success', 'PelabuhanDisposisi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelabuhanDisposisi = PelabuhanDisposisi::find($id);

        return view('Pelabuhan.disposisi.show', compact('pelabuhanDisposisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelabuhanDisposisi = PelabuhanDisposisi::find($id);

        return view('Pelabuhan.disposisi.edit', compact('pelabuhanDisposisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PelabuhanDisposisi $pelabuhanDisposisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PelabuhanDisposisi $pelabuhanDisposisi)
    {
        request()->validate(PelabuhanDisposisi::$rules);

        $pelabuhanDisposisi->update($request->all());

        return redirect()->route('pelabuhan-disposisi.index')
            ->with('success', 'PelabuhanDisposisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $pelabuhanDisposisi = PelabuhanDisposisi::find($id)->delete();

        return redirect()->route('pelabuhan-disposisi.index')
            ->with('success', 'PelabuhanDisposisi deleted successfully');
    }
}
