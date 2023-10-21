<?php

namespace App\Models\Pelabuhan;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PelabuhanDisposisi
 *
 * @property $id
 * @property $pelabuhan_surat_masuk_id
 * @property $tujuan
 * @property $batas_waktu_tindaklanjuti
 * @property $jenis_disposisi
 * @property $status_disposisi
 * @property $catatan
 * @property $created_at
 * @property $updated_at
 * @property PelabuhanSuratMasuk $pelabuhanSuratMasuk
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property-read \App\Models\Pelabuhan\PelabuhanSuratMasuk|null $suratMasuk
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi query()
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereBatasWaktuTindaklanjuti($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereCatatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereJenisDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi wherePelabuhanSuratMasukId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereStatusDisposisi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PelabuhanDisposisi whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PelabuhanDisposisi extends Model
{
  use HasUuids;

  public $table = 'pelabuhan_disposisi';

  protected $perPage = 20;

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['pelabuhan_surat_masuk_id', 'tujuan', 'batas_waktu_tindaklanjuti', 'jenis_disposisi', 'status_disposisi', 'catatan'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function suratMasuk()
  {
    return $this->hasOne(PelabuhanSuratMasuk::class, 'id', 'pelabuhan_surat_masuk_id');
  }
}
