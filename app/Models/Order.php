<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $oid 淘宝订单号
 * @property string $recipient_information 收件人信息
 * @property int $sofa_cover_id
 * @property int $sofa_cover_item_id
 * @property int $user_id
 * @property string $note 备注
 * @property float $total 订单金额
 * @property int $count 数量
 * @property string|null $dir 载片文件
 * @property string|null $exported_at 导出时间
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Design[] $designs
 * @property-read int|null $designs_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDir($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereExportedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereOid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereRecipientInformation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSofaCoverId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereSofaCoverItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderDesign[] $orderDesigns
 * @property-read int|null $order_designs_count
 * @property-read \App\Models\SofaCover $sofa
 * @property-read \App\Models\SofaCoverItem $sofaItem
 * @property-read \App\Models\User $user
 * @property string|null $confirmed_at 导出时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereConfirmedAt($value)
 */
class Order extends Model
{
    protected $fillable = [
        'oid',
        'recipient_information',
        'note',
        'total',
        'count',
        'dir',
        'exported_at',
    ];

    public function designs()
    {
        return $this->belongsToMany(Design::class, 'order_design', 'order_id', 'design_id')->withPivot(['lengths', 'count', 'width']);
    }

    public function orderDesigns()
    {
        return $this->hasMany(OrderDesign::class, 'order_id');
    }

    public function sofa()
    {
        return $this->belongsTo(SofaCover::class, 'sofa_cover_id');
    }

    public function sofaItem()
    {
        return $this->belongsTo(SofaCoverItem::class, 'sofa_cover_item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
