<?php

namespace App\Models\BMN;

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
 * App\Models\BMN\BmnSmartUupBenete
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
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete query()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete useSearch($withType = false)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnSmartUupBenete whereUserId($value)
 * @mixin \Eloquent
 */
class BmnSmartUupBenete extends Model
{
  use HasUuids, UseSearch, UseStatistic;

  public $table = 'bmn_smart_uup_benete';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'bmn/smart_uup');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'bmn/smart_uup');
      }
    });
  }
}
