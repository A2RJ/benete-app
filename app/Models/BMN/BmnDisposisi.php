<?php

namespace App\Models\BMN;

use App\Models\User;
use App\Trait\Models\UseStatistic;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\BMN\BmnDisposisi
 *
 * @property string $id
 * @property int $user_id
 * @property string $bmn_surat_masuk_id
 * @property string $tujuan
 * @property string $batas_waktu_tindaklanjuti
 * @property string $jenis_disposisi
 * @property string $status_disposisi
 * @property string|null $catatan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BMN\BmnSuratMasuk|null $suratMasuk
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi query()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereBatasWaktuTindaklanjuti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereBmnSuratMasukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereJenisDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereStatusDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereUserId($value)
 * @mixin \Eloquent
 */
class BmnDisposisi extends Model
{
  use HasUuids, UseStatistic;
  public $table = 'bmn_disposisi';

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['bmn_surat_masuk_id', 'tujuan', 'batas_waktu_tindaklanjuti', 'jenis_disposisi', 'status_disposisi', 'catatan'];

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
    return $this->hasOne(BmnSuratMasuk::class, 'id', 'bmn_surat_masuk_id');
  }
}
