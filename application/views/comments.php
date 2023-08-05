<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

    Добавить комментарий:<br />
    <textarea name="description" cols="50" rows="1"></textarea><br />
    <br />
    <input type = 'hidden'  name = 'parent_id' value = 0
    <br />
    <button type="submit">Добавить</button>

</form>
<h1>Комментарии</h1>
<?php
foreach($comments as $item){
    $id = $item['id'];
    $parent_id = $item['parent_id'];
    $level = $item['level'];
    $news_id = $item['news_id'];
    $description = nl2br($item['description']);
    $datetime = date("d-m-Y H:i:s",$item['datetime']);
    ?>
    <hr>
    <p style="margin-left: <?= $level?>px;">
        @ <?= $datetime?>
        <br /><?= $description?>
    </p>
    <p align='right'>
        <a href='/newsProfile/deleteComment/id/<?= $id?>/news_id/<?= $news_id?>'>Удалить</a>
    </p>
    <form style="margin-left: <?= $level?>px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method='post'>

        Добавить ответ:<br />
    <textarea name='description' cols='50' rows='1'></textarea><br />
        <input type = 'hidden'  name = 'parent_id' value = '<?= $id?>'
    <br />
        <button type="submit">Добавить</button>
    </form>
<?php
}
?>

</body>
</html>
