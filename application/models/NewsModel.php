<?php
class NewsModel
{
    public function saveNews(){
        if($_POST['title'] !== null and $_POST['description'] !== null and $_POST['source'] !== null)
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
    public function deleteNews(){

    }

    public function render($file, $news = null, $categories = null, $error = false) {
        /* $file - текущее представление */
        ob_start();
        include($file);
        return ob_get_clean();
    }
}
