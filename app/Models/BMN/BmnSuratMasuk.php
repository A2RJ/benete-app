<?php

namespace App\Models\BMN;

use App\Helpers\FileHelper;
use App\Models\User;
use App\Trait\Models\UseSearch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class BmnSuratMasuk
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
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk query()
 * @property-read \App\Models\BMN\BmnDisposisi|null $disposisi
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereUpdatedAt($value)
 * @property int $user_id
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratMasuk useSearch($withType = false)
 * @mixin \Eloquent
 */
class BmnSuratMasuk extends Model
{
  use HasUuids, UseSearch;

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
