<?php

class Post
{
    private $id_post;
    private $title;
    private $contentP;
    private $author;
    private $date_created;

    private $img;

    public function getId_post()
    {
        return $this->id_post;
    }

    public function setId_post($id_post)
    {
        $this->id_post = $id_post;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContentP()
    {
        return $this->contentP;
    }

    public function setContentP($contentP)
    {
        $this->contentP = $contentP;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getDate_created()
    {
        return $this->date_created;
    }

    public function setDate_created($date_created)
    {
        $this->date_created = $date_created;
    }
    
    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }

}

?>
