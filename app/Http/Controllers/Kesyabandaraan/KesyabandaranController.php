<?php

namespace App\Http\Controllers\Kesyabandaraan;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Models\Kesyabandaraan\Kesyabandaran;
use Illuminate\Http\Request;

/**
 * Class KesyabandaranController
 * @package App\Http\Controllers
 */
class KesyabandaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request)
    {
        request()->validate(Kesyabandaran::$rules);

        $kesyabandaran = Kesyabandaran::create($request->all());

        return redirect()->route('kesya-kesyabandaran.index')
            ->with('success', 'Kesyabandaran created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kesyabandaran = Kesyabandaran::find($id);

        return view('Kesya.kesyabandaran.show', compact('kesyabandaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kesyabandaran = Kesyabandaran::find($id);

        return view('Kesya.kesyabandaran.edit', compact('kesyabandaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Kesyabandaran $kesyabandaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kesyabandaran $kesyabandaran)
    {
        request()->validate(Kesyabandaran::$rules);

        $kesyabandaran->update($request->all());

        return redirect()->route('kesya-kesyabandaran.index')
            ->with('success', 'Kesyabandaran updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $kesyabandaran = Kesyabandaran::find($id)->delete();

        return redirect()->route('kesya-kesyabandaran.index')
            ->with('success', 'Kesyabandaran deleted successfully');
    }
}
