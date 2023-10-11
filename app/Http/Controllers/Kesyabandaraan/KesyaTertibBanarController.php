<?php

namespace App\Http\Controllers\Kesyabandaraan;

use App\Http\Controllers\Controller;
use App\Models\Kesyabandaraan\KesyaTertibBanar;
use Illuminate\Http\Request;

/**
 * Class KesyaTertibBanarController
 * @package App\Http\Controllers
 */
class KesyaTertibBanarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kesyaTertibBanars = KesyaTertibBanar::paginate(10);

        return view('kesya-tertib-banar.index', compact('kesyaTertibBanars'))
            ->with('i', (request()->input('page', 1) - 1) * $kesyaTertibBanars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kesyaTertibBanar = new KesyaTertibBanar();
        return view('kesya-tertib-banar.create', compact('kesyaTertibBanar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(KesyaTertibBanar::$rules);

        $kesyaTertibBanar = KesyaTertibBanar::create($request->all());

        return redirect()->route('kesya-tertib-banar.index')
            ->with('success', 'KesyaTertibBanar created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kesyaTertibBanar = KesyaTertibBanar::find($id);

        return view('kesya-tertib-banar.show', compact('kesyaTertibBanar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kesyaTertibBanar = KesyaTertibBanar::find($id);

        return view('kesya-tertib-banar.edit', compact('kesyaTertibBanar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaTertibBanar $kesyaTertibBanar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KesyaTertibBanar $kesyaTertibBanar)
    {
        request()->validate(KesyaTertibBanar::$rules);

        $kesyaTertibBanar->update($request->all());

        return redirect()->route('kesya-tertib-banar.index')
            ->with('success', 'KesyaTertibBanar updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $kesyaTertibBanar = KesyaTertibBanar::find($id)->delete();

        return redirect()->route('kesya-tertib-banar.index')
            ->with('success', 'KesyaTertibBanar deleted successfully');
    }
}
