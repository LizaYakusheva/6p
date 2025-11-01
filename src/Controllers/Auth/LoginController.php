<?php

namespace Src\Controllers\Auth;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Src\Controllers\Controller;

class LoginController extends Controller
{
    public function loginPage(RequestInterface $request, ResponseInterface $response)
    {
        $this->setLayout('');
        return $this->renderer->render($response, '/auth/login.php');
    }

    public function login(RequestInterface $request, ResponseInterface $response,array $args)
    {
        $login = $request->getParsedBody()['login'];
        $password = $request->getParsedBody()['password'];

        $user = \ORM::forTable('users')->where('login', $login)->findOne();

        if(!$user){
            echo 'Такого пользователя не существует';
            exit();
        }

        if ($user['password'] == $password){
            $_SESSION['user_id'] = $user['id'];
            if ($user['is_admin'] == 1){
                return $response->withHeader('Location', '/admin')->withStatus(302);
            }
            return $response->withHeader('Location', '/')->withStatus(302);
        }

        if(!$user['password'] !== $password){
            echo 'Пароль неверный';
            exit();
        }
    }

    public function logout()
    {

    }


}