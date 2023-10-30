<?php

namespace App\Models\Keuangan;

use App\Helpers\FileHelper;
use App\Models\User;
use App\Trait\Models\UseSearch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class KeuSuratKeluar
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
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar query()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar whereUpdatedAt($value)
 * @property int $user_id
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar useSearch($withType = false)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuSuratKeluar statistics()
 * @mixin \Eloquent
 */
class KeuSuratKeluar extends Model
{
  use HasUuids, UseSearch;

  public $table = 'keu_surat_keluar';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'keuangan/surat_keluar');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'keuangan/surat_keluar');
      }
    });
  }
}
