<?php

namespace App\Http\Controllers\Kesyahbandaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Models\Kesyahbandaran\KesyaTertibBanar;

/**
 * Class KesyaTertibBanarController
 * @package App\Http\Controllers
 */
class KesyaTertibBanarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kesyaTertibBanars = KesyaTertibBanar::paginate(10);

        return view('Kesya.tertib-banar.index', compact('kesyaTertibBanars'))
            ->with('i', (request()->input('page', 1) - 1) * $kesyaTertibBanars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $kesyaTertibBanar = new KesyaTertibBanar();
        return view('Kesya.tertib-banar.create', compact('kesyaTertibBanar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreValidationRequest $request)
    {
        $payload = $request->validated();
        KesyaTertibBanar::create($payload);

        return redirect()->route('kesya-tertib-banar.index')
            ->with('success', 'KesyaTertibBanar created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KesyaTertibBanar $kesyaTertibBanar)
    {
        return view('Kesya.tertib-banar.show', compact('kesyaTertibBanar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KesyaTertibBanar $kesyaTertibBanar)
    {
        return view('Kesya.tertib-banar.edit', compact('kesyaTertibBanar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaTertibBanar $kesyaTertibBanar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KesyaTertibBanar $kesyaTertibBanar)
    {
        $kesyaTertibBanar->update($request->validated());

        return redirect()->route('kesya-tertib-banar.index')
            ->with('success', 'KesyaTertibBanar updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KesyaTertibBanar $kesyaTertibBanar)
    {
        $kesyaTertibBanar->delete();

        return redirect()->route('kesya-tertib-banar.index')
            ->with('success', 'KesyaTertibBanar deleted successfully');
    }
}
