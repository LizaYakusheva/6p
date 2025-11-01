<?php

namespace Src\Controllers;

use ORM;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class CategoryController extends Controller
{
    public function index(RequestInterface $request, ResponseInterface $response, array $args)
    {
        if(!isset($args['slug'])) {
            return $this->renderer->render($response, 'index.php', [
                'goods' => \ORM::forTable('goods')
                    ->select('goods.*')
                    ->select('categories.name', 'category_name')
                    ->leftOuterJoin('categories', ['goods.category_id', '=', 'categories.id'])
                    ->findArray(),
                'categories' => \ORM::for_table('categories')
                    ->select('categories.*')
                    ->whereNull('parent_category')
                    ->findArray(),
            ]);
        } else{
            $category = ORM::forTable('categories')->where('slug', $args['slug'])->findOne();

            return $this->renderer->render($response, 'index.php', [
                'goods' => \ORM::forTable('goods')
                    ->select('goods.*')
                    ->select('categories.name', 'category_name')
                    ->leftOuterJoin('categories', ['goods.category_id', '=', 'categories.id'])
                    ->where('category_id', $category['id'])
                    ->findArray(),
                'categories' => \ORM::for_table('categories')
                    ->select('categories.*')
                    ->whereNull('parent_category')
                    ->findArray(),
                'childCategories' => \ORM::for_table('categories')
                    ->select('categories.*')
                    ->select('parent.name', 'parent_name')
                    ->left_outer_join('categories', ['categories.parent_category', '=', 'parent.id'], 'parent')
                    ->where('parent_category', $category['id'])
                    ->findArray(),
            ]);
        }
    }
}