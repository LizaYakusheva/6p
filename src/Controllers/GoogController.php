<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GoogController extends Controller
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $goods = \ORM::forTable('goods')->findArray();
        return $this->renderer->render($response, '/index.php',[
            'goods' => $goods
        ]);
    }

    public function show(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        $good = \ORM::forTable('goods')->findOne($id);
        return $this->renderer->render($response, '/show.php', [
            'good' => $good,
        ]);
    }
}