<?php

namespace App\Models\TU;

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
 * App\Models\TU\TuSuratMasuk
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
 * @property-read \App\Models\TU\TuDisposisi|null $disposisi
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk query()
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk useSearch($withType = false)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratMasuk whereUserId($value)
 * @mixin \Eloquent
 */
class TuSuratMasuk extends Model
{
  use HasUuids, UseSearch, UseStatistic;

  public $table = 'tu_surat_masuk';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'tu/surat_masuk');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'tu/surat_masuk');
      }
    });
  }

  public function disposisi()
  {
    return $this->hasOne(TuDisposisi::class);
  }
}
