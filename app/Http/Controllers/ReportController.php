<?php

namespace App\Http\Controllers;

use App\Exports\MaterialExport;
use App\Exports\UserExport;
use App\Http\Requests\Order\CreateRequest;
use App\Http\Requests\Order\DesignRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class ReportController extends Controller
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

    public function material(Request $request)
    {
        $material = $this->order->materialReport($request);
        return Response::json([
            'list' => $material
        ]);
    }

    public function user(Request $request)
    {
        $user = $this->order->userReport($request);
        return Response::json([
            'list' => $user
        ]);
    }

    public function exportMaterial(Request $request)
    {
        return new MaterialExport($request);
    }

    public function exportUser(Request $request)
    {
        return new UserExport($request);
    }
}
