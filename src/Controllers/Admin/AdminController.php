<?php

namespace Src\Controllers\Admin;

use Src\Controllers\Controller;

class AdminController extends Controller
{
    protected function setLayout(): void
    {
        $this->renderer->setLayout('admin/layout.php');
    }
}