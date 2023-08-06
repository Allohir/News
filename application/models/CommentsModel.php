<?php
class CommentsModel{
    public function saveComment(){
        if(!empty($_POST['description']))
        {
            $fc = FrontController::getInstance();
            /* Инициализация модели */
            $newsId = (int) $fc->getParams()['id'];
            $parentId = $_POST['parentId'];
            $description = $_POST['description'];
            $comment = [$newsId, $parentId, $description];
            return $comment;
        }
        else
        {
            return false;
        }
    }
    public function formatComments($comments, &$formatedComments, $parentId = 0, $i = 0){
        foreach ($comments as $comment)
        {
            if ($comment['parentId'] !== $parentId) continue;
            array_push($formatedComments, new Comment($comment['id'], $comment['parentId'],
                50 * $i, $comment['newsId'], $comment['description'], $comment['datetime']));
            $id = $comment['id'];
            $this->formatComments($comments, $formatedComments, $id, $i+1);
        }
    }
    public function render($file, $comments, $error, $errorCommentId) {
        /* $file - текущее представление */
        ob_start();
        include($file);
        return ob_get_clean();
    }
}
