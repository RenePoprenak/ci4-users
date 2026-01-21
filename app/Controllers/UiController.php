<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UiController extends BaseController
{
    public function toast()
    {
        return view('ui/_toast', [
            'message' => (string)$this->request->getPost('message'),
            'type'    => (string)$this->request->getPost('type'),
        ]);
    }
}