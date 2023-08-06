<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

    Добавить комментарий:<br />
    <textarea name="description" cols="50" rows="1"></textarea><br />
    <br />
    <input type = 'hidden'  name = 'parentId' value = 0
    <br />
    <button type="submit">Добавить</button>
</form>
<?php
if($error === true and $errorCommentId === '0')
{
    echo "Нельзя добавить пустой комментарий!";
}
?>
<h1>Комментарии</h1>
<?php
foreach($comments as $item){
    $id = $item->getId();
    $parentId = $item->getParentId();
    $level = $item->getLevel();
    $newsId = $item->getNewsId();
    $description = nl2br($item->getDescription());
    $datetime = date("d-m-Y H:i:s",$item->getDatetime());
    ?>
    <hr>
    <p style="margin-left: <?= $level?>px;">
        @ <?= $datetime?>
        <br /><?= $description?>
    </p>
    <p align='right'>
        <a href='/newsProfile/deleteComment/id/<?= $id?>/newsId/<?= $newsId?>'>Удалить</a>
    </p>
    <form style="margin-left: <?= $level?>px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method='post'>

        Добавить ответ:<br />
    <textarea name='description' cols='50' rows='1'></textarea><br />
        <input type = 'hidden'  name = 'parentId' value = '<?= $id?>'
    <br />
        <button type="submit">Добавить</button>
    </form>
    <?php
    if($error === true and $errorCommentId == $id)
    {
        ?>
        <p style="margin-left: <?= $level?>px;">Нельзя добавить пустой комментарий!</p>
        <?php
    }
    ?>
<?php
}
?>

</body>
</html>
