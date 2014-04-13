<?php

class Gomez_Feeling {

    private static $instance;

    // ムードとかの対応
    private static $MOOD_ARRAY = array(
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

            return $feeling[1]['feeling_type_id'];;	//怒

        }
        else if($motion <= 50 && $sound <= 50) {

            return $feeling[2]['feeling_type_id'];;	//哀

        }
        else if($motion > 50 && $sound <= 50) {

            return $feeling[3]['feeling_type_id'];;	//楽

        }

    }


    /**
     * マートン級の活躍でグレースノートを検索する
     * @param $feelingTypeId
     * @return string
     */
    static function murton($feelingTypeId) {
        $mood = array_rand(self::$MOOD_ARRAY[$feelingTypeId]);
        $url = Config::get("gracenote_api") . $mood;
        $gracenoteJson = file_get_contents($url, "r");

        $tmp = json_decode($gracenoteJson)->RESPONSE;
        $gracenoteArray['RESPONSE'] = $tmp[0];
        $gracenoteArray['JSON'] = $gracenoteJson;

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
            return $youtubeJson;
        } else {
            return null;
        }
    }
}