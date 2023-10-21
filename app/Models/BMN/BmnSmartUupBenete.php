<?php

namespace App\Models\BMN;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

/**
 * Class BmnSmartUupBenete
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
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete query()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BmnSmartUupBenete extends Model
{
  use HasUuids;

  public $table = 'bmn_smart_uup_benete';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'bmn/smart_uup');
    });

    self::updating(function ($model) {
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'bmn/smart_uup');
      }
    });
  }
}
