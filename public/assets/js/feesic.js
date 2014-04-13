function Feesic()
{
    // Members
    var self = this; // Self-reference

    // コンストラクタ
    self._construct = function _construct()
    {
        // リスナーを立ち上げる
        self.setupEventListeners();
    }

    self.setupEventListeners = function setupEventListeners()
    {
        var timer;
        var timeout = 500000;
        // 動画ボックスがあれば、タイマーを起動し、動画を読み込む
        if($("#youtube").length != 0){
            self.getYoutube();
            timer = $.timer(timeout, function() {
                self.getYoutube();
    //            alert("Timer completed.<br />");
            });
        }
    }
    
    self.getYoutube = function() {
        var api_url = "http://feesic.cloudapp.net/api/";
        // APIにアクセスして動画を取得
        jQuery.ajax(
        {
            async: true,
            type: "GET",
            url: api_url,
            data: "uid=hoge",
            dataType: "json",
            success: function(data, textStatus)
            {
                // JSONをParseしてIDを取得
                var obj = jQuery.parseJSON(data.youtube_json);
                // 0個目のIDを取得する
                var track = new Array(obj.data.items[0].id);

                // Playerをレンダー
                var player = new Player(track);
                player.render();

                // Trigger the callback
                if (typeof callback == "function") { callback(); }
            },
            error: function (xhr, textStatus, errorThrown)
            {
                // Throw to Chrome console, jQuery won't alert as it will catch it itself.
                console.error("Error from remote server " + url);
                console.error(errorThrown);

                // Trigger the callback
                if (typeof callback == "function") { callback(); }
            }
        });
    }
    
    self._construct();
}
new Feesic();