<html>
<head>

    <link href="//vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">

</head>

<body>


<video id="my-video"
       class="video-js"
       controls





>

    <source src="{{request()->getSchemeAndHttpHost()}}/videos/1.mp4" type='video/mp4'>
</video>



<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://vjs.zencdn.net/7.3.0/video.js"></script>
<script src="/new/js/video.js"></script>


</body>
</html>