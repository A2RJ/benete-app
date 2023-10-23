<?php

namespace App\Models\Kesyabandaraan;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class KesyaDisposisi
 *
 * @property $id
 * @property $kesya_surat_masuk_id
 * @property $tujuan
 * @property $batas_waktu_tindaklanjuti
 * @property $jenis_disposisi
 * @property $status_disposisi
 * @property $catatan
 * @property $created_at
 * @property $updated_at
 * @property KesyaSuratMasuk $kesyaSuratMasuk
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read \App\Models\Kesyabandaraan\KesyaSuratMasuk|null $suratMasuk
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi query()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereBatasWaktuTindaklanjuti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereJenisDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereKesyaSuratMasukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereStatusDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereUpdatedAt($value)
 * @property int $user_id
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereUserId($value)
 * @mixin \Eloquent
 */
class KesyaDisposisi extends Model
{
  use HasUuids;

  public $table = 'kesya_disposisi';

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['kesya_surat_masuk_id', 'tujuan', 'batas_waktu_tindaklanjuti', 'jenis_disposisi', 'status_disposisi', 'catatan'];

  public function user()
  {
    return $this->belongsTo(User::class)->withTrashed();
  }

  public static function boot()
  {
    parent::boot();

    self::creating(function ($model) {
      $model->user_id = Auth::id();
    });

    self::updating(function ($model) {
      $model->user_id = Auth::id();
    });
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function suratMasuk()
  {
    return $this->hasOne(KesyaSuratMasuk::class, 'id', 'kesya_surat_masuk_id');
  }
}
