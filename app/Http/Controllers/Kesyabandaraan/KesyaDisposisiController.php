<?php

namespace App\Http\Controllers\Kesyabandaraan;

use App\Http\Controllers\Controller;
use App\Http\Requests\DisposisiRequest;
use App\Models\Kesyabandaraan\KesyaDisposisi;
use App\Models\Kesyabandaraan\KesyaSuratMasuk;

/**
 * Class KesyaDisposisiController
 * @package App\Http\Controllers
 */
class KesyaDisposisiController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create($kesyaSuratMasuk)
    {
        $kesyaDisposisi = new KesyaDisposisi();
        $kesyaDisposisi->kesya_surat_masuk_id = $kesyaSuratMasuk;
        return view('Kesya.disposisi.create', compact('kesyaDisposisi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DisposisiRequest $request, KesyaSuratMasuk $kesyaSuratMasuk)
    {
        $payload = $request->validated();
        $kesyaSuratMasuk->disposisi()->create($payload);

        return redirect()->route('kesya-surat-masuk.index')
            ->with('success', 'KesyaDisposisi created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($kesyaSuratMasuk, KesyaDisposisi $kesyaDisposisi)
    {
        $kesyaDisposisi = $kesyaDisposisi->where('kesya_surat_masuk_id', $kesyaSuratMasuk)->firstOrFail();
        return view('Kesya.disposisi.edit', compact('kesyaDisposisi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  KesyaDisposisi $kesyaDisposisi
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DisposisiRequest $request, $kesyaSuratMasuk, KesyaDisposisi $kesyaDisposisi)
    {
        $payload = $request->validated();
        $kesyaDisposisi->where('kesya_surat_masuk_id', $kesyaSuratMasuk)->update($payload);

        return redirect()->route('kesya-surat-masuk.index')
            ->with('success', 'KesyaDisposisi updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(KesyaSuratMasuk $kesyaSuratMasuk)
    {
        $kesyaSuratMasuk->disposisi()->delete();

        return redirect()->route('kesya-surat-masuk.index')
            ->with('success', 'KesyaDisposisi deleted successfully');
    }
}
