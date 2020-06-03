<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateRequest;
use App\Models\Position;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Response;

class AdminController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user_repository;

    /**
     * AdminController constructor.
     *
     * @param UserRepository $user_repository
     */
    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    public function positions()
    {
        return Response::json(Position::all(['id', 'name'])->pluck('alias', 'id'));
    }

    public function users(Request $request)
    {
        return Response::json([
            'list' => User::with(['position'])->paginate($request->input('perPage'))
        ]);
    }

    public function user($id)
    {
        $u = $this->user_repository->user($id);
        return Response::json($u);
    }

    public function createUser(CreateRequest $request)
    {
        $u = $this->user_repository->store($request->all());
        return Response::json($u);
    }

    public function updateUser($id, Request $request)
    {
        $u = $this->user_repository->user($id);
        $u = $this->user_repository->update($u, $request->all());
        return Response::json($u);
    }

    public function deleteUser($id, Request $request)
    {
        $u = $this->user_repository->user($id);
        $this->user_repository->delete($u);
        return Response::json();
    }
}
