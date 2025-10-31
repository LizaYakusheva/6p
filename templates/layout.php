<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/styles/style.css">
</head>
<body>
    <aside class="categories-container">
        <h1>Категории товаров</h1>
        <?php foreach ($categories as $category): ?>
            <a href="/<?=$category['slug']?>"><?=$category['name']?></a>
        <?php endforeach;?>
    </aside>

    <main>
        <?=$content?>
    </main>
</body>
</html>