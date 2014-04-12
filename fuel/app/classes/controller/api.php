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

        //動き
        // $motion = Input::post('motion');
        $motion = 100;
        //音声
        // $sound = Input::post('sound');
        $sound = 100;
        //緯度
        // $lat = Input::post('lat');
        $lat = 30;
        //経度
        // $lon = Input::post('lon');
        $lon = 30;


        $feelingClass = Gomez_Feeling::getInstance();

        $feeling = $feelingClass->analyzeFeeling($motion, $sound);

        // echo json_encode($feeling);

        $data = array(
            'uid' => 'fejwofa',
            'motion' => $motion,
            'sound' => $sound,
            'lat' => $lat,
            'lon' => $lon,
        );
        $action_log = Model_ActionLog::forge($data);
       $action_log->save();


        header("Access-Control-Allow-Origin: *");
        $this->response($action_log);
    }
}