<?php

namespace App\Models\Pelabuhan;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

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
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanLala whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanLala whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanLala whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanLala whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanLala whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanLala wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanLala whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanLala whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PelabuhanLala extends Model
{
  use HasUuids;

  public $table = 'pelabuhan_lala';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'pelabuhan/lala');
    });

    self::updating(function ($model) {
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'pelabuhan/lala');
      }
    });
  }
}
