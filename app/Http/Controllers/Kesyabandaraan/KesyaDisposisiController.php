<?php

namespace App\Http\Controllers\Kesyabandaraan;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
use App\Http\Requests\BMN\UpdateValidationRequest;
use App\Models\Kesyabandaraan\KesyaDisposisi;
use Illuminate\Http\Request;

/**
 * Class KesyaDisposisiController
 * @package App\Http\Controllers
 */
class KesyaDisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $kesyaDisposisis = KesyaDisposisi::paginate(10);

        return view('Kesya.disposisi.index', compact('kesyaDisposisis'))
            ->with('i', (request()->input('page', 1) - 1) * $kesyaDisposisis->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $kesyaDisposisi = new KesyaDisposisi();
        return view('Kesya.disposisi.create', compact('kesyaDisposisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreValidationRequest $request)
    {
        KesyaDisposisi::create($request->validated());

        return redirect()->route('kesya-disposisi.index')
            ->with('success', 'KesyaDisposisi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(KesyaDisposisi $kesyaDisposisi)
    {
        return view('Kesya.disposisi.show', compact('kesyaDisposisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(KesyaDisposisi $kesyaDisposisi)
    {
        return view('Kesya.disposisi.edit', compact('kesyaDisposisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaDisposisi $kesyaDisposisi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateValidationRequest $request, KesyaDisposisi $kesyaDisposisi)
    {
        $kesyaDisposisi->update($request->validated());

        return redirect()->route('kesya-disposisi.index')
            ->with('success', 'KesyaDisposisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KesyaDisposisi $kesyaDisposisi)
    {
        $kesyaDisposisi->delete();

        return redirect()->route('kesya-disposisi.index')
            ->with('success', 'KesyaDisposisi deleted successfully');
    }
}
