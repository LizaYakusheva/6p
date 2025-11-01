<?php

namespace Src\Controllers;

use Slim\Views\PhpRenderer;

class Controller
{
    public function __construct(
        protected PhpRenderer $renderer,
    )
    {
        $this->setLayout();
    }

    protected function setLayout($layout = 'layout.php'): void
    {
        $this->renderer->setLayout($layout);
    }

    protected function slugify($text)
    {
        $rus=array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я','а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ');

        $lat=array('a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya','a','b','v','g','d','e','e','gh','z','i','y','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','y','y','y','e','yu','ya',' ');

        $text = str_replace($rus, $lat, $text);
        $text = str_replace('-', '', $text);
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $text);
        return $slug;
    }
}