<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class KeuDisposisi
 *
 * @property $id
 * @property $keu_surat_masuk_id
 * @property $tujuan
 * @property $batas_waktu_tindaklanjuti
 * @property $jenis_disposisi
 * @property $status_disposisi
 * @property $catatan
 * @property $created_at
 * @property $updated_at
 * @property KeuSuratMasuk $keuSuratMasuk
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read \App\Models\Keuangan\KeuSuratMasuk|null $suratMasuk
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi query()
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereBatasWaktuTindaklanjuti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereJenisDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereKeuSuratMasukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereStatusDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KeuDisposisi whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class KeuDisposisi extends Model
{
  use HasUuids;

  public $table = 'keu_disposisi';

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['keu_surat_masuk_id', 'tujuan', 'batas_waktu_tindaklanjuti', 'jenis_disposisi', 'status_disposisi', 'catatan'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function suratMasuk()
  {
    return $this->hasOne(KeuSuratMasuk::class);
  }
}
