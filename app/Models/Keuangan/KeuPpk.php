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
 * Class KeuPpk
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
 * @method static \Illuminate\Database\Eloquent\Builder|KeuPpk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuPpk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuPpk query()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuPpk whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuPpk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuPpk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuPpk whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuPpk whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuPpk wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuPpk whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuPpk whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class KeuPpk extends Model
{
  use HasUuids;

  public $table = 'keu_ppk';

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

  public static function boot()
  {
    parent::boot();

    self::creating(function ($model) {
      $model->user_id = Auth::id();
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'keuangan/ppk');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'keuangan/ppk');
      }
    });
  }
}
