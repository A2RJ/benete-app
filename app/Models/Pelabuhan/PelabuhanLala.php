<?php

namespace App\Models\Pelabuhan;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PelabuhanLala
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
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanLala newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanLala newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanLala query()
 * @mixin \Eloquent
 */
class PelabuhanLala extends Model
{
  use HasUuids;

  public $table = 'pelabuhan_lala';

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
