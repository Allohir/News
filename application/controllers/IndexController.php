<?php
class IndexController implements IController {
  public function indexAction() {
    $fc = FrontController::getInstance();
    /* Инициализация модели */
    $database = new PdoModel();
    $news = $database->getNews();
    $newsModel = new NewsModel();
    $output = $newsModel->render(NEWS_LIST_PAGE, $news);

    $fc->setBody($output);
  }
}
