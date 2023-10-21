<?php

namespace App\Models\Keuangan;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

/**
 * Class KeuBendaharaPengeluaran
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
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran query()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPengeluaran whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class KeuBendaharaPengeluaran extends Model
{
  use HasUuids;

  public $table = 'keu_bendahara_pengeluaran';

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
      get: function (string | null $value) {
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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'keuangan/bendahara_pengeluaran');
    });

    self::updating(function ($model) {
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'keuangan/bendahara_pengeluaran');
      }
    });
  }
}
