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

    public function store(RequestInterface $request, ResponseInterface $response)
    {
        ORM::forTable('goods')->create([
            'name' => $request->getParsedBody()['name'],
            'description' => $request->getParsedBody()['description'],
            'price' => $request->getParsedBody()['price'],
            'category_id' =>  $request->getParsedBody()['category_id'],
        ])->save();
        return $response->withHeader('Location', '/admin/good')->withStatus(302);
    }

    public function edit(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $good = ORM::forTable('goods')->findOne($args['id']);
        $categories = ORM::forTable('categories')
            ->select('categories.id')
            ->select('categories.name')
            ->select('categories.parent_category')
            ->select('p.name', 'parent_name')
            ->left_outer_join('categories', ['categories.parent_category', '=', 'p.id'], 'p')
            ->find_array();
        return $this->renderer->render($response, 'admin/good/edit.php', [
            'good' => $good,
            'categories' => $categories
        ]);
    }

    public function update(RequestInterface $request, ResponseInterface $response, array $args)
    {
        ORM::forTable('goods')->where('id', $args['id'])->findOne()->set([
            'name' => $request->getParsedBody()['name'],
            'category_id' => $request->getParsedBody()['category_id'],
            'description' => $request->getParsedBody()['description'],
            'price' => $request->getParsedBody()['price'],
        ])->save();
        return $response->withHeader('Location', '/admin/good')->withStatus(302);
    }

    public function delete(RequestInterface $request, ResponseInterface $response, array $args)
    {
        ORM::forTable('goods')->findOne($args['id'])->delete();
        return $response->withHeader('Location', '/admin/good')->withStatus(302);
    }
}