<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(KeuDisposisi::$rules);

        $keuDisposisi = KeuDisposisi::create($request->all());

        return redirect()->route('keu-disposisi.index')
            ->with('success', 'KeuDisposisi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keuDisposisi = KeuDisposisi::find($id);

        return view('Keu.disposisi.show', compact('keuDisposisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keuDisposisi = KeuDisposisi::find($id);

        return view('Keu.disposisi.edit', compact('keuDisposisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuDisposisi $keuDisposisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeuDisposisi $keuDisposisi)
    {
        request()->validate(KeuDisposisi::$rules);

        $keuDisposisi->update($request->all());

        return redirect()->route('keu-disposisi.index')
            ->with('success', 'KeuDisposisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $keuDisposisi = KeuDisposisi::find($id)->delete();

        return redirect()->route('keu-disposisi.index')
            ->with('success', 'KeuDisposisi deleted successfully');
    }
}
