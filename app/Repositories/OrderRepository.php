<?php

namespace App\Repositories;

use App\Models\Design;
use App\Models\Order;
use App\Models\OrderDesign;
use App\Models\SofaCoverItem;
use App\Models\User;
use Arr;
use DB;
use DXFighter\DXFighter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderRepository extends Repository
{
    public function id($id)
    {
        return Order::findOrFail($id);
    }

    public function create(array $all)
    {
        $order = new Order();
        $order->sofa()->associate(Arr::get($all, 'sofa_cover_id'));
        $order->sofaItem()->associate(Arr::get($all, 'sofa_cover_item_id'));
        $order->user()->associate(auth()->user());
        $order->fill($all)->save();
        return true;
    }

    public function update(Order $order, array $all)
    {
        $order->fill($all)->save();
        return true;
    }

    public function delete(Order $order)
    {
        $order->delete();
    }

    public function getOrderDesign($order_id, $design_id)
    {
        return OrderDesign::where(compact('order_id', 'design_id'))->first();
    }

    public function updateOrderDesign($order_id, $design_id, array $all)
    {
        $order = $this->id($order_id);
        $design = $this->design($design_id);
        DB::beginTransaction();
        $order->designs()->detach($design_id);
        $all = Arr::only($all, ['lengths', 'count']);
        $all['width'] = $this->getDesignWidth($design, $all['lengths']);
        $all['lengths'] = json_encode((array)$all['lengths']);
        $order->designs()->syncWithoutDetaching([$design_id => $all]);
        DB::commit();
        return true;
    }

    public function confirm(Order $order)
    {
        if ($order->orderDesigns->count() < 1) {
            throw new \Exception('现在定制规格个数为0，请先定制规格', 400);
        }
        $count = $order->orderDesigns()->count('count');
        $total = $order->sofaItem->price * $order->orderDesigns->sum('width') / 100;
        $order->fill(compact('count', 'total'));
        $dir = $this->draw($order);
        $order->fill(compact('dir'));
        $order->fillable(['confirmed_at'])->fill(['confirmed_at' => now()])->save();
    }

    public function materialReport(Request $request)
    {
        return SofaCoverItem::with([
            'sofa'
        ])->select(['*'])->selectSub("select sum(od.width) from orders left join order_design od on orders.id = od.order_id where orders.sofa_cover_item_id = sofa_cover_items.id", 'width')->when($request->input('start'), function (Builder $builder) use ($request) {
            return $builder->whereHas('orders', function (Builder $builder) use ($request) {
                return $builder->whereDate('created_at', '>=', $request->input('start'))->whereDate('created_at', '<=', $request->input('end'));
            });
        })->paginate($request->input('perPage'));
    }

    public function userReport(Request $request)
    {
        return User::withCount([
            'orders'
        ])->selectSub("select sum(total) from orders left join order_design od on orders.id = od.order_id where user_id = users.id", 'total')->when($request->input('start'), function (Builder $builder) use ($request) {
            return $builder->whereHas('orders', function (Builder $builder) use ($request) {
                return $builder->whereDate('created_at', '>=', $request->input('start'))->whereDate('created_at', '<=', $request->input('end'));
            });
        })->paginate($request->input('perPage'));
    }

    public function design($design_id)
    {
        return Design::findOrFail($design_id);
    }

    public function getDesignWidth(Design $design, $lengths)
    {
        /** @var \App\Designs\Design $p */
        $p = new $design->model($lengths);
        return $p->getWidth();
    }

    public function draw(Order $order)
    {
        $d = new DXFighter();
        $order->load(['orderDesigns.design']);
        $x = 0;
        $order->orderDesigns->map(function (OrderDesign $od) use (&$d, &$x) {
            $lengths = $od->lengths;
            $model = $od->design->model;
            /** @var \App\Designs\Design $m */
            $m = new $model($lengths);
            $p = $m->make($x);
            $x += $od->width;
            $d->addEntity($p);
        });
        $path = $this->getDir($order);
        $d->saveAs(storage_path($path));
        return $path;
    }

    public function getDir(Order $order)
    {
        return "dxf/{$order->id}.dxf";
    }

    public function getDrawing(Order $order)
    {
        $path = storage_path($order->dir);
        if (! is_file($path)) {
            $this->draw($order);
        }
        return $path;
    }
}
