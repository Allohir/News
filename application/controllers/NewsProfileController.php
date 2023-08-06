<?php
class NewsProfileController implements IController {
    private $error = false;
    private $errorCommentId;
    public function deleteAction() {
        $fc = FrontController::getInstance();
        /* Инициализация модели */
        $database = new PdoModel();
        $id = (int) $fc->getParams()['id'];
        if(!$id)
        {
            throw new Exception();
        }
        else
        {
            $database->deleteNews($id);
            header('Location: http://127.0.0.1');
        }
    }
    public function deleteCommentAction() {
        $fc = FrontController::getInstance();
        /* Инициализация модели */
        $database = new PdoModel();
        $id = (int) $fc->getParams()['id'];
        $newsId = (int) $fc->getParams()['newsId'];
        if(!$id)
        {
            throw new Exception();
        }
        else
        {
            $database->deleteComment($id);
            header('Location: http://127.0.0.1/newsProfile/view/id/'.$newsId);
        }
    }

    public function viewAction(){
        $fc = FrontController::getInstance();
        /* Инициализация модели */
        $database = new PdoModel();
        $id = (int) $fc->getParams()['id'];
        if(!$id)
        {
            throw new Exception();
        }
        else
        {
            $news = $database->getNews($id);
            $newsModel = new NewsModel();
            $output = $newsModel->render(NEWS_PROFILE_PAGE, $news);
            $commentsModel = new CommentsModel();
            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                if(($comments = $commentsModel->saveComment()) === false)
                {
                    $this->error = true;
                    $this->errorCommentId = $_POST['parentId'];
                }
                else
                {
                    $database->saveComments($comments);
                }
            }
            $comments = $database->getComments($id);

            $formatedComments = [];
            $commentsModel->formatComments($comments, $formatedComments);
            $output .= $commentsModel->render(NEWS_COMMENTS, $formatedComments, $this->error, $this->errorCommentId);


            $fc->setBody($output);
        }
    }
}