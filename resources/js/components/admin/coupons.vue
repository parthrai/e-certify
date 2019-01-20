<template>

    <div>
        <notifications group="foo" />

        <div v-if="this.newCoupon">
            <div class="card-body">

                <div class="row">

                    <div v-if="isSubmit">
                        <div v-if="isSubmit">
                            <h1>Coupon Added!</h1>

                            <div class="text-center">
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 98.5 98.5" enable-background="new 0 0 98.5 98.5" xml:space="preserve" height="100" width="100">
  <path class="checkmark" fill="none" stroke-width="8" stroke-miterlimit="10" d="M81.7,17.8C73.5,9.3,62,4,49.2,4
	C24.3,4,4,24.3,4,49.2s20.3,45.2,45.2,45.2s45.2-20.3,45.2-45.2c0-8.6-2.4-16.6-6.5-23.4l0,0L45.6,68.2L24.7,47.3"/>
</svg>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-6" v-else>
                        <div class="form-group">
                            <label class="sr-only" for="email">Code:</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter Code"  v-model="cpn.Code" >
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="sr-only" for="pwd">Amount without $:</label>
                            <input type="text" class="form-control" id="pwd" placeholder="Enter Amount" v-model="cpn.Amount">
                        </div>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary" @click="addCoupons">Add</button>
                        </div>
                    </div>
                </div>


            </div>
        </div>


        <div v-if="this.coupons!=0">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">

                    <div class="row">
                        <div class="col-lg-8">
                            <h4 class="card-title">Coupons ({{this.coupons.length}})</h4>
                        </div>

                        <div class="col-lg-4">
                            <button class="btn btn-primary" @click="newCoupon = !newCoupon">Add Coupon</button>
                        </div>
                    </div>



                </div>




                <br>




                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="search" placeholder="Search">
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>

                                <th @click="sort('Code')">Code </th>
                                <th @click="sort('A mount')">Amount </th>

                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(coupon, index) in (sortedActivity, filteredList)" :key="index">


                                <td class="text-center">{{coupon.id}}</td>


                                <td>{{coupon.Code}}</td>
                                <td>{{coupon.Amount}}</td>



                                <td class="td-actions text-right">
                                    <button class="btn btn-danger" @click="deleteCoupons(coupon.id)">X</button>




                                </td>
                            </tr>

                            </tbody>
                        </table>
                        <button @click="prevPage" class="float-left btn btn-outline-info btn-sm"><i class="material-icons">navigate_before</i> Previous</button>
                        <button @click="nextPage" class="float-right btn btn-outline-info btn-sm">Next <i class="material-icons">navigate_next</i></button>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            No Coupons .....
            <br>
            <div class="col-lg-4">
                <button class="btn btn-primary" @click="newCoupon = !newCoupon">New Coupon</button>
            </div>
        </div>
    </div>



</template>

<script>

    export default{

        data(){

            return{
                coupons:[],
                isSubmit:false,

                newCoupon:false,

                cpn:{
                    Code:'',
                    Amount:'',
                },

                currentSort:'code',
                currentSortDir:'asc',
                search: '',
                searchSelection: '',
                pageSize:10,
                currentPage: 1

            }
        },

        created(){
            this.fetchCoupons();
        },

        computed:{
            sortedActivity:function() {
                return this.coupons.sort((a,b) => {
                    let modifier = 1;
                if(this.currentSortDir === 'desc') modifier = -1;
                if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
                if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
                return 0;
            }).filter((row, index) => {
                    let start = (this.currentPage-1)*this.pageSize;
                let end = this.currentPage*this.pageSize;
                if(index >= start && index < end) return true;
            });
            },

            filteredList () {
                return this.coupons.filter((data) => {
                    let code = data.Code.toLowerCase().match(this.search.toLowerCase());
                let amount = data.Amount.toLowerCase().match(this.search.toLowerCase());

                return code || amount ;
            }).filter((row, index) => {
                    let start = (this.currentPage-1)*this.pageSize;
                let end = this.currentPage*this.pageSize;
                if(index >= start && index < end) return true;
            });
            }
        },
        methods:{
            sort:function(s) {

                console.log("here")

                if(s === this.currentSort) {
                    this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
                }
                this.currentSort = s;
            },
            nextPage:function() {
                if((this.currentPage*this.pageSize) < this.users.length) this.currentPage++;
            },
            prevPage:function() {
                if(this.currentPage > 1) this.currentPage--;
            },

            fetchCoupons(){
                axios.get('/api/admin/coupons/list').then(response => {
                    console.log(response.data.length);
                this.coupons=response.data
            });

            },

            deleteCoupons(coupon_id){

                let coupon ={
                    coupon_id : coupon_id
                }



                    console.log("the user is id " + coupon_id);

                axios.post('/api/admin/coupons/delete',coupon).then(response => {

                    console.log(response.data);
                this.fetchCoupons()

                this.$notify({
                    group: 'foo',
                    type:'warn',
                    title: 'Important message',
                    text: 'Coupon Deleted! '
                });
            });





            },

            addCoupons(){




                let coupon = {
                    code : this.cpn.Code,
                    amount : this.cpn.Amount,
                }

                this.isSubmit=true;

                axios.post('/api/admin/coupons/add',coupon).then(response => {

                    console.log(response.data);
                this.fetchCoupons()
            });


                let ref=this;

                setTimeout(function (){
                    ref.isSubmit=false;
                },5000);



                this.$notify({
                    group: 'foo',
                    title: 'Important message',
                    text: 'Coupon Added! '
                });





            }



        }


    }

</script>


<style>
    .checkmark {
        stroke: green;
        stroke-dashoffset: 745.74853515625;
        stroke-dasharray: 745.74853515625;
        animation: dash 2s ease-out forwards infinite;
    }

    @keyframes dash {
        0% {
            stroke-dashoffset: 745.74853515625;
        }
        100% {
            stroke-dashoffset: 0;
        }
    }
</style>