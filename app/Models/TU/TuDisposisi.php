<?php

namespace App\Models\TU;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TuDisposisi
 *
 * @property $id
 * @property $tu_surat_masuk_id
 * @property $tujuan
 * @property $batas_waktu_tindaklanjuti
 * @property $jenis_disposisi
 * @property $status_disposisi
 * @property $catatan
 * @property $created_at
 * @property $updated_at
 *
 * @property TuSuratMasuk $tuSuratMasuk
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TuDisposisi extends Model
{
  use HasUuids;

  public $table = 'tu_disposisi';

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['tu_surat_masuk_id', 'tujuan', 'batas_waktu_tindaklanjuti', 'jenis_disposisi', 'status_disposisi', 'catatan'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function suratMasuk()
  {
    return $this->hasOne(TuSuratMasuk::class, 'id', 'tu_surat_masuk_id');
  }
}
