<?php

class Controller_Api extends \Fuel\Core\Controller_Rest
{
    protected $format = "json";

    public function get_index()
    {

        $feeling = Model_Feeling::findByUidAndAccount("hoge", "1");

        header("Access-Control-Allow-Origin: *");
        $this->response($feeling);
    }

    public function post_index()
    {
        header("Access-Control-Allow-Origin: *");
        $this->response(array());
    }
}