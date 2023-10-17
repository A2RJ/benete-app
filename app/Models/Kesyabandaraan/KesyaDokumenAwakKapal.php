<?php

namespace App\Models\Kesyabandaraan;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class KesyaDokumenAwakKapal
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
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal query()
 * @mixin \Eloquent
 */
class KesyaDokumenAwakKapal extends Model
{
  use HasUuids;
  
  public $table = 'kesya_dokumen_awak_kapal';

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
