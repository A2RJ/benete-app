<?php

namespace App\Models\BMN;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BmnDisposisi
 *
 * @property $id
 * @property $bmn_surat_masuk_id
 * @property $tujuan
 * @property $batas_waktu_tindaklanjuti
 * @property $jenis_disposisi
 * @property $status_disposisi
 * @property $catatan
 * @property $created_at
 * @property $updated_at
 * @property BmnSuratMasuk $bmnSuratMasuk
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read \App\Models\BMN\BmnSuratMasuk|null $suratMasuk
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi query()
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereBatasWaktuTindaklanjuti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereBmnSuratMasukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereJenisDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereStatusDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BmnDisposisi whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BmnDisposisi extends Model
{
  use HasUuids;
  public $table = 'bmn_disposisi';

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['bmn_surat_masuk_id', 'tujuan', 'batas_waktu_tindaklanjuti', 'jenis_disposisi', 'status_disposisi', 'catatan'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function suratMasuk()
  {
    return $this->hasOne(BmnSuratMasuk::class, 'id', 'bmn_surat_masuk_id');
  }
}
