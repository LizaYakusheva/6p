
<a href="/admin">Назад</a>
<h1>Редактировать товар</h1>
<form action="/admin/good" method="post">
    <input type="text" name="name" id="name" placeholder="Название">
    <input type="text" name="description" id="description" placeholder="Описание">
    <select name="category_id" id="category_id">
        <option value="">Выбрать категорию</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?=$category['id']?>"><?=$category['name']?></option>
        <?php endforeach;?>
    </select>
    <input type="number" name="price" id="price" placeholder="Цена">
    <input type="submit" value="Добавить">
</form>