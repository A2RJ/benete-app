<?php

namespace App\Http\Controllers\Kesyabandaraan;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
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
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kesyaPatrolis = KesyaPatroli::paginate(10);

        return view('Kesya.patroli.index', compact('kesyaPatrolis'))
            ->with('i', (request()->input('page', 1) - 1) * $kesyaPatrolis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $kesyaPatroli = new KesyaPatroli();
        return view('Kesya.patroli.create', compact('kesyaPatroli'));
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
        KesyaPatroli::create($payload);

        return redirect()->route('kesya-patroli.index')
            ->with('success', 'KesyaPatroli created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KesyaPatroli $kesyaPatroli)
    {
        return view('Kesya.patroli.show', compact('kesyaPatroli'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KesyaPatroli $kesyaPatroli)
    {
        return view('Kesya.patroli.edit', compact('kesyaPatroli'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaPatroli $kesyaPatroli
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KesyaPatroli $kesyaPatroli)
    {
        $kesyaPatroli->update($request->validated());

        return redirect()->route('kesya-patroli.index')
            ->with('success', 'KesyaPatroli updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KesyaPatroli $kesyaPatroli)
    {
        $kesyaPatroli->delete();

        return redirect()->route('kesya-patroli.index')
            ->with('success', 'KesyaPatroli deleted successfully');
    }
}
