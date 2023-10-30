<?php

namespace App\Models\Keuangan;

use App\Models\User;
use App\Trait\Models\UseStatistic;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Keuangan\KeuDisposisi
 *
 * @property string $id
 * @property int $user_id
 * @property string $keu_surat_masuk_id
 * @property string $tujuan
 * @property string $batas_waktu_tindaklanjuti
 * @property string $jenis_disposisi
 * @property string $status_disposisi
 * @property string|null $catatan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Keuangan\KeuSuratMasuk|null $suratMasuk
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi query()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereBatasWaktuTindaklanjuti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereJenisDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereKeuSuratMasukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereStatusDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereUserId($value)
 * @mixin \Eloquent
 */
class KeuDisposisi extends Model
{
  use HasUuids, UseStatistic;

  public $table = 'keu_disposisi';

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['keu_surat_masuk_id', 'tujuan', 'batas_waktu_tindaklanjuti', 'jenis_disposisi', 'status_disposisi', 'catatan'];

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
    return $this->hasOne(KeuSuratMasuk::class);
  }
}
