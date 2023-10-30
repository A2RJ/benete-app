<?php

namespace App\Models\Kesyahbandaran;

use App\Models\User;
use App\Trait\Models\UseStatistic;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Kesyahbandaran\KesyaDisposisi
 *
 * @property string $id
 * @property int $user_id
 * @property string $kesya_surat_masuk_id
 * @property string $tujuan
 * @property string $batas_waktu_tindaklanjuti
 * @property string $jenis_disposisi
 * @property string $status_disposisi
 * @property string|null $catatan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kesyahbandaran\KesyaSuratMasuk|null $suratMasuk
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi query()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereBatasWaktuTindaklanjuti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereJenisDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereKesyaSuratMasukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereStatusDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KesyaDisposisi whereUserId($value)
 * @mixin \Eloquent
 */
class KesyaDisposisi extends Model
{
  use HasUuids, UseStatistic;

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

  protected static function booted(): void
  {
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
