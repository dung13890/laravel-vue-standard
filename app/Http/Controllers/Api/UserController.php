<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\UserRepository;

class UserController extends ApiController
{
    protected $dataSelect = ['id','name','username','email','locked'];

    public function __construct(UserRepository $user)
    {
        parent::__construct($user);
    }

    public function index()
    {
    	return $this->repository->paginate(1);
    }
}
