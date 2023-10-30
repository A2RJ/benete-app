<?php

namespace App\Models\BMN;

use App\Helpers\FileHelper;
use App\Models\User;
use App\Trait\Models\UseSearch;
use App\Trait\Models\UseStatistic;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * App\Models\BMN\BmnSuratMasuk
 *
 * @property string $id
 * @property int $user_id
 * @property string $nama
 * @property string $tanggal_masuk
 * @property string $asal
 * @property string $perihal
 * @property string $lampiran
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BMN\BmnDisposisi|null $disposisi
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk query()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk useSearch($withType = false)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereUserId($value)
 * @mixin \Eloquent
 */
class BmnSuratMasuk extends Model
{
  use HasUuids, UseSearch, UseStatistic;

  public $table = 'bmn_surat_masuk';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'bmn/surat_masuk');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'bmn/surat_masuk');
      }
    });
  }

  public function disposisi()
  {
    return $this->hasOne(BmnDisposisi::class);
  }
}
