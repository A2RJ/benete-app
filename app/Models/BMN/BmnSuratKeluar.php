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
 * App\Models\BMN\BmnSuratKeluar
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
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar query()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar useSearch($withType = false)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSuratKeluar whereUserId($value)
 * @mixin \Eloquent
 */
class BmnSuratKeluar extends Model
{
  use HasUuids, UseSearch, UseStatistic;

  public $table = 'bmn_surat_keluar';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'bmn/surat_keluar');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'bmn/surat_keluar');
      }
    });
  }
}
