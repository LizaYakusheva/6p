<?php

namespace Src\Controllers\Admin;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AdminCategoryController extends AdminController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $categories = \ORM::forTable('categories')->findArray();
        return $this->renderer->render($response, '/admin/index.php',[
            'categories' => $categories,
        ]);
    }

    public function indexCategory(RequestInterface $request, ResponseInterface $response)
    {
        $categories = \ORM::forTable('categories')->findArray();
        return $this->renderer->render($response, '/admin/category/index.php',[
            'categories' => $categories,
        ]);
    }

    public function store(RequestInterface $request, ResponseInterface $response)
    {

        $category = \ORM::forTable('categories')->create([
            'name' => $request->getParsedBody()['name'],
            'parent_category' => !$request->getParsedBody()['parent_category'] ? null : $request->getParsedBody()['parent_category'],
            'slug' => $this->slugify($request->getParsedBody()['name']),
        ])->save();
        return $response->withHeader('Location', '/admin/category')->withStatus(302);
    }

    public function edit(RequestInterface $request, ResponseInterface $response, array $args)
    {
        return $this->renderer->render($response, 'admin/category/edit.php', [
            'categorySelected' => \ORM::for_table('categories')->find_one($args['id']),
            'categories' => \ORM::for_table('categories')
                ->select('categories.id')
                ->select('categories.name')
                ->select('categories.parent_category')
                ->select('p.name', 'parent_name')
                ->left_outer_join('categories', ['categories.parent_category', '=', 'p.id'], 'p')
                ->find_array(),
        ]);
    }

    public function update(RequestInterface $request, ResponseInterface $response, array $args)
    {
        \ORM::forTable('categories')->where('id', $args['id'])->findOne()->set([
            'name' => $request->getParsedBody()['name'],
            'parent_category' => !$request->getParsedBody()['parentCategory'] ? null : $request->getParsedBody()['parentCategory'],
            'slug' => $this->slugify($request->getParsedBody()['name']),
        ])->save();
        return $response->withHeader('Location', '/admin/category')->withStatus(302);
    }

    public function delete(RequestInterface $request, ResponseInterface $response, array $args)
    {
        $id = $args['id'];
        \ORM::forTable('categories')->findOne($id)->delete();
        return $response->withHeader('Location', '/admin/category')->withStatus(302);
    }
}
