<?php
class AddNewsController implements IController {
    private $error = false;
    public function addAction() {
        $fc = FrontController::getInstance();
        /* Инициализация модели */
        $database = new PdoModel();
        $categories = $database->getIterator();
        $newsModel = new NewsModel();
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            if(($news = $newsModel->saveNews()) === false)
            {
                $this->error = true;
            }
            else
            {
                $database->saveNews($news);
            }
        }
        $output = $newsModel->render(NEWS_ADD_PAGE, null, $categories, $this->error);
        $fc->setBody($output);
    }
}
