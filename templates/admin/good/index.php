
<a href="/admin">Назад</a>
<h1>Добавить товар</h1>
<form action="/admin/good" method="post">
    <input type="text" name="name" id="name" placeholder="Название">
    <textarea type="text" name="description" id="description" placeholder="Описание"></textarea>
    <select name="category_id" id="category_id">
        <option value="">Выбрать категорию</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?=$category['id']?>"><?=$category['name']?></option>
        <?php endforeach;?>
    </select>
    <input type="number" name="price" id="price" placeholder="Цена">
    <input type="submit" value="Добавить">
</form>

<hr>
<h2>Все категории</h2>
<table>
    <tr>
        <td>id</td>
        <td>Название</td>
        <td>Описание</td>
        <td>Категория</td>
        <td>Цена</td>
    </tr>
    <?php foreach ($goods as $good) :?>
        <tr>
            <td><?=$good['id']?></td>
            <td><?=$good['name']?></td>
            <td><?=$good['description']?></td>
            <td><?=$good['category_id']?></td>
            <td><?=$good['price']?></td>
            <td><a href="/admin/good/<?=$good['id']?>/edit">Изменить</a></td>
            <td><a href="/admin/good/<?=$good['id']?>/delete">Удалить</a></td>
        </tr>
    <?php endforeach;?>
</table>
