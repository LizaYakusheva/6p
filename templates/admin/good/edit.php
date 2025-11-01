
<a href="/admin">Назад</a>
<h1>Редактировать товар</h1>
<form action="/admin/good/<?=$good['id']?>/edit" method="post">
    <input type="text" name="name" id="name" value="<?=$good['name']?>">
    <textarea type="text" name="description" id="description"><?=$good['description']?></textarea>
    <select name="category_id" id="category_id">
        <?php foreach ($categories as $category): ?>
            <option value="<?=$category['id']?>"><?=$category['name']?></option>
        <?php endforeach;?>
    </select>
    <input type="number" name="price" id="price" value="<?=$good['price']?>">
    <input type="submit" value="Редактировать">
</form>