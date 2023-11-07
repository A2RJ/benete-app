<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

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
 * @method static \Illuminate\Database\Eloquent\Builder|File whereDokumentasiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class File extends Model
{
  use HasUuids;

  static $rules = [
    'dokumentasi_id' => 'required',
    'name' => 'required',
  ];

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

  public function download()
  {
    $url = URL::signedRoute('download', ['pathToImage' => $this->name]);
    return "<a href='{$url}'>Download</a>";
  }

  public function file()
  {
    $file = Storage::disk('local')->get($this->name);
    return base64_encode($file);
  }
}
