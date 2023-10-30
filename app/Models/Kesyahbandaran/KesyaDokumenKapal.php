<?php

namespace App\Models\Kesyahbandaran;

use App\Helpers\FileHelper;
use App\Models\User;
use App\Trait\Models\UseSearch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class KesyaDokumenKapal
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
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenKapal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenKapal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenKapal query()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenKapal whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenKapal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenKapal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenKapal whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenKapal whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenKapal wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenKapal whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenKapal whereUpdatedAt($value)
 * @property int $user_id
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenKapal whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDokumenKapal useSearch($withType = false)
 * @mixin \Eloquent
 */
class KesyaDokumenKapal extends Model
{
  use HasUuids, UseSearch;

  public $table = 'kesya_dokumen_kapal';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/dokumen_kapal');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/dokumen_kapal');
      }
    });
  }
}
