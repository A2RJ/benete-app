<?php

namespace App\Models\BMN;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BmnDisposisi
 *
 * @property $id
 * @property $bmn_surat_masuk_id
 * @property $tanggal_disposisi
 * @property $batas_waktu_tindaklanjuti
 * @property $jenis_disposisi
 * @property $status_disposisi
 * @property $komentar
 * @property $created_at
 * @property $updated_at
 *
 * @property BmnSuratMasuk $bmnSuratMasuk
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class BmnDisposisi extends Model
{
  use HasUuids;
  public $table = 'bmn_disposisi';

  static $rules = [
    'bmn_surat_masuk_id' => 'required',
    'tanggal_disposisi' => 'required',
    'batas_waktu_tindaklanjuti' => 'required',
    'jenis_disposisi' => 'required',
    'status_disposisi' => 'required',
  ];

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['bmn_surat_masuk_id', 'tanggal_disposisi', 'batas_waktu_tindaklanjuti', 'jenis_disposisi', 'status_disposisi', 'komentar'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function suratMasuk()
  {
    return $this->hasOne(BmnSuratMasuk::class, 'id', 'bmn_surat_masuk_id');
  }
}
