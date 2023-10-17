<?php

namespace App\Http\Controllers\Kesyabandaraan;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMN\StoreValidationRequest;
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreValidationRequest $request)
    {
        request()->validate(KesyaDisposisi::$rules);

        $kesyaDisposisi = KesyaDisposisi::create($request->all());

        return redirect()->route('kesya-disposisi.index')
            ->with('success', 'KesyaDisposisi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kesyaDisposisi = KesyaDisposisi::find($id);

        return view('Kesya.disposisi.show', compact('kesyaDisposisi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kesyaDisposisi = KesyaDisposisi::find($id);

        return view('Kesya.disposisi.edit', compact('kesyaDisposisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaDisposisi $kesyaDisposisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KesyaDisposisi $kesyaDisposisi)
    {
        request()->validate(KesyaDisposisi::$rules);

        $kesyaDisposisi->update($request->all());

        return redirect()->route('kesya-disposisi.index')
            ->with('success', 'KesyaDisposisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $kesyaDisposisi = KesyaDisposisi::find($id)->delete();

        return redirect()->route('kesya-disposisi.index')
            ->with('success', 'KesyaDisposisi deleted successfully');
    }
}
