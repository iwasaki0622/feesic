<?php

class Gomez_Feeling {

    private static $instance;

    // ムードとかの対応
    private static $MOOD_ARRAY = array(
        1 => array(
            65322,  // ピースフル
        ),
        2 => array(
            42958,  // アグレッシヴ
        ),
        3 => array(
            65328,  // シリアス
        ),
        4 => array(
            42961,  // パワー
        )
/*
        1 => array(
            65322,  // ピースフル
            65323,  // ロマンティック
            65324,  // センチメンタル
            42942,  // ソフト
            42946,  // のんびり
            65325,  // サウダージ
            42954,  // エレガント
            42947,  // セクシー
            65326,  // クール
        ),
        2 => array(
            65327,  // タフ
            42948,  // ダーク
            42949,  // メランコリー
            65328,  // シリアス
            65329,  // モヤモヤ
            42953,  // パッション
            42955,  // ソワソワ
        ),
        3 => array(
            42951,  // ワイルド
            42958,  // アグレッシヴ
            65330,  // 骨太
            42960,  // エキサイティング
        ),
        4 => array(
            42961,  // パワー
            42945,  // クライマックス
            65331,  // 壮快
            65332,  // 元気
            65333,  // アップビート"
        )
*/
    );

    private static $GENRE_ARRAY = array(
        35627,
        35628,
        35627,
        27745,
        27960,
        27710,
    );

    /**
     * インスタンスを取得する
     * @return Gomez_Feeling
     */
    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new Gomez_Feeling();
        }

        return self::$instance;
    }

    /**
     * 久慈の様な動きと音声によって感情を分析する
     */
    function kuji($motion, $sound) {

        $feeling = Model_FeelingType::find_all();

        if($motion <= 50 && $sound > 50) {

            return $feeling[0]['feeling_type_id'];	//喜

        }
        else if($motion > 50 && $sound > 50) {

            return $feeling[1]['feeling_type_id'];	//怒

        }
        else if($motion <= 50 && $sound <= 50) {

            return $feeling[2]['feeling_type_id'];	//哀

        }
        else if($motion > 50 && $sound <= 50) {

            return $feeling[3]['feeling_type_id'];	//楽

        }

    }


    /**
     * マートン級の活躍でグレースノートを検索する
     * @param $feelingTypeId
     * @return string
     */
    static function murton($feelingTypeId) {
        $mood = self::$MOOD_ARRAY[$feelingTypeId][count(self::$MOOD_ARRAY[$feelingTypeId]) - 1];
        $genre = self::$GENRE_ARRAY[count(self::$GENRE_ARRAY)- 1];
        $url = Config::get("gracenote_api") . "mood=" . $mood . "&genre=". $genre;
        $conn = curl_init();
        curl_setopt($conn, CURLOPT_URL, $url);
        curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($conn, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($conn, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($conn, CURLOPT_HEADER, false);

        do {
            $gracenoteJson = json_decode(curl_exec($conn));
//        $gracenoteJson = file_get_contents($url, "r");
        } while(!isset($gracenoteJson->RESPONSE) || !isset($gracenoteJson->RESPONSE[0]));
        curl_close($conn);

        $gracenoteArray['RESPONSE'] = $gracenoteJson->RESPONSE[0];
        $gracenoteArray['JSON'] = json_encode($gracenoteJson);

        return $gracenoteArray;
    }


    /**
     * 福留程度の機能
     * youtube_jsonを保存する
     * @param $songName
     * @return string
     */
    static function fukudome($songName) {
        //スペースは+に変える
        $songName = str_replace(" ", "+", $songName);

        $url = "http://gdata.youtube.com/feeds/api/videos?vq=" . $songName . "&max-results=10&v=2&alt=jsonc";
        $youtubeJson = file_get_contents($url);

        $res = json_decode($youtubeJson);
        $totalItems = $res->data->totalItems;

        if($totalItems !== 0) {
//            $items = (array)$res->data->items;
//            echo '<a href="' . $items[0]->player->default . '" target="_blank">' . $items[0]->player->default . "</a><br><hr><br>";

            return $youtubeJson;
        } else {
            return null;
        }
    }

    /**
     * ユニコードエスケープされたやつを戻す
     * @param $string
     */
    static function wada($string) {
        $str = str_replace("\\u", "%u", $string);
        return preg_replace_callback("/((?:[^\x09\x0A\x0D\x20-\x7E]{3})+)/", "decode_callback", $str);
    }

}