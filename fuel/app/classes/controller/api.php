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

        $uid = Input::post('uid');

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

        $gracenoteResponse = Gomez_Feeling::murton($feelingTypeId);
        $youtubeJson = null;
        $gracenoteData = $gracenoteResponse['RESPONSE'];
        foreach((array)$gracenoteData->ALBUM as $data) {
            $song = $data->TITLE;
            $songName = $song[0]->VALUE;

            $artist = $data->ARTIST;
            $artistName = $artist[0]->VALUE;

            $youtubeJson = Gomez_Feeling::fukudome($songName . " " . $artistName);

            if(!empty($youtubeJson)) {
                break;
            }
        }

        $data = array(
            'uid' => $uid,
            'gracenote_json' => $gracenoteResponse['JSON'],
            'feeling_type_id' => $feelingTypeId,
            'youtube_json' => $youtubeJson,
        );

        $feeling = Model_Feeling::forge($data);
        $feeling->save();

        header("Access-Control-Allow-Origin: *");
        $this->response($action_log);
    }

    function action_test (){

        $feelingClass = Gomez_Feeling::getInstance();
        $feelingTypeId = $feelingClass->kuji(115, -27);

        do {
            $gracenoteResponse = Gomez_Feeling::murton($feelingTypeId);
            $gracenoteData = $gracenoteResponse['RESPONSE'];

            if(isset($gracenoteData->STATUS) && $gracenoteData->STATUS == "NO_MATCH") {

            } else {
                break;
            }
        } while(true);

        foreach((array)$gracenoteData->ALBUM as $data) {
            $song = $data->TITLE;
            $songName = $song[0]->VALUE;

//            $songName = Gomez_Feeling::wada($songName);

            $artist = $data->ARTIST;
            $artistName = $artist[0]->VALUE;
//            $artistName = Gomez_Feeling::wada($artistName);

            $youtubeJson = Gomez_Feeling::fukudome($songName . " " . $artistName);

            if(!empty($youtubeJson)) {
                break;
            }
        }

        $data = array(
            'uid' => "",
            'gracenote_json' => $gracenoteResponse['JSON'],
            'feeling_type_id' => $feelingTypeId,
            'youtube_json' => $youtubeJson,
        );

        print_r($data);
    }
}