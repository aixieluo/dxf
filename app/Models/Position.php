<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Position
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Position whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $alias
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 */
class Position extends Model
{
    const POSITION_ADMIN = 'admin';
    const POSITION_SALE = 'sale';
    const POSITION_PRODUCE = 'produce';
    const POSITION_OPERATOR = 'operator';

    public static $positionMaps = [
        self::POSITION_ADMIN => '超级管理员',
        self::POSITION_SALE => '业务员',
        self::POSITION_PRODUCE => '生产人员',
        self::POSITION_OPERATOR => '运营专员',
    ];

    protected $fillable = [
        'name',
    ];

    protected $visible = [
        'id',
        'name',
        'alias'
    ];

    protected $appends = [
        'alias'
    ];

    /**
     * @return string
     */
    public function getAliasAttribute()
    {
        return array_get(self::$positionMaps, strval($this->name));
    }

    /**
     */
    public function users()
    {
        return $this->hasMany(User::class, 'position_id');
    }
}
