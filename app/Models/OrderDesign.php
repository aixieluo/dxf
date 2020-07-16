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
 */
class OrderDesign extends Model
{
    protected $table = 'order_design';
    protected $fillable = [
        'oid',
        'recipient_information',
        'note',
        'total',
        'count',
        'dir',
        'exported_at',
    ];

    protected $casts = [
        'lengths' => 'array'
    ];

    public function getWidthAttribute()
    {
        return 1;
    }

    public function designs()
    {
        return $this->belongsTo(Design::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
