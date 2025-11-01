
<div class="goods-container">
    <?php if(isset($_SESSION['user_id'])):?>
    <a href="/logout">Выход</a>
    <?php else:?>
    <a href="/login">Вход</a>
    <?php endif;?>
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
