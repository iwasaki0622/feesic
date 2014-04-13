function Feesic()
{
    // Members
    var self = this; // Self-reference
    var ytplayer = null;

    // コンストラクタ
    self._construct = function _construct()
    {
        // リスナーを立ち上げる
        self.setupEventListeners();
        // Playerをレンダー
        self.ytplayer = new Player();
    }

    self.setupEventListeners = function setupEventListeners()
    {
        var timer;
        var timeout = 5000;
        // 動画ボックスがあれば、タイマーを起動し、動画を読み込む
        if($("#youtube").length != 0){
            self.getYoutube();
            timer = $.timer(timeout, function() {
                if(self.ytplayer.getStatus() == 2 || self.ytplayer.getStatus() == 0) {
                    self.getYoutube();
                    self.ytplayer.refreshVideo();
                }
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
                var feeling = data.feeling_type;
                console.log(data);
                $("#feel-type").text(feeling);
                console.log(track);
                self.ytplayer.setTrack(track);

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