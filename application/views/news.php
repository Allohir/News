<!DOCTYPE html>

<html>
<head>
	<title>Новостная лента</title>
	<meta charset="utf-8" />
</head>
<body>

<h1>Последние новости</h1>

<?php
foreach($news as $item){
    $id = $item['id'];
    $title = $item['title'];
    $category = $item['category'];
    $description = nl2br($item['description']);
    $datetime = date("d-m-Y H:i:s",$item['datetime']);

    echo <<<LABEL
    <hr>
    <p>
        <b><a href="/newsProfile/view/id/$id">$title</a></b> [$category] @ $datetime
        <br />$description
    </p>
    <p align="right">
        <a href="/newsProfile/delete/id/$id">Удалить</a>
    </p>
LABEL;
}
?>

</body>
</html>
