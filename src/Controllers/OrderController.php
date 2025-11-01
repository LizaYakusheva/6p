<?php

namespace Src\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class OrderController extends Controller
{
    public function store(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $goods_id = $args['id'];

        $client_name = $request->getParsedBody()['client_name'];
        $client_phone = $request->getParsedBody()['client_phone'];
        $days_count = $request->getParsedBody()['days_count'];
        $date = date('Y-m-d H:i:s');

        \ORM::forTable('order')->create([
            'goods_id' => $goods_id,
            'client_name' => $client_name,
            'client_phone' => $client_phone,
            'days_count' => $days_count,
            'date' => $date,
        ])->save();
        return $response->withHeader('Location', '/goods/' . $args['id']);
    }
}