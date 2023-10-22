<?php

namespace App\Models\Kesyabandaraan;

use App\Helpers\FileHelper;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class KesyaSuratKeluar
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
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar query()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaSuratKeluar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class KesyaSuratKeluar extends Model
{
  use HasUuids;

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
