<?php

namespace Src\Controllers\Admin;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AdminGoogController extends AdminController
{
    public function indexGood(RequestInterface $request, ResponseInterface $response)
    {
        $goods = ORM::forTable('goods')->findArray();
        $categories = ORM::forTable('categories')->findArray();
        return $this->renderer->render($response, '/admin/good/index.php', [
            'goods' => $goods,
            'categories' => $categories,
        ]);
    }

    public function store(RequestInterface $request, ResponseInterface $response, array $args)
    {
        ORM::forTable('goods')->create([
            'name' => $request->getParsedBody()['name'],
            'description' => $request->getParsedBody()['description'],
            'price' => $request->getParsedBody()['price'],
            'category_id' =>  $request->getParsedBody()['category_id'],
        ])->save();
        return $response->withHeader('Location', '/admin/good')->withStatus(302);
    }

    public function edit(RequestInterface $request, ResponseInterface $response)
    {

    }

    public function update(RequestInterface $request, ResponseInterface $response)
    {

    }
}