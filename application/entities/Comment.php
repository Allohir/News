<?php
class Comment{
    private $id;
    private $parentId;
    private $level;
    private $newsId;
    private $description;
    private $datetime;

    public function __construct($id, $parentId, $level, $newsId, $description, $datetime)
    {
        $this->id = $id;
        $this->parentId = $parentId;
        $this->level = $level;
        $this->newsId = $newsId;
        $this->description = $description;
        $this->datetime = $datetime;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getParentId()
    {
        return $this->parentId;
    }
    public function getLevel()
    {
        return $this->level;
    }
    public function getNewsId()
    {
        return $this->newsId;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getDatetime()
    {
        return $this->datetime;
    }
}