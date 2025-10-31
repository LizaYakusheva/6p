
<a href="/admin/category">Назад</a>
<h1>Изменить категорию</h1>
<form action="/admin/category/<?=$categorySelected['id']?>/edit" method="post">
    <input type="text" name="name" id="name" value="<?=$categorySelected['name']?>">
    <select name="parentCategory" id="parentCategoty">
        <option value="">Выбрать категорию</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?=$category['id']?>"><?=$category['name']?></option>
        <?php endforeach;?>
    </select>
    <input type="submit" value="Изменить">
</form>
