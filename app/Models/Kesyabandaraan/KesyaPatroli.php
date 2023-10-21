<?php

namespace App\Models\Kesyabandaraan;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

/**
 * Class KesyaPatroli
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
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaPatroli newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaPatroli newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaPatroli query()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaPatroli whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaPatroli whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaPatroli whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaPatroli whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaPatroli whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaPatroli wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaPatroli whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaPatroli whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class KesyaPatroli extends Model
{
  use HasUuids;

  public $table = 'kesya_patroli';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/patroli');
    });

    self::updating(function ($model) {
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/patroli');
      }
    });
  }
}
