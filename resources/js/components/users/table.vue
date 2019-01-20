<template>
    <div class="panel">
        <table class="table">
            <thead>
            <tr>
                <th>Module</th>
                <th>Part I</th>
                <th>Part II</th>
            </tr>
            </thead>
            <tbody>
            <tr class="success">
                <td>Broker Responsibility in a Nutshell</td>
                <td><i :class="[this.videoStatus.vid1 ? ' glyphicon glyphicon-ok ' : '']" ></i> <a class="" href="/home/video/1">Part 1</a> |<a href="/PPT/Understanding_Procuring_Cause.ppt"> &nbsp;PPT <img src="/images/ppt.png" height="20" width="20"></a> </td>
                <td><i :class="[this.videoStatus.vid2 ? ' glyphicon glyphicon-ok ' : '']" ></i> <a class="" href="/home/video/2">Part 2</a> | <a href="/PPT/Brokerage_in_a_Nutshell.pptx">&nbsp;PPT <img src="/images/ppt.png" height="20" width="20"></a></td>
            </tr>
            <tr class="info">
                <td>Disclose, Disclose, Disclose</td>
                <td><i :class="[this.videoStatus.vid3 ? ' glyphicon glyphicon-ok ' : '']" ></i><a class="" href="/home/video/3">Part 1</a> | <a href="/PPT/Disclose__Disclose_Disclose_part_1.ppt">&nbsp;PPT <img src="/images/ppt.png" height="20" width="20"></a></td>
                <td><i :class="[this.videoStatus.vid4 ? ' glyphicon glyphicon-ok ' : '']" ></i> <a class="" href="/home/video/4">Part 2</a> | <a href="/PPT/Disclose__Disclose_Disclose_part_2.ppt">&nbsp;PPT <img src="/images/ppt.png" height="20" width="20"></a></td>
            </tr>
            <tr class="success">
                <td>Advertising Compliance</td>
                <td><i :class="[this.videoStatus.vid5 ? ' glyphicon glyphicon-ok ' : '']" ></i><a class="" href="/home/video/5">Part 1</a> | <a href="/PPT/Mass_advertising_made_easy.ppt">&nbsp;PPT <img src="/images/ppt.png" height="20" width="20"></a></td>
                <td><i :class="[this.videoStatus.vid6 ? ' glyphicon glyphicon-ok ' : '']" ></i><a class="" href="/home/video/6">Part 2</a> | <a href="/PPT/mass_advertising_part_2.pptx">&nbsp;PPT <img src="/images/ppt.png" height="20" width="20"></a></td>
            </tr>
            <tr class="info">
                <td>Conflicts of Interest</td>
                <td> <i :class="[this.videoStatus.vid7 ? ' glyphicon glyphicon-ok ' : '']" ></i><a class="" href="/home/video/7">Part 1</a> | <a href="/PPT/conflicts_power_point_with_dual_agency_edit.ppt">&nbsp;PPT <img src="/images/ppt.png" height="20" width="20"></a></td>
                <td><i :class="[this.videoStatus.vid8 ? ' glyphicon glyphicon-ok ' : '']" ></i><a  class="" href="/home/video/8">Part 2</a> | <a href="/PPT/conflicts_power_point_with_dual_agency-edit2.ppt">&nbsp;PPT <img src="/images/ppt.png" height="20" width="20"></a></td>
            </tr>
            <tr class="success">
                <td>Professional Ethics</td>
                   <td><i :class="[this.videoStatus.vid9 ? ' glyphicon glyphicon-ok ' : '']" ></i><a class="" href="/home/video/9">Part 1</a> | <a href="/PPT/Mass_Professionalism_Course.pptx">&nbsp;PPT <img src="/images/ppt.png" height="20" width="20"></a></td>
                <td><i :class="[this.videoStatus.vid10 ? ' glyphicon glyphicon-ok ' : '']" ></i><a class="" href="/home/video/10">Part 2</a> | <a href="/PPT/Mass_Professionalism_Course_part2.pptx">&nbsp;PPT <img src="/images/ppt.png" height="20" width="20"></a></td>
            </tr>
            <tr class="info">
                <td>Dual Agency</td>
                <td><i :class="[this.videoStatus.vid11 ? ' glyphicon glyphicon-ok ' : '']" ></i><a class="" href="/home/video/11">Part 1</a> | <a href="/PPT/implementing_dual_agency_MASS__Autosaved_.pptx">&nbsp;PPT <img src="/images/ppt.png" height="20" width="20"></a></td>
                <td><i :class="[this.videoStatus.vid12 ? ' glyphicon glyphicon-ok ' : '']" ></i><a class="" href="/home/video/12">Part 2</a> | <a href="/PPT/implementing_dual_agency_MASS_pt2_Autosaved_.pptx">&nbsp;PPT <img src="/images/ppt.png" height="20" width="20"></a></td>
            </tr>

            </tbody>
        </table>
    </div>
</template>

<script>

    export default{

        data(){

            return{
                videoStatus:[],


            }
        },

        created(){
            this.getVideoStatus()
        },


        methods:{

            getVideoStatus(){

                let data= {
                    user_id:2,
                }
                axios.post('/api/users/video/status',data).then(response => {
                    console.log(response.data);

                    this.videoStatus=response.data



            });

            },

            checkClass(video){

                if(this.videoStatus.video){
                    return "glyphicon glyphicon-ok"
                }

                return "";



            }


        }


    }

</script>