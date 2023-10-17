<?php

namespace App\Models\Pelabuhan;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PelabuhanFasilitasPelabuhan
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
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan query()
 * @mixin \Eloquent
 */
class PelabuhanFasilitasPelabuhan extends Model
{
  use HasUuids;

  public $table = 'pelabuhan_fasilitas_pelabuhan';

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
