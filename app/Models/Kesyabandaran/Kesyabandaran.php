<?php

namespace App\Models\Kesyahbandaran;

use App\Helpers\FileHelper;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class Kesyahbandaran
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
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyahbandaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyahbandaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyahbandaran query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyahbandaran whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyahbandaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyahbandaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyahbandaran whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyahbandaran whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyahbandaran wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyahbandaran whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyahbandaran whereUpdatedAt($value)
 * @property int $user_id
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Kesyahbandaran whereUserId($value)
 * @mixin \Eloquent
 */
class Kesyahbandaran extends Model
{
  use HasUuids;

  public $table = 'kesyahbandaran';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/kesyahbandaran');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'kesya/kesyahbandaran');
      }
    });
  }
}
