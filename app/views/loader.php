<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rec.li Observer</title>
    <style type="text/css">
    * {
        background:#000;
        margin:0;
        padding:0;
        border:0;
        overflow:hidden;
        color:#AAA;
    }
    videos {
        height:0;
        width:0;
    }
    a {
        display:block;
        background:#306090;
        text-align:center;
        font-family:monospace;
        height:42px;
        font-size:33px;
        text-decoration:none;
        padding:10px 0;
    }
    a:hover {
        background:#6090F0;
        color:#FFF;
    }
    </style>
</head>
<body>
    <a href="#">
        Load more nonsense data..
    </a>
    
    <div>
    </div>
    
    <script>
        (function () {
            var g = function (e) { return document.getElementsByTagName(e); }
                videos = g('video'),
                W = 304,
                H = 224,
                w = Math.floor(screen.width / 10),
                p = w * 100 / W;
                h = Math.floor(H * p / 100),
                A = g('a')[0],
                C = g('div')[0],
                v = function (url) {
                    video = document.createElement('video');
                    video.src = url;
                    video.width = w;
                    video.height = h;
                    video.loop = video.autoplay = true;
                    video.onclick = 'this.play()';
                    C.appendChild(video);
                },
                x = function x(url, callback, errorcallback) {
					var xmlhttp = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
					xmlhttp.onreadystatechange = function () {
						if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
							if (callback !== undefined) {
								callback(JSON.parse(xmlhttp.responseText));
							}
						}
						else {
							if (errorcallback !== undefined) {
								errorcallback();
							}
						}
					}
					xmlhttp.open("GET", url, true);
					xmlhttp.send();
				};

            for (i in videos) {

                videos[i].width = w;
                videos[i].height = h;
            }

            p = 0;

            A.onclick = function (e) {
                e.preventDefault();

                x('getStream/' + p, function (stream) {
                
                	for (i in stream) {
                	
                		p++;
                		v(stream[i]);
                	}
                });
            }
        })();
    </script>
</body>
</html>
