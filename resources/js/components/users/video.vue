<template>
    <div>
        <video-player  class="video-player-box"
                       ref="videoPlayer"
                       :options="playerOptions"
                       :playsinline="false"
                       customEventName="customstatechangedeventname"

                       @play="onPlayerPlay($event)"
                       @pause="onPlayerPause($event)"
                       @ended="onPlayerEnded($event)"

                       @seeked="onSeek($event)"
                       @seeking="onSeek($event)"
                       @seekable="onSeek($event)"

                       @timeupdate="onPlayerTimeupdate($event)"

                        @changed="onSeek($event)"


                       @statechanged="playerStateChanged($event)"
                       @ready="playerReadied">
        </video-player>





    </div>

</template>


<script>
    // Similarly, you can also introduce the plugin resource pack you want to use within the component
    // import 'some-videojs-plugin'
    export default {


        props: ['user_id'],

        data() {
            return {
                time:'',
                playerOptions: {
                    // videojs options
                    muted: true,
                    language: 'en',
                    seekable:false,
                    playbackRates: [1.0],
                    sources: [{
                        type: "video/mp4",
                        src: "http://test.test/videos/1.mp4"
                    }],

                }
            }
        },
        mounted() {
            console.log('this is current player instance object', this.player)
        },
        computed: {
            player() {
                return this.$refs.videoPlayer.player
            }
        },
        methods: {
            // listen event
            onPlayerPlay(player) {
               console.log("heLLOOOOO" + this.user_id)



            },
            onPlayerPause(player) {
                // console.log('player pause!', player)

                console.log("paused")
                console.log(this.player.currentTime())

                console.log(window.location.pathname)



            },



            onPlayerEnded(player) {
                // console.log('player pause!', player)

                let path = window.location.pathname
                let host = window.location.host + "/"
                let next= ""
                var res = path.split("/");

                if(path=="/home") {

                    console.log("here")
                    next = "home/video/2"
                    res[3]=1;
                }
                else {

                    next = parseInt(res[3]) +1
                    next = "home/video/"+next
                    console.log(parseInt(res[3])+1);
                }



                let data={
                    user_id:this.user_id,
                    video_id:res[3]
                }

                axios.post('/api/users/video/update',data).then(response => {

                    console.log(response.data);

                  window.location.href= "http://"+(window.location.host)+"/" +next
            });



            },
            // ...player event

            // or listen state event
            playerStateChanged(playerCurrentState) {
                    console.log('player current update state', playerCurrentState)
            },

            onPlayerTimeupdate(player){

                this.time = this.player.currentTime()
                console.log("changed")

            },


            onSeek(player){

                console.log("seeked")
            },

            // player is ready
            playerReadied(player) {
                console.log('the player is readied', player)
                // you can use it to do something...
                // player.[methods]
            }
        }
    }
</script>