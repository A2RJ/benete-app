<?php

namespace App\Models\Pelabuhan;

use App\Helpers\FileHelper;
use App\Models\User;
use App\Trait\Models\UseSearch;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class PelabuhanFasilitasPelabuhan
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
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan query()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan whereUpdatedAt($value)
 * @property int $user_id
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan useSearch($withType = false)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanFasilitasPelabuhan statistics()
 * @mixin \Eloquent
 */
class PelabuhanFasilitasPelabuhan extends Model
{
  use HasUuids, UseSearch;

  public $table = 'pelabuhan_fasilitas_pelabuhan';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'pelabuhan/fasilitas_pelabuhan');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'pelabuhan/fasilitas_pelabuhan');
      }
    });
  }
}
