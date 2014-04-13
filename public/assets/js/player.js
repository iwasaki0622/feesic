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
            alert('finish');
        }
    }

    // Generate the youtube playlist URI
    self.generateYouTubeURI = function()
    {
        var url = "http://www.youtube.com/embed/" + self.track + "?rel=0&showinfo=1&autoplay=1&enablejsapi=1";
        return url.substring(0, url.length - 1); // Remove final ","
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
    
    self.refreshVideo = function() {
        self.player.stopVideo();
        self.player.clearVideo();
        self.player.loadVideoById(self.track);
    }

    self._construct(data);
}