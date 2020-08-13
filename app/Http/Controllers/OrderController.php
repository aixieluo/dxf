<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateRequest;
use App\Http\Requests\Order\DesignRequest;
use App\Models\Design;
use App\Models\Order;
use App\Models\OrderDesign;
use App\Models\SofaCover;
use App\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Response;

class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $order;

    /**
     * OrderController constructor.
     *
     * @param OrderRepository $order
     */
    public function __construct(OrderRepository $order)
    {
        $this->order = $order;
    }

    public function index(Request $request)
    {
        return Response::json([
            'list' => Order::with([
                'user',
                'sofa',
            ])->has('user')->withCount(['designs'])->when($request->input('start'), function (Builder $builder) use ($request) {
                return $builder->whereDate('created_at', '>=', $request->input('start'))->whereDate('created_at', '<=', $request->input('end'));
            })->when($request->input('sofa_id'), function (Builder $builder) use ($request) {
                return $builder->where('sofa_cover_id', $request->input('sofa_id'));
            })->when($request->input('name'), function (Builder $builder) use ($request) {
                $name = $request->input('name');
                return $builder->whereHas('user', function (Builder $builder) use ($name) {
                    $builder->where('name', 'like', "%{$name}%");
                })->orWhere('oid', 'like', "%{$name}%");
            })->paginate($request->input('perPage')),
            'sofas' => SofaCover::all(['id', 'name'])->pluck('name', 'id')
        ]);
    }

    public function order($id)
    {
        $order = $this->order->id($id);
        $order->load([
            'user',
            'sofa.designs',
            'sofaItem',
        ]);
        $order = $this->order->ods($order);
        return Response::json($order);
    }

    public function create(CreateRequest $request)
    {
        $order = $this->order->create($request->all());
        return Response::json($order);
    }

    public function update($id, CreateRequest $request)
    {
        $order = $this->order->id($id);
        if (\Gate::denies('order.curd', $order)) {
            throw new \Exception('权限不足', 403);
        }
        $this->order->update($order, $request->all());
        return Response::json();
    }

    public function delete($id)
    {
        $order = $this->order->id($id);
        if (\Gate::denies('order.curd', $order)) {
            throw new \Exception('权限不足', 403);
        }
        $this->order->delete($order);
        return Response::json();
    }

    public function confirm($id)
    {
        $order = $this->order->id($id);
        $this->order->confirm($order);
        return Response::json($order);
    }

    public function orderDesign($order_id, $design_id)
    {
        $data = $this->order->getOrderDesign($order_id, $design_id);
        $meta['ods'] = $this->order->ods($this->order->id($order_id))->ods;
        return Response::json(compact('data', 'meta'));
    }

    public function delOrderDesign($order_id, $design_id, $od_id)
    {
        $data = $this->order->getOd($order_id, $design_id, $od_id);
        if ($data->order->confirmed_at) {
            throw new \Exception('已经确定的订单不允许修改');
        }
        $data->delete();
        $order = $this->order->ods($this->order->id($order_id));
        $this->order->freshTotal($order);
        return Response::json($order->ods);
    }

    public function updateOrderDesign($order_id, $design_id, DesignRequest $request)
    {
        $this->order->updateOrderDesign($order_id, $design_id, $request->all());
        $this->order->freshTotal($this->order->id($order_id));
        return Response::json();
    }

    public function downloadDrawing($id)
    {
        $order = $this->order->id($id);
        $file = $this->order->getDrawing($order);
        return Response::download($file);
    }

    public function downloadDrawingZip(Request $request)
    {
        $ids = $request->input('ids');
        if (! count($ids)) {
            throw new \Exception('必须选择要下载的订单');
        }
        $files = collect($ids)->map(function ($id) {
            $order = $this->order->canDownloadOrder($id);
            if (is_null($order)) {
                return false;
            }
            $file = $this->order->getDrawing($order);
            return $file;
        })->filter();
        if ($files->count() < 1) {
            throw new \Exception('没有符合下载要求的绘图');
        }
        return $this->order->downloadZip($files);
    }
}
