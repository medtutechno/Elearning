<!DOCTYPE html>
<html>

<head>
    <link href="http://vjs.zencdn.net/4.2.2/video-js.css" rel="stylesheet" data-semver="4.2.2"
        data-require="video.js@*" />
    <script src="http://vjs.zencdn.net/4.2.2/video.js" data-semver="4.2.2" data-require="video.js@*"></script>
    <script data-require="jquery@1.9.1" data-semver="1.9.1"
        src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="style.css" /> -->


    <meta charset="utf-8" />
    <title>videojs-playlists demo</title>
</head>

<body>
    <!-- <script src="videojs-playList.js"></script> -->
    <video width="640" height="264" data-setup="" controls="" class="video-js vjs-default-skin" id="video"></video>
    <h1></h1>
    <button data-action="prev" type="button">Previous</button>
    <button data-action="next" type="button">Next</button>
    <!-- <script src="script.js"></script> -->

    <p>
        The public repository can be found <a href="https://github.com/Belelros/videojs-playLists">here</a>.
    </p>

    <script>
    //videojs-playlists.js
    function playList(options, arg) {
        var player = this;
        player.pl = player.pl || {};
        var index = parseInt(options, 10);

        player.pl._guessVideoType = function(video) {
            var videoTypes = {
                'webm': 'video/webm',
                'mp4': 'video/mp4',
                'ogv': 'video/ogg'
            };
            var extension = video.split('.').pop();

            return videoTypes[extension] || '';
        };

        player.pl.init = function(videos, options) {
            options = options || {};
            player.pl.videos = [];
            player.pl.current = 0;
            player.on('ended', player.pl._videoEnd);

            if (options.getVideoSource) {
                player.pl.getVideoSource = options.getVideoSource;
            }

            player.pl._addVideos(videos);
        };

        player.pl._updatePoster = function(posterURL) {
            console.debug("Setting posterUrl: " + posterURL);
            player.poster(posterURL);
            player.removeChild(player.posterImage);
            player.posterImage = player.addChild("posterImage");
        };

        player.pl._addVideos = function(videos) {
            for (var i = 0, length = videos.length; i < length; i++) {
                var aux = [];
                for (var j = 0, len = videos[i].src.length; j < len; j++) {
                    aux.push({
                        type: player.pl._guessVideoType(videos[i].src[j]),
                        src: videos[i].src[j]
                    });
                }
                videos[i].src = aux;
                player.pl.videos.push(videos[i]);
            }
        };

        player.pl._nextPrev = function(func) {
            var comparison, addendum;

            if (func === 'next') {
                comparison = player.pl.videos.length - 1;
                addendum = 1;
            } else {
                comparison = 0;
                addendum = -1;
            }

            if (player.pl.current !== comparison) {
                var newIndex = player.pl.current + addendum;
                player.pl._setVideo(newIndex);
                player.trigger(func, [player.pl.videos[newIndex]]);
            }
        };

        player.pl._setVideo = function(index) {
            if (index < player.pl.videos.length) {
                player.pl.current = index;
                player.pl.currentVideo = player.pl.videos[index];

                if (!player.paused()) {
                    player.pl._resumeVideo();
                }

                if (player.pl.getVideoSource) {
                    player.pl.getVideoSource(player.pl.videos[index], function(src, poster) {
                        player.pl._setVideoSource(src, poster);
                    });
                } else {
                    player.pl._setVideoSource(player.pl.videos[index].src, player.pl.videos[index].poster);
                }
            }
        };

        player.pl._setVideoSource = function(src, poster) {
            player.src(src);
            player.pl._updatePoster(poster);
        };

        player.pl._resumeVideo = function() {
            player.one('loadstart', function() {
                player.play();
            });
        };

        player.pl._videoEnd = function() {
            if (player.pl.current === player.pl.videos.length - 1) {
                player.trigger('lastVideoEnded');
            } else {
                player.pl._resumeVideo();
                player.next();
            }
        };

        if (options instanceof Array) {
            player.pl.init(options, arg);
            player.pl._setVideo(0);
            return player;
        } else if (index === index) { // NaN
            player.pl._setVideo(index);
            return player;
        } else if (typeof options === 'string' && typeof player.pl[options] !== 'undefined') {
            player.pl[options].apply(player);
            return player;
        }
    }

    videojs.Player.prototype.next = function() {
        this.pl._nextPrev('next');
        return this;
    };
    videojs.Player.prototype.prev = function() {
        this.pl._nextPrev('prev');
        return this;
    };

    videojs.plugin('playList', playList);
    var videos = [{
            src: [
                './video/test.mp4',
            ],
            poster: 'http://flowplayer.org/media/img/demos/minimalist.jpg',
            title: 'Video 1'
        },
        {
            src: [
                'http://stream.flowplayer.org/night3/640x360.webm',
                'http://stream.flowplayer.org/night3/640x360.mp4',
                'http://stream.flowplayer.org/night3/640x360.ogv'
            ],
            poster: 'http://flowplayer.org/media/img/demos/playlist/railway_station.jpg',
            title: 'Video 2'
        },
        {
            src: [
                'http://stream.flowplayer.org/functional/624x260.webm',
                'http://stream.flowplayer.org/functional/624x260.mp4',
                'http://stream.flowplayer.org/functional/624x260.ogv'
            ],
            poster: 'http://flowplayer.org/media/img/demos/functional.jpg',
            title: 'Video 3'
        }
    ];
    var player = videojs('video');
    player.playList(videos, {
        getVideoSource: function(vid, cb) {
            cb(vid.src, vid.poster);
        }
    });
    $('[data-action=prev]').on('click', function(e) {
        player.prev();
    });
    $('[data-action=next]').on('click', function(e) {
        player.next();
    });
    </script>
</body>

</html>