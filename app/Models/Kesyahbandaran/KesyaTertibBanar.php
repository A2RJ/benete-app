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
 * App\Models\Kesyahbandaran\KesyaTertibBanar
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
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar query()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar useSearch($withType = false)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereUserId($value)
 * @mixin \Eloquent
 */
class KesyaTertibBanar extends Model
{
  use HasUuids, UseSearch, UseStatistic;

  public $table = 'kesya_tertib_banar';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/tertib_banar');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/tertib_banar');
      }
    });
  }
}
