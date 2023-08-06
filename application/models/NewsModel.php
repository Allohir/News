<?php
class NewsModel
{
    public function saveNews(){
        if(!empty($_POST['title']) and !empty($_POST['description']) and !empty($_POST['source']))
        {
            $title = $_POST['title'];
            $desc = $_POST['description'];
            $source = $_POST['source'];
            $category = $_POST['category'];
            $news = [$title, $category, $desc, $source];
            return $news;
        }
        else
        {
            return false;
        }
    }

    public function render($file, $news = null, $categories = null, $error = false) {
        /* $file - текущее представление */
        ob_start();
        include($file);
        return ob_get_clean();
    }
}
