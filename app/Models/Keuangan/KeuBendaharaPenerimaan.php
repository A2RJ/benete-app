<?php

namespace App\Models\Keuangan;

use App\Helpers\FileHelper;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class KeuBendaharaPenerimaan
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
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPenerimaan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPenerimaan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPenerimaan query()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPenerimaan whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPenerimaan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPenerimaan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPenerimaan whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPenerimaan whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPenerimaan wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPenerimaan whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPenerimaan whereUpdatedAt($value)
 * @property int $user_id
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|KeuBendaharaPenerimaan whereUserId($value)
 * @mixin \Eloquent
 */
class KeuBendaharaPenerimaan extends Model
{
  use HasUuids;

  public $table = 'keu_bendahara_penerimaan';

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['user_id', 'nama', 'tanggal_masuk', 'asal', 'perihal', 'lampiran'];

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

  public function user()
  {
    return $this->belongsTo(User::class)->withTrashed();
  }

  protected static function booted(): void
  {
    self::creating(function ($model) {
      $model->user_id = Auth::id();
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'keuangan/bendahara_penerimaan');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'keuangan/bendahara_penerimaan');
      }
    });
  }
}
