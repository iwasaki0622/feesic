<?php

class Controller_Api extends \Fuel\Core\Controller_Rest
{
    public function get_index()
    {
        $feeling = Model_Feeling::find_by("uid", "hoge");

        header("Access-Control-Allow-Origin: *");
        $this->response($feeling);
    }

    public function post_index()
    {

        header("Access-Control-Allow-Origin: *");
        $this->response(array());
    }
}