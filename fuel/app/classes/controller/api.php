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

        $uid = "fu-ji-na-mi";

        //動き
        $motion = Input::post('motion');

        //音声
        $sound = Input::post('sound');

        //緯度
        $lat = Input::post('lat');

        //経度
        $lon = Input::post('lon');


        $feelingClass = Gomez_Feeling::getInstance();

        $feelingTypeId = $feelingClass->kuji($motion, $sound);

        $data = array(
            'uid' => $uid,
            'motion' => $motion,
            'sound' => $sound,
            'lat' => $lat,
            'lon' => $lon,
        );
        $action_log = Model_ActionLog::forge($data);
        $action_log->save();

        $gracenoteJson = Gomez_Feeling::murton($feelingTypeId);
        $songName = $gracenoteJson['hogehogeh'];

        $youtubeJson = Gomez_Feeling::fukudome($songName);

        $data = array(
            'uid' => $uid,
            'gracenote_json' => $gracenoteJson,
            'feeling_type_id' => $feelingTypeId,
            'youtube_json' => $youtubeJson,
        );

        $feeling = Model_Feeling::forge($data);
        $feeling->save();

        header("Access-Control-Allow-Origin: *");
        $this->response($action_log);
    }
}