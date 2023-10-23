<?php

namespace App\Models\TU;

use App\Helpers\FileHelper;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class TuSuratKeluar
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
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratKeluar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratKeluar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratKeluar query()
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratKeluar whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratKeluar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratKeluar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratKeluar whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratKeluar whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratKeluar wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratKeluar whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratKeluar whereUpdatedAt($value)
 * @property int $user_id
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratKeluar whereUserId($value)
 * @mixin \Eloquent
 */
class TuSuratKeluar extends Model
{
  use HasUuids;

  public $table = 'tu_surat_keluar';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'tu/surat_keluar');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'tu/surat_keluar');
      }
    });
  }
}
