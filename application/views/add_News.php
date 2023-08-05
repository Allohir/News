<!DOCTYPE html>

<html>
<head>
    <title>Добавление новости</title>
    <meta charset="utf-8" />
</head>
<body>

<h1>Добавить новость</h1>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

    Заголовок новости:<br />
    <input type="text" name="title" /><br />
    Выберите категорию:<br />
    <select name="category">
        <?php
        foreach($categories as $id=>$name)
        {
            ?>
            <option value="<?= $id?>"><?= $name?></option>
            <?php
        }
        ?>
    </select>
    <br />
    Текст новости:<br />
    <textarea name="description" cols="50" rows="5"></textarea><br />
    Источник:<br />
    <input type="text" name="source" /><br />
    <br />
    <input type="submit" value="Добавить!" />

</form>

</body>
</html>