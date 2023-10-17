<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Models\TU\TuDisposisi;
use Illuminate\Http\Request;

/**
 * Class TuDisposisiController
 * @package App\Http\Controllers
 */
class TuDisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tuDisposisis = TuDisposisi::paginate(10);

        return view('TU.disposisi.index', compact('tuDisposisis'))
            ->with('i', (request()->input('page', 1) - 1) * $tuDisposisis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tuDisposisi = new TuDisposisi();
        return view('TU.disposisi.create', compact('tuDisposisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request)
    {
        request()->validate(TuDisposisi::$rules);

        $tuDisposisi = TuDisposisi::create($request->all());

        return redirect()->route('tu-disposisi.index')
            ->with('success', 'TuDisposisi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tuDisposisi = TuDisposisi::find($id);

        return view('TU.disposisi.show', compact('tuDisposisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tuDisposisi = TuDisposisi::find($id);

        return view('TU.disposisi.edit', compact('tuDisposisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TuDisposisi $tuDisposisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TuDisposisi $tuDisposisi)
    {
        request()->validate(TuDisposisi::$rules);

        $tuDisposisi->update($request->all());

        return redirect()->route('tu-disposisi.index')
            ->with('success', 'TuDisposisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tuDisposisi = TuDisposisi::find($id)->delete();

        return redirect()->route('tu-disposisi.index')
            ->with('success', 'TuDisposisi deleted successfully');
    }
}
