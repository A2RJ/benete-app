<?php

namespace App\Models\TU;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

/**
 * Class TuKontrakKerjaSama
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
 * @method static \Illuminate\Database\Eloquent\Builder|TuKontrakKerjaSama newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TuKontrakKerjaSama newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TuKontrakKerjaSama query()
 * @method static \Illuminate\Database\Eloquent\Builder|TuKontrakKerjaSama whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuKontrakKerjaSama whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuKontrakKerjaSama whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuKontrakKerjaSama whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuKontrakKerjaSama whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuKontrakKerjaSama wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuKontrakKerjaSama whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuKontrakKerjaSama whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TuKontrakKerjaSama extends Model
{
  use HasUuids;

  public $table = 'tu_kontrak_kerja_sama';

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['nama', 'tanggal_masuk', 'asal', 'perihal', 'lampiran'];

  protected function lampiran(): Attribute
  {
    return Attribute::make(
      get: function (string|null $value) {
        if ($value) {
          $url = URL::signedRoute('download', ['pathToImage' => $value]);
          return "<a href='{$url}'>File</a>";
        }
      },
    );
  }

  public static function boot()
  {
    parent::boot();

    self::creating(function ($model) {
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'tu/kontrak_kerjasama');
    });

    self::updating(function ($model) {
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'tu/kontrak_kerjasama');
      }
    });
  }
}
