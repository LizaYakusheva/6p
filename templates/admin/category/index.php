
<a href="/admin">Назад</a>
<h1>Добавить категорию</h1>
<form action="/admin/category" method="post">
    <input type="text" name="name" id="name" placeholder="Название">
    <select name="parent_category" id="parent_category">
        <option value="">Выбрать категорию</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?=$category['id']?>"><?=$category['name']?></option>
        <?php endforeach;?>
    </select>
    <input type="submit" value="Добавить">
</form>
<hr>
<h2>Все категории</h2>
<table>
    <tr>
        <td>id</td>
        <td>Категория</td>
        <td>Родительская категория</td>
    </tr>
    <?php foreach ($categories as $category) :?>
        <tr>
            <td><?=$category['id']?></td>
            <td><?=$category['name']?></td>
            <td><?=$category['parent_category']?></td>
            <td><a href="/admin/category/<?=$category['id']?>/edit">Изменить</a></td>
            <td><a href="/admin/category/<?=$category['id']?>/delete">Удалить</a></td>
        </tr>
    <?php endforeach;?>
</table>
