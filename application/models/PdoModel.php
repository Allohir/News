<?php
class PdoModel implements IteratorAggregate
{
    protected $_db;

    function __construct()
    {
        if (is_file(DB_NAME)) {
            $this->_db = new PDO('sqlite:' . DB_NAME);
        } else {
            $this->_db = new PDO('sqlite:' . DB_NAME);
            $sql = "CREATE TABLE msgs(
                              id INTEGER PRIMARY KEY AUTOINCREMENT,
                              title TEXT,
                              category INTEGER,
                              description TEXT,
                              source TEXT,
                              datetime INTEGER
                          )";
            $this->_db->exec($sql) or $this->_db->errorInfo()[0];
            $sql = "CREATE TABLE comments(
                              id INTEGER PRIMARY KEY AUTOINCREMENT,
                              news_id INTEGER,
                              parent_id INTEGER,
                              description TEXT,
                              datetime INTEGER
                          )";
            $this->_db->exec($sql) or $this->_db->errorInfo()[0];
            $sql = "CREATE TABLE category(
                                  id INTEGER PRIMARY KEY AUTOINCREMENT,
                                  name TEXT
                              )";
            $this->_db->exec($sql) or $this->_db->errorInfo()[0];
            $sql = "INSERT INTO category(id, name)
                  SELECT 1 as id, 'Политика' as name
                  UNION SELECT 2 as id, 'Культура' as name
                  UNION SELECT 3 as id, 'Спорт' as name";
            $this->_db->exec($sql) or $this->_db->errorInfo()[0];
        }
    }

    function __destruct()
    {
        unset($this->_db);
    }

    function getIterator(): Traversable
    {
        return new ArrayIterator($this->getCategories());
    }

    private function getCategories()
    {
        $sql = "SELECT id, name FROM category";
        $result = $this->_db->query($sql);
        while ($row = $result->fetch(PDO::FETCH_NUM)) {
            $categories[$row[0]] = $row[1];
        }
        return $categories;
    }

    function saveNews($news)
    {
        $dt = time();
        $title = $news[0];
        $category = $news[1];
        $description = $news[2];
        $source = $news[3];
        $sql = "INSERT INTO msgs(title, category, description, source, datetime)
                VALUES('$title', $category, '$description', '$source', $dt)";
        $ret = $this->_db->exec($sql);
        if (!$ret)
            return false;
        return true;
    }
    function saveComments($comment)
    {
        $dt = time();
        $news_id = $comment[0];
        $parent_id = $comment[1];
        $description = $comment[2];
        $sql = "INSERT INTO comments(news_id, parent_id, description, datetime)
                VALUES($news_id, $parent_id, '$description', $dt)";
        $ret = $this->_db->exec($sql);
        if (!$ret)
            return false;
        return true;
    }

    protected function db2Arr(PDOStatement $data)
    {
        $arr = [];
        while ($row = $data->fetch(PDO::FETCH_ASSOC))
            $arr[] = $row;
        return $arr;
    }

    public function getNews($id = null)
    {
        try {
            if($id !==null){
                $sql = "SELECT msgs.id as id, title, category.name as category, description, source, datetime 
              FROM msgs, category
              WHERE category.id = msgs.category AND msgs.id = $id";
            }
            else
            {
                $sql = "SELECT msgs.id as id, title, category.name as category, description, source, datetime 
              FROM msgs, category
              WHERE category.id = msgs.category
              ORDER BY msgs.id DESC";
            }
            $result = $this->_db->query($sql);
            if (!is_object($result))
                throw new Exception($this->_db->errorInfo()[0]);
            return $this->db2Arr($result);
        } catch (Exception $e) {
            return false;
        }
    }

    public function getComments($id){
        try {
            $sql = "SELECT id, news_id, parent_id, description, datetime
              FROM comments
              WHERE news_id = $id";
            $result = $this->_db->query($sql);
            if (!is_object($result))
                throw new Exception($this->_db->errorInfo()[0]);
            return $this->db2Arr($result);
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteNews($id)
    {
        try {
            $sql = "DELETE FROM msgs WHERE id = $id";
            $result = $this->_db->exec($sql);
            if (!$result)
                throw new Exception($this->_db->errorInfo()[0]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function deleteComment($id)
    {
        try {
            $sql = "DELETE FROM comments WHERE id = $id";
            $result = $this->_db->exec($sql);
            if (!$result)
                throw new Exception($this->_db->errorInfo()[0]);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function clearData($data)
    {
        return $this->_db->quote($data);
    }
}