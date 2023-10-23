<?php

namespace App\Models\TU;

use App\Helpers\FileHelper;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class TuSuratTuga
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
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratTugas newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratTugas newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratTugas query()
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratTugas whereAsal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratTugas whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratTugas whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratTugas whereLampiran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratTugas whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratTugas wherePerihal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratTugas whereTanggalMasuk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratTugas whereUpdatedAt($value)
 * @property int $user_id
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TuSuratTugas whereUserId($value)
 * @mixin \Eloquent
 */
class TuSuratTugas extends Model
{
  use HasUuids;

  public $table = 'tu_surat_tugas';

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
      $model->lampiran = FileHelper::upload(request(), 'lampiran', 'tu/surat_tugas');
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
      if (request()->hasFile('lampiran')) {
        $model->lampiran = FileHelper::upload(request(), 'lampiran', 'tu/surat_tugas');
      }
    });
  }
}
