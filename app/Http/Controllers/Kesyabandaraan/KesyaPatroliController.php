<?php

namespace App\Http\Controllers\Kesyabandaraan;

use App\Http\Controllers\Controller;
use App\Models\Kesyabandaraan\KesyaPatroli;
use Illuminate\Http\Request;

/**
 * Class KesyaPatroliController
 * @package App\Http\Controllers
 */
class KesyaPatroliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kesyaPatrolis = KesyaPatroli::paginate(10);

        return view('kesya-patroli.index', compact('kesyaPatrolis'))
            ->with('i', (request()->input('page', 1) - 1) * $kesyaPatrolis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kesyaPatroli = new KesyaPatroli();
        return view('kesya-patroli.create', compact('kesyaPatroli'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(KesyaPatroli::$rules);

        $kesyaPatroli = KesyaPatroli::create($request->all());

        return redirect()->route('kesya-patroli.index')
            ->with('success', 'KesyaPatroli created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kesyaPatroli = KesyaPatroli::find($id);

        return view('kesya-patroli.show', compact('kesyaPatroli'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kesyaPatroli = KesyaPatroli::find($id);

        return view('kesya-patroli.edit', compact('kesyaPatroli'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaPatroli $kesyaPatroli
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KesyaPatroli $kesyaPatroli)
    {
        request()->validate(KesyaPatroli::$rules);

        $kesyaPatroli->update($request->all());

        return redirect()->route('kesya-patroli.index')
            ->with('success', 'KesyaPatroli updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $kesyaPatroli = KesyaPatroli::find($id)->delete();

        return redirect()->route('kesya-patroli.index')
            ->with('success', 'KesyaPatroli deleted successfully');
    }
}
