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
 * @property string $model 实例模型
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Design whereModel($value)
 * @property string|null $accessories 辅料名称
 * @property int|null $accessories_count 辅料个数
 * @property-read mixed $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Design whereAccessories($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Design whereAccessoriesCount($value)
 */
class Design extends Model
{
    protected $fillable = [
        'name',
        'img',
        'types',
        // 长度最大值大于150时候改成6米绳子的辅料
        'accessories',
        'accessories_count',
    ];

    protected $hidden = [
        'accessories',
        'accessories_count',
    ];

    protected $casts = [
        'types' => 'array',
    ];

    protected $appends = [
        'url',
    ];

    public function getUrlAttribute()
    {
        return env('APP_URL') . $this->img;
    }

    public function sofas()
    {
        return $this->belongsToMany(SofaCover::class, 'sofa_design', 'design_id', 'sofa_cover_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_design', 'design_id', 'order_id');
    }
}
