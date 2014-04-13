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
        // $action_log->save();

<<<<<<< HEAD
        $gracenoteResponse = Gomez_Feeling::murton($feelingTypeId);
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
=======
        $youtubeJson = null;
        // 検索して,なかったら、次の曲を検索する
        while($youtubeJson == null) {

             $gracenoteJson = Gomez_Feeling::murton($feelingTypeId);
             $songName = "fjaewpifjawo;ejgaeoigjaer;oigj;";
             $youtubeJson = Gomez_Feeling::fukudome($songName);

        }

>>>>>>> 29fac8fe2b103aac4d5e3b2f5ae05363f760da7a

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
<<<<<<< HEAD

    function action_test (){
        $feelingTypeId = 1;
        $gracenoteResponse = Gomez_Feeling::murton($feelingTypeId);
        $gracenoteData = $gracenoteResponse['RESPONSE'];
        foreach((array)$gracenoteData->ALBUM as $data) {
            $song = $data->TITLE;
            $songName = $song[0]->VALUE;

            $artist = $data->ARTIST;
            $artistName = $artist[0]->VALUE;

            $youtubeJson = Gomez_Feeling::fukudome($songName . " " . $artistName);
echo $youtubeJson."<br>";
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
        echo "<pre>";
        print_r($data);
    }
}
=======
}
>>>>>>> 29fac8fe2b103aac4d5e3b2f5ae05363f760da7a
