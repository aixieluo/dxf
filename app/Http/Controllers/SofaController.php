<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sofa\CreateItemRequest;
use App\Http\Requests\Sofa\CreateRequest;
use App\Http\Requests\Sofa\UpdateItemRequest;
use App\Models\Design;
use App\Models\Order;
use App\Models\SofaCover;
use App\Repositories\SofaRepository;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Response;

class SofaController extends Controller
{
    /**
     * @var SofaRepository
     */
    protected $sofa;

    /**
     * SofaController constructor.
     *
     * @param SofaRepository $sofa
     */
    public function __construct(SofaRepository $sofa)
    {
        $this->sofa = $sofa;
    }

    public function index(Request $request)
    {
        return Response::json([
            'list' => SofaCover::withCount([
                'items',
                'designs',
                'orders',
            ])->paginate($request->input('perPage')),
        ]);
    }

    public function sofas()
    {
        return Response::json(SofaCover::all(['id', 'name']));
    }

    public function sofa($id)
    {
        $sofa = $this->sofa->id($id);
        $sofa->load(['designs', 'items']);
        return Response::json($sofa);
    }

    public function create(CreateRequest $request)
    {
        $this->sofa->createSofa($request->all());
        return Response::json();
    }

    public function update($id, CreateRequest $request)
    {
        $sofa = $this->sofa->id($id);
        $this->sofa->updateSofa($sofa, $request->all());
        return Response::json();
    }

    public function delete($id)
    {
        $sofa = $this->sofa->id($id);
        if (! $sofa->del) {
            throw new Exception('没有删除的权限', 403);
        }
        \DB::transaction(function () use ($sofa) {
            $sofa->delete();
            $sofa->items()->delete();
        });
        return Response::json();
    }

    public function items($id, Request $request)
    {
        $sofa = $this->sofa->id($id);
        return Response::json([
            'list' => $sofa->items()->paginate($request->input('perPage'))
        ]);
    }

    public function item($id, $itemId)
    {
        $sofa = $this->sofa->id($id);
        $item = $this->sofa->item($sofa, $itemId);
        return Response::json($item);
    }

    public function createItem($id, CreateItemRequest $request)
    {
        $sofa = $this->sofa->id($id);
        $this->sofa->createSofaItem($sofa, $request->all());
        return Response::json();
    }

    public function updateItem($id, $item_id, UpdateItemRequest $request)
    {
        $sofa = $this->sofa->id($id);
        $item = $this->sofa->item($sofa, $item_id);
        $this->sofa->updateSofaItem($item, $request->all());
        return Response::json();
    }

    public function deleteItem($id, $item_id)
    {
        $sofa = $this->sofa->id($id);
        $item = $this->sofa->item($sofa, $item_id);
        if (! $item->del) {
            throw new Exception('没有删除的权限', 403);
        }
        $item->delete();
        return Response::json();
    }

    public function designs()
    {
        $list = Design::all();
        return Response::json(compact('list'));
    }
}
