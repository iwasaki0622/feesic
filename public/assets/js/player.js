function Player(data)
{
    // Members
    var self = this; 
    var track = null; 

    // Constructor
    self._construct = function _construct(data)
    {
        self.track = data;
        self.render();
    }

    // Getters
    self.getTrack = function() { return self.track; }

    // Render
    self.render = function()
    {
        $("#youtube").html("");
        self.renderYouTube();
    };

    // Render youTube playlist
    self.renderYouTube = function()
    {
        $("#youtube").html(
            "<iframe src=\"" + self.generateYouTubeURI() + "\" frameborder=\"0\" width=\"600\" height=\"380\"></iframe>"
        );
        $("#loading-youtube").removeClass("active");
    }

    // Generate the youtube playlist URI
    self.generateYouTubeURI = function()
    {
        var url = "http://www.youtube.com/embed/" + self.track + "?rel=0&showinfo=1&autoplay=1&enablejsapi=1";
        return url.substring(0, url.length - 1); // Remove final ","
    }

    self._construct(data);
}