<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class KeuBendaharaPenerimaan
 *
 * @property $id
 * @property $nama
 * @property $tanggal_masuk
 * @property $asal
 * @property $perihal
 * @property $lampiran
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class KeuBendaharaPenerimaan extends Model
{
  public $table = 'keu_bendahara_penerimaan';

  static $rules = [
    'nama' => 'required',
    'tanggal_masuk' => 'required',
    'asal' => 'required',
    'perihal' => 'required',
    'lampiran' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['nama', 'tanggal_masuk', 'asal', 'perihal', 'lampiran'];
}
