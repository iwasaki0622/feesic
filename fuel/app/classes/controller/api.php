<?php

class Controller_Api extends \Fuel\Core\Controller_Rest
{
    public function get_index()
    {

        header("Access-Control-Allow-Origin: *");
        $this->response(array());
    }

    public function post_index()
    {

        header("Access-Control-Allow-Origin: *");
        $this->response(array());
    }
}