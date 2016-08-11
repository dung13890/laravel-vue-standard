<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Contracts\Repositories\UserRepository;
use App\Http\Requests\Api\UserCreateRequest;

class UserController extends ApiController
{
    protected $dataSelect = ['id','name','username','email','locked'];

    public function __construct(UserRepository $user)
    {
        parent::__construct($user);
    }

    public function index()
    {
        $request = app(Request::class);
        if ($request->has('sort')) {
            list($sortCol, $sortDir) = explode('|', $request->sort);
            return $this->repository->getModel()->orderBy($sortCol, $sortDir)->paginate(2);
        }
        if ($request->exists('filter')) {
            $q = "%{$request->filter}%";
            return $this->repository->getModel()->where('name', 'like', $q)->orWhere('email', 'like', $q)->paginate(2);
        }

        return $this->repository->paginate(12);
    }

    public function store(UserCreateRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $this->repository->getModel()->create($data);
    }
}
