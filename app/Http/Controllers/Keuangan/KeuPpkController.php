<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keuPpks = KeuPpk::paginate(10);

        return view('keu-ppk.index', compact('keuPpks'))
            ->with('i', (request()->input('page', 1) - 1) * $keuPpks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $keuPpk = new KeuPpk();
        return view('keu-ppk.create', compact('keuPpk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(KeuPpk::$rules);

        $keuPpk = KeuPpk::create($request->all());

        return redirect()->route('keu-ppk.index')
            ->with('success', 'KeuPpk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $keuPpk = KeuPpk::find($id);

        return view('keu-ppk.show', compact('keuPpk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $keuPpk = KeuPpk::find($id);

        return view('keu-ppk.edit', compact('keuPpk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KeuPpk $keuPpk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KeuPpk $keuPpk)
    {
        request()->validate(KeuPpk::$rules);

        $keuPpk->update($request->all());

        return redirect()->route('keu-ppk.index')
            ->with('success', 'KeuPpk updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $keuPpk = KeuPpk::find($id)->delete();

        return redirect()->route('keu-ppk.index')
            ->with('success', 'KeuPpk deleted successfully');
    }
}
