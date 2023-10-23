<?php

namespace App\Models\BMN;

use App\Helpers\FileHelper;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class BmnBendaharaMateril
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
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril query()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereUpdatedAt($value)
 * @property int $user_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|BmnBendaharaMateril whereUserId($value)
 * @mixin \Eloquent
 */
class BmnBendaharaMateril extends Model
{
  use HasUuids;

  public $table = 'bmn_bendahara_materil';

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
    return $this->hasMany(User::class)->withTrashed();
  }

  public static function boot()
  {
    parent::boot();

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
