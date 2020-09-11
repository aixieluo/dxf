<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderDesign
 *
 * @property int $id
 * @property int $design_id
 * @property int $order_id
 * @property int $count 件数
 * @property array $lengths 边长集合
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Design $designs
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDesign newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDesign newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDesign query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDesign whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDesign whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDesign whereDesignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDesign whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDesign whereLengths($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDesign whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDesign whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $width
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDesign whereWidth($value)
 * @property-read \App\Models\Design $design
 * @property-read mixed $real_accessories
 * @property-read mixed $accessories
 * @property-read mixed $accessories_count
 */
class OrderDesign extends Model
{
    protected $table = 'order_design';
    protected $fillable = [
        'width',
        'lengths',
        'count'
    ];

    protected $appends = [
        'accessories',
        'accessories_count',
    ];

    protected $casts = [
        'lengths' => 'array'
    ];

    public function getAccessoriesAttribute()
    {
        /** @var \App\Designs\Design $m */
        $m = new $this->design->model($this->lengths);
        if ($m->offset() >= 150) {
            return '绳子*6米';
        } else {
            return $this->design->accessories;
        }
    }

    public function getAccessoriesCountAttribute()
    {
        return $this->design->accessories_count;
    }

    public function getLengthsTextAttribute()
    {
        return collect($this->lengths)->map(function ($item, $key) {
            return "{$key}: {$item}";
        })->implode(' ');
    }

    public function design()
    {
        return $this->belongsTo(Design::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
