<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 *
 * @property $id
 * @property $dokumentasi_id
 * @property $name
 * @property $created_at
 * @property $updated_at
 * @property Dokumentasi $dokumentasi
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereDokumentasiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @property-read \App\Models\Dokumentasi|null $dokumentasi
 * @mixin \Eloquent
 */
class File extends Model
{

  static $rules = [
    'dokumentasi_id' => 'required',
    'name' => 'required',
  ];

  protected $perPage = 20;

  public $table = 'file';

  /**
   * Attributes that should be mass-assignable.
   *
   * @var array
   */
  protected $fillable = ['dokumentasi_id', 'name'];


  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function dokumentasi()
  {
    return $this->hasOne(Dokumentasi::class, 'id', 'dokumentasi_id');
  }
}
