<?php

namespace App\Models;

use App\Models\User;
use App\Trait\Models\UseStatistic;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\Models\Dokumentasi
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\File> $files
 * @property-read int|null $files_count
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi role()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi searchFile()
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi statistics()
 * @property string $id
 * @property int $user_id
 * @property string $title
 * @property string $role
 * @property string $type
 * @property string $link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Dokumentasi whereUserId($value)
 * @mixin \Eloquent
 */
class Dokumentasi extends Model
{
    use HasUuids, UseStatistic;
  
    public $table = 'dokumentasi';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'role', 'title', 'type', 'link'];

    protected static function booted(): void
    {

        self::creating(function ($model) {
            $id = Auth::id();
            $user = User::whereId($id)->firstOrFail();
            $model->user_id = $user->id;
            $model->role = $user->roles[0]->name;
        });

        self::updating(function ($model) {
            $id = Auth::id();
            $user = User::whereId($id)->firstOrFail();
            $model->user_id = $user->id;
            $model->role = $user->roles[0]->name;
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany(File::class, 'dokumentasi_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function scopeSearchFile($query)
    {
        $search = request()->input('search', false);
        $startDate = request()->input('start_date', false);
        $endDate = request()->input('end_date', false);

        $query->when($search, function ($query, $search) {
            $query->where('title', 'like', "%$search%");
        });

        $query->when($startDate, function ($query, $startDate) {
            $query->whereDate('created_at', '>=', $startDate);
        });

        $query->when($endDate, function ($query, $endDate) {
            $query->whereDate('created_at', '<=', $endDate);
        });
    }

    public function scopeRole($query)
    {
        $id = Auth::id();
        $user = User::whereId($id)->firstOrFail();

        $query->where('role', $user->roles[0]->name);
    }
}
