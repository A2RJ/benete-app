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
 * App\Models\BMN\BmnBendaharaMateril
 *
 * @property string $id
 * @property int $user_id
 * @property string $nama
 * @property string $tipe
 * @property string $tanggal_masuk
 * @property string $asal
 * @property string $perihal
 * @property string $lampiran
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril query()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril useSearch($withType = false)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereTipe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereUserId($value)
 * @mixin \Eloquent
 */
class BmnBendaharaMateril extends Model
{
  use HasUuids, UseSearch, UseStatistic;

  public $table = 'bmn_bendahara_materil';

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['user_id', 'nama', 'tipe', 'tanggal_masuk', 'asal', 'perihal', 'lampiran'];

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'bmn/bendara_materil');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'bmn/bendara_materil');
      }
    });
  }
}
