<?php

namespace App\Http\Controllers\Backend;

class UserController extends BackendController
{
    public function index()
    {
    	$this->compacts['heading'] = 'product show';
    	return $this->viewRender();;
    }
}
