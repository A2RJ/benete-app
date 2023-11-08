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
 * App\Models\Kesyahbandaran\KesyaDokumenAwakKapal
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
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal query()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal useSearch($withType = false)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenAwakKapal whereUserId($value)
 * @mixin \Eloquent
 */
class KesyaDokumenAwakKapal extends Model
{
  use HasUuids, UseSearch, UseStatistic;

  public $table = 'kesya_dokumen_awak_kapal';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/dokumen_awak_kapal');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/dokumen_awak_kapal');
      }
    });
  }
}
