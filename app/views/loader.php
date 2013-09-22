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
    }
    videos {
        height:0;
        width:0;
    }
    </style>
</head>
<body>
    <?php

        for ($n=0; $n<100; $n++) {
        ?>
        <video src="https://s3.amazonaws.com/recli/timelapse/1-1379636513.webm" width="304" height="224" loop autoplay onclick="this.play()"></video>
        <?php
        }
    
    ?>
    <script>
        (function(){
            var videos = document.getElementsByTagName('video'),
                W = videos[0].width,
                w = Math.floor(screen.width / 10.3),
                p = w * 100 / W;
                H = videos[0].height,
                h = Math.floor(H * p / 100);
                console.log(W,w,h);
            for (i in videos) {
                videos[i].width = w;
                videos[i].height = h;
            }
        })();
    </script>
</body>
</html>
