<?php

class Article extends BdModel
{
    public function __construct()
    {
        $this->table ="article";
        $this->getConnexion();
    }
}

?>