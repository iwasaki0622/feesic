<?php

class Gomez_Feeling {

	private static $instance;

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
	     * @param $felingTypeId
	     * @return string
	     */
	    static function murton($felingTypeId) {
	        $gracenoteJson = "";

	        return $gracenoteJson;
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