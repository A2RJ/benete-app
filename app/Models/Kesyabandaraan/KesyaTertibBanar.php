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
 * Class KesyaTertibBanar
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
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar query()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaTertibBanar whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class KesyaTertibBanar extends Model
{
  use HasUuids;

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

  public static function boot()
  {
    parent::boot();

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
