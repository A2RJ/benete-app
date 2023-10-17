<?php

namespace App\Models\BMN;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BmnBendaharaMateril
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
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril query()
 * @mixin \Eloquent
 */
class BmnBendaharaMateril extends Model
{
  use HasUuids;
  
  public $table = 'bmn_bendahara_materil';

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
