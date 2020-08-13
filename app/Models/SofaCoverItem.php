<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SofaCoverItem
 *
 * @property int $id
 * @property int $sofa_cover_id
 * @property string $name 布料名称
 * @property string $uid 材料编号
 * @property string $color 颜色
 * @property string $fid 规格编号
 * @property float $price 材料单价
 * @property string $preview 预览图
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $chain_name
 * @property-read \App\Models\SofaCover $sofa
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCoverItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCoverItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCoverItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCoverItem whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCoverItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCoverItem whereFid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCoverItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCoverItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCoverItem wherePreview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCoverItem wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCoverItem whereSofaCoverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCoverItem whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SofaCoverItem whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 */
class SofaCoverItem extends Model
{
    protected $fillable = [
        'name',
        'uid',
        'color',
        'fid',
        'price',
        'preview',
    ];

    protected $appends = [
        'chain_name',
        'url',
        'del',
    ];

    public function getDelAttribute()
    {
        return \Gate::allows('admin') && $this->orders->count() === 0;
    }

    public function getChainNameAttribute()
    {
        return "{$this->name}-{$this->uid} {$this->color}-{$this->fid}";
    }

    public function getUrlAttribute()
    {
        return env('APP_URL') . $this->preview;
    }

    public function sofa()
    {
        return $this->belongsTo(SofaCover::class, 'sofa_cover_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'sofa_cover_item_id');
    }
}
