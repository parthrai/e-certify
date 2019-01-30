


var player = videojs('my-video');

var host = window.location.host+'/';

var user_id  = $('#user_id').val();



player.ready(function() {


    var promise = player.play();


    player.on('ended',function() {

        var path = window.location.pathname

        var next = ""
        var res = path.split("/");

        if (path == "/home") {

            console.log("here")
            next = "home/video/2"
            res[3] = 1;
        }
        else if (path == "/home/video/12") {
            console.log("here")
            next = "home/video/1"
            res[3] = 12;
        }
        else {

            next = parseInt(res[3]) + 1
            next = "home/video/" + next
            console.log(parseInt(res[3]) + 1);
        }





        var data = {
            user_id: user_id,
            video_id: res[3]
        }

        var ref=this;


        $.ajax({ //line 28
            url: '/api/users/video/update',
            type: 'POST',
            data: {data},
            success: function () {
                if (res[3] == 12) {
                    window.location.href = "http://" + host + "home/";
                    //console.log('success');
                }
                else {
                    window.location.href = "http://" + host + "" + next;

                    //console.log('success');
                }

            },


        });

    });



    player.on('seeked',function(){


    });
});


