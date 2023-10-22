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
 * Class Kesyabandaran
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
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyabandaran whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Kesyabandaran extends Model
{
  use HasUuids;

  public $table = 'kesyabandaran';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/kesyabandaraan');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/kesyabandaraan');
      }
    });
  }
}
