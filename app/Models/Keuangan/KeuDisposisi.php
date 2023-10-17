<?php

namespace App\Models\Keuangan;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class KeuDisposisi
 *
 * @property $id
 * @property $keu_surat_masuk_id
 * @property $tanggal_disposisi
 * @property $batas_waktu_tindaklanjuti
 * @property $jenis_disposisi
 * @property $status_disposisi
 * @property $komentar
 * @property $created_at
 * @property $updated_at
 *
 * @property KeuSuratMasuk $keuSuratMasuk
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class KeuDisposisi extends Model
{
  use HasUuids;

  public $table = 'keu_disposisi';

  static $rules = [
    'keu_surat_masuk_id' => 'required',
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
  protected $fillable = ['keu_surat_masuk_id', 'tanggal_disposisi', 'batas_waktu_tindaklanjuti', 'jenis_disposisi', 'status_disposisi', 'komentar'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function suratMasuk()
  {
    return $this->hasOne(KeuSuratMasuk::class, 'id', 'keu_surat_masuk_id');
  }
}