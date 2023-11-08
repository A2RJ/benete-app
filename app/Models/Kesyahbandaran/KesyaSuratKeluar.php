<?php

namespace App\Models\Kesyahbandaran;

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
 * App\Models\Kesyahbandaran\KesyaSuratKeluar
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
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar query()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar useSearch($withType = false)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereUserId($value)
 * @mixin \Eloquent
 */
class KesyaSuratKeluar extends Model
{
  use HasUuids, UseSearch, UseStatistic;

  public $table = 'kesya_surat_keluar';

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
          return "<a href='{$url}' target='_blank'>File</a>";
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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/surat_keluar');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/surat_keluar');
      }
    });
  }
}
