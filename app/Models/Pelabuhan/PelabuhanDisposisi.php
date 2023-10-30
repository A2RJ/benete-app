<?php

namespace App\Models\Pelabuhan;

use App\Models\User;
use App\Trait\Models\UseStatistic;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Pelabuhan\PelabuhanDisposisi
 *
 * @property string $id
 * @property int $user_id
 * @property string $pelabuhan_surat_masuk_id
 * @property string $tujuan
 * @property string $batas_waktu_tindaklanjuti
 * @property string $jenis_disposisi
 * @property string $status_disposisi
 * @property string|null $catatan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pelabuhan\PelabuhanSuratMasuk|null $suratMasuk
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi query()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi statistics()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereBatasWaktuTindaklanjuti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereJenisDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi wherePelabuhanSuratMasukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereStatusDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereUserId($value)
 * @mixin \Eloquent
 */
class PelabuhanDisposisi extends Model
{
  use HasUuids, UseStatistic;

  public $table = 'pelabuhan_disposisi';

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['pelabuhan_surat_masuk_id', 'tujuan', 'batas_waktu_tindaklanjuti', 'jenis_disposisi', 'status_disposisi', 'catatan'];

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
    return $this->hasOne(PelabuhanSuratMasuk::class, 'id', 'pelabuhan_surat_masuk_id');
  }
}
