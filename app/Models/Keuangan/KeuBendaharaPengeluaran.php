<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class KeuBendaharaPengeluaran
 *
 * @property $id
 * @property $nama
 * @property $tanggal_masuk
 * @property $asal
 * @property $perihal
 * @property $lampiran
 * @property $created_at
 * @property $updated_at
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran query()
 * @mixin \Eloquent
 */
class KeuBendaharaPengeluaran extends Model
{
  use HasUuids;
  
  public $table = 'keu_bendahara_pengeluaran';

  static $rules = [
    'nama' => 'required',
    'tanggal_masuk' => 'required|date',
    'asal' => 'required',
    'perihal' => 'required',
    'lampiran' => 'required|file',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['nama', 'tanggal_masuk', 'asal', 'perihal', 'lampiran'];
}
