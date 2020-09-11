<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SofaCover
 *
 * @property int $id
 * @property string $name 产品名称
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Design[] $designs
 * @property-read int|null $designs_count
 * @property-read mixed $templates
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SofaCoverItem[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCover newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCover newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCover query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCover whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCover whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCover whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCover whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $order 序列
 * @property-read mixed $del
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCover whereOrder($value)
 */
class SofaCover extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $appends = [
        'templates',
        'del',
    ];

    public function getTemplatesAttribute()
    {
        return optional($this->designs)->pluck('id');
    }

    public function getDelAttribute()
    {
        return \Gate::allows('admin') && $this->orders->count() === 0;
    }

    public function items()
    {
        return $this->hasMany(SofaCoverItem::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function designs()
    {
        return $this->belongsToMany(Design::class, 'sofa_design', 'sofa_cover_id', 'design_id');
    }
}
