<?php

namespace App\Models\Pelabuhan;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PelabuhanKeagenan
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
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanKeagenan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanKeagenan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanKeagenan query()
 * @mixin \Eloquent
 */
class PelabuhanKeagenan extends Model
{
  use HasUuids;

  public $table = 'pelabuhan_keagenan';

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
