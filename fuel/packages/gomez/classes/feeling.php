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
	
	/*
	* 動きと音声によって感情を分析する
	*/
	function analyzeFeeling($motion, $sound) {

		$feeling = Model_FeelingType::find_all();

		if($motion <= 50 && $sound > 50) {

			return $feeling[0];	//喜

		}
		else if($motion > 50 && $sound > 50) {

			return $feeling[1];	//怒

		}
		else if($motion <= 50 && $sound <= 50) {

			return $feeling[2];	//哀

		}
		else if($motion > 50 && $sound <= 50) {

			return $feeling[3];	//楽

		}

	}
}