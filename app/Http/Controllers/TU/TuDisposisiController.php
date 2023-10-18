<?php

namespace App\Http\Controllers\TU;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
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
     * @return \Illuminate\Contracts\View\View
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
     * @return \Illuminate\Contracts\View\View
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $payload = $request->validate(TuDisposisi::$rules);
        TuDisposisi::create($payload);

        return redirect()->route('tu-disposisi.index')
            ->with('success', 'TuDisposisi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(TuDisposisi $tuDisposisi)
    {
        return view('TU.disposisi.show', compact('tuDisposisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(TuDisposisi $tuDisposisi)
    {
        return view('TU.disposisi.edit', compact('tuDisposisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TuDisposisi $tuDisposisi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, TuDisposisi $tuDisposisi)
    {
        $payload = $request->validate(TuDisposisi::$rules);
        $tuDisposisi->update($payload);

        return redirect()->route('tu-disposisi.index')
            ->with('success', 'TuDisposisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(TuDisposisi $tuDisposisi)
    {
        $tuDisposisi->delete();

        return redirect()->route('tu-disposisi.index')
            ->with('success', 'TuDisposisi deleted successfully');
    }
}
