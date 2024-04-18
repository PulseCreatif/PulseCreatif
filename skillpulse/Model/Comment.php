<?php

class Comment
{
    private $id_comment;
    private $id_post;
    private $authorC;
    private $contentC;

    public function getId_comment()
    {
        return $this->id_comment;
    }

    public function setId_comment($id_comment)
    {
        $this->id_comment = $id_comment;
    }

    public function getId_post()
    {
        return $this->id_post;
    }

    public function setId_post($id_post)
    {
        $this->id_post = $id_post;
    }

    public function getAuthorC()
    {
        return $this->authorC;
    }

    public function setAuthorC($authorC)
    {
        $this->authorC = $authorC;
    }

    public function getContentC()
    {
        return $this->contentC;
    }

    public function setContentC($contentC)
    {
        $this->contentC = $contentC;
    }
}

?>
