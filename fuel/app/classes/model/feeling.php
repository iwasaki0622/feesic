<?php

class Model_Feeling extends \Fuel\Core\Model_Crud {


    protected static $_table_name = "feeling";

    //プライマリキー
    protected static $_primary_key = "feeling_id";

    public static function findByUidAndAccount($uid, $account) {
        $sql = "select feeling_id, feeling_type, youtube_json from feeling inner join gadget using(uid) inner join feeling_type using(feeling_type_id) where uid = :uid and account_id = :account order by feeling_id desc";
        $query = \Db::query($sql);
        $query->param("uid", $uid);
        $query->param("account", $account);
        $result = $query->execute()->as_array();

        if(isset($result[0])) {
            return $result[0];
        } else {
            return array();
        }
    }
}