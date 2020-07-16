<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\CreateRequest;
use App\Http\Requests\Order\DesignRequest;
use App\Models\Order;
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
            ])->when($request->input('start'), function (Builder $builder) use ($request) {
                return $builder->whereDate('created_at', '>=', $request->input('start'))->whereDate('created_at', '<=', $request->input('end'));
            })->when($request->input('sofa_id'), function (Builder $builder) use ($request) {
                return $builder->where('sofa_cover_id', $request->input('sofa_id'));
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
        return Response::json($order);
    }

    public function create(CreateRequest $request)
    {
        $this->order->create($request->all());
        return Response::json();
    }

    public function update($id, CreateRequest $request)
    {
        $order = $this->order->id($id);
        $this->order->update($order, $request->all());
        return Response::json();
    }

    public function delete($id)
    {
        $order = $this->order->id($id);
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
        return Response::json($data);
    }

    public function updateOrderDesign($order_id, $design_id, DesignRequest $request)
    {
        $this->order->updateOrderDesign($order_id, $design_id, $request->all());
        return Response::json();
    }
}
