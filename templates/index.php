
<div class="goods-container">
    <a href="/admin">Панель администратора</a>
    <hr>
    <h1>Товары</h1>
    <?php
    if (isset($childCategories)):?>
        <?php foreach ($childCategories as $childCategory): ?>
            <a href="/<?=$childCategory['slug']?>"><button><?=$childCategory['name']?></button></a>
        <?php endforeach;?>
    <?php endif;?>

    <div class="goods-cont">
        <?php foreach ($goods as $good): ?>
            <div class="good-card">
                <?=$good['name']?>
                <?=$good['category_name']?>
                <a href="/good/<?=$good['id']?>">Перейти</a>
            </div>
        <?php endforeach;?>
    </div>
</div>
