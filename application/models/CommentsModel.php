<?php
class CommentsModel{
    public function saveComment(){
        if($_POST['description'] !== null)
        {
            $fc = FrontController::getInstance();
            /* Инициализация модели */
            $news_id = (int) $fc->getParams()['id'];
            $parent_id = $_POST['parent_id'];
            $description = $_POST['description'];
            $comment = [$news_id, $parent_id, $description];
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
            if ($comment['parent_id'] !== $parentId) continue;
            array_push($formatedComments, ['level'=>50*$i, 'description'=>$comment['description'],
            'id'=>$comment['id'], 'parent_id'=>$comment['parent_id'],
                'news_id'=>$comment['news_id'], 'datetime'=>$comment['datetime']]);
            $id = $comment['id'];
            $this->formatComments($comments, $formatedComments, $id, $i+1);
        }
    }
    public function render($file, $comments) {
        /* $file - текущее представление */
        ob_start();
        include($file);
        return ob_get_clean();
    }
}
