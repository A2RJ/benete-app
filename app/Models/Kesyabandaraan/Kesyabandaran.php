<?php

namespace App\Models\Kesyabandaraan;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Kesyabandaran
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
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran query()
 * @mixin \Eloquent
 */
class Kesyabandaran extends Model
{
  use HasUuids;
  
  public $table = 'kesyabandaran';

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

  public static function boot()
  {
    parent::boot();

    self::creating(function ($model) {
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/kesyabandaraan');
    });

    self::updating(function ($model) {
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/kesyabandaraan');
      }
    });
  }
}
