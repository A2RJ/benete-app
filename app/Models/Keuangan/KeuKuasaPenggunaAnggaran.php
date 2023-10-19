<?php

namespace App\Models\Keuangan;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class KeuKuasaPenggunaAnggaran
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
 * @method static \Illuminate\Database\Eloquent\Builder|KeuKuasaPenggunaAnggaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuKuasaPenggunaAnggaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuKuasaPenggunaAnggaran query()
 * @mixin \Eloquent
 */
class KeuKuasaPenggunaAnggaran extends Model
{
  use HasUuids;
  
  public $table = 'keu_kuasa_pengguna_anggaran';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'keuangan/pengguna_anggaran');
    });

    self::updating(function ($model) {
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'keuangan/pengguna_anggaran');
      }
    });
  }
}
