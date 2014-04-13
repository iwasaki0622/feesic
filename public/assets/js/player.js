function Player(data)
{
    // Members
    var self = this;
    var track = null;
    var player = null;

    // Constructor
    self._construct = function _construct(data)
    {
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }

    // Getters
    self.getTrack = function() {
        return self.track;
    }
    
    self.setTrack = function(track) {
        self.track = track;
    }

    onYouTubeIframeAPIReady = function() {
        self.player = new YT.Player('youtube', {
            height: '250',
            width: '300',
            videoId: self.track,
            playerVars: { 'autoplay': 1},
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    // 再生が可能になると呼び出されます。
    onPlayerReady = function(event) {
        // 再生を開始します。
        event.target.playVideo();
    }
    // 再生した、停止したなどのプレーヤーのステータスが変わった場合、呼び出されます。
    onPlayerStateChange = function(event) {
        // 再生が終わったら、alertしてみます
        if (event.data == YT.PlayerState.ENDED) {
            console.log('finish');
        }
    }

    
    self.pauseVideo = function() {
        self.player.pauseVideo();
    }
    
    self.stopVideo = function() {
        self.player.stopVideo();
    }
    
    self.clearVideo = function() {
        self.player.clearVideo();
    }
    
    self.getStatus = function() {
        return self.player.getPlayerState();
    }
    
    self.playVideo = function() {
        self.player.playVideo();
    }
    
    self.refreshVideo = function() {
//        self.player.stopVideo();
//        self.player.clearVideo();
        console.log(self.track);
        self.player.loadVideoById(self.track[0]);
//        self.player.loadVideoById("XAdBNPQ77Ig");
//        self.player.playVideo();
    }

    self._construct(data);
}