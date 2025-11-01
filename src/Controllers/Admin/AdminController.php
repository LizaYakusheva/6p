<?php

namespace Src\Controllers\Admin;

use Src\Controllers\Controller;

class AdminController extends Controller
{
    protected function setLayout($layout = 'admin/layout.php'): void
    {
        $this->renderer->setLayout($layout);
    }
}