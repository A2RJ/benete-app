<?php

namespace App\Models\Pelabuhan;

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
 * App\Models\Pelabuhan\PelabuhanSuratKeluar
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
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar query()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar useSearch($withType = false)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanSuratKeluar whereUserId($value)
 * @mixin \Eloquent
 */
class PelabuhanSuratKeluar extends Model
{
  use HasUuids, UseSearch, UseStatistic;

  public $table = 'pelabuhan_surat_keluar';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'pelabuhan/surat_keluar');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'pelabuhan/surat_keluar');
      }
    });
  }
}
