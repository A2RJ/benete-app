<?php

namespace App\Models\TU;

use App\Models\User;
use App\Trait\Models\UseStatistic;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
 
/**
 * App\Models\TU\TuDisposisi
 *
 * @property string $id
 * @property int $user_id
 * @property string $tu_surat_masuk_id
 * @property string $tujuan
 * @property string $batas_waktu_tindaklanjuti
 * @property string $jenis_disposisi
 * @property string $status_disposisi
 * @property string|null $catatan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TU\TuSuratMasuk|null $suratMasuk
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi query()
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi whereBatasWaktuTindaklanjuti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi whereJenisDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi whereStatusDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi whereTuSuratMasukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi whereTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TuDisposisi whereUserId($value)
 * @mixin \Eloquent
 */
class TuDisposisi extends Model
{
  use HasUuids, UseStatistic;

  public $table = 'tu_disposisi';

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['tu_surat_masuk_id', 'tujuan', 'batas_waktu_tindaklanjuti', 'jenis_disposisi', 'status_disposisi', 'catatan'];

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
    return $this->hasOne(TuSuratMasuk::class, 'id', 'tu_surat_masuk_id');
  }
}
