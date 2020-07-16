<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Design
 *
 * @property int $id
 * @property string $name 设计图名称
 * @property string $img 预览图
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SofaCover[] $sofas
 * @property-read int|null $sofas_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Design newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Design newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Design query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Design whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Design whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Design whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Design whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Design whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property array $types 边长类型集合
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Design whereTypes($value)
 */
class Design extends Model
{
    protected $fillable = [
        'name',
        'img',
        'types'
    ];

    protected $casts = [
        'types' => 'array',
    ];

    public function sofas()
    {
        return $this->belongsToMany(SofaCover::class, 'sofa_design', 'design_id', 'sofa_cover_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_design', 'design_id', 'order_id');
    }
}
