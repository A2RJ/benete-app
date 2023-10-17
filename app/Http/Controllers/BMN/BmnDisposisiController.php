<?php

namespace App\Http\Controllers\BMN;

use App\Http\Controllers\Controller;
use App\Models\BMN\BmnDisposisi;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class BmnDisposisiController
 * @package App\Http\Controllers
 */
class BmnDisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $bmnDisposisis = BmnDisposisi::paginate(10);

        return view('BMN.disposisi.index', compact('bmnDisposisis'))
            ->with('i', (request()->input('page', 1) - 1) * $bmnDisposisis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $bmnDisposisi = new BmnDisposisi();
        return view('BMN.disposisi.create', compact('bmnDisposisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(BmnDisposisi::$rules);

        $bmnDisposisi = BmnDisposisi::create($request->all());

        return redirect()->route('bmn-disposisi.index')
            ->with('success', 'BmnDisposisi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bmnDisposisi = BmnDisposisi::find($id);

        return view('BMN.disposisi.show', compact('bmnDisposisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bmnDisposisi = BmnDisposisi::find($id);

        return view('BMN.disposisi.edit', compact('bmnDisposisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  BmnDisposisi $bmnDisposisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BmnDisposisi $bmnDisposisi)
    {
        request()->validate(BmnDisposisi::$rules);

        $bmnDisposisi->update($request->all());

        return redirect()->route('bmn-disposisi.index')
            ->with('success', 'BmnDisposisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $bmnDisposisi = BmnDisposisi::find($id)->delete();

        return redirect()->route('bmn-disposisi.index')
            ->with('success', 'BmnDisposisi deleted successfully');
    }
}
