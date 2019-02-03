<template>
    <div>
        <notifications group="foo" />
        <div v-if="this.users!=0">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">

                    <h4 class="card-title">Users ({{this.users.length}})</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="search" placeholder="Search">
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Avatar</th>
                                <th @click="sort('name')">Name </th>
                                <th @click="sort('email')">email </th>
                                <th>Phone </th>

                                <th @click="sort('email')">license </th>
                                <th>Registration Date </th>
                                <th>Registered </th>

                                <th @click="sort('email')">Status </th>

                                <th class="text-right">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(user, index) in (sortedActivity, filteredList)" :key="index">


                                <td class="text-center">{{user.id}}</td>
                                <td ><img src="https://www.pngarts.com/files/3/Avatar-PNG-Photo.png" height="50" width="50"/></td>

                                <td><a :href="profileLink(user.id)">{{user.name}} </a></td>
                                <td>{{user.email}}</td>
                                <td>{{user.phone}}</td>
                                <td>{{user.license}}</td>
                                <td>{{user.created_at.date}}</td>

                                <td>{{user.created_at_human}}</td>

                                <td>
                                    <span v-if="user.account_status==1">
                                        Activated
                                    </span>
                                    <span v-else>
                                        Not Activated
                                    </span>
                                </td>



                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-danger" v-if="user.account_status" @click="suspendUser(user.id)">
                                       Suspend
                                    </button>

                                    <button type="button" rel="tooltip" class="btn btn-success" v-else @click="activateUser(user.id)">
                                        Activate
                                    </button>


                                    <button class="btn btn-danger" @click="deleteUsers(user.id)">Delete</button>


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
           <h2>Loading users .....</h2>
        </div>
    </div>

</template>

<script>

    export default{

        data(){

            return{
                users:[],
                currentSort:'name',
                currentSortDir:'asc',
                search: '',
                searchSelection: '',
                pageSize: 50,
                currentPage: 1

            }
        },

        created(){
            this.fetchUsers();
        },

        computed:{
            sortedActivity:function() {
                return this.users.sort((a,b) => {
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
                return this.users.filter((data) => {
                    let email = data.email.toLowerCase().match(this.search.toLowerCase());
                    let name = data.name.toLowerCase().match(this.search.toLowerCase());

                return email || name ;
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

            fetchUsers(){
                axios.get('/api/admin/users/list').then(response => {
                    console.log(response.data.length);
                this.users=response.data
            });

            },

            activateUser(user_id){

                let user ={
                    id : user_id
                }



                console.log("the user is id " + user_id);

                axios.post('/api/admin/users/activate',user).then(response => {

                    console.log(response.data);
                this.fetchUsers();
                this.$notify({
                    group: 'foo',
                    type:'success',
                    title: 'Important message',
                    text: 'User Activated! '
                });

            });


            },

            suspendUser(user_id){

                let user ={
                    id : user_id
                }



                console.log("the user is id " + user_id);

                axios.post('/api/admin/users/suspend',user).then(response => {

                    console.log(response.data);
                this.fetchUsers();
                this.$notify({
                    group: 'foo',
                    type:'warn',
                    title: 'Important message',
                    text: 'User Suspended! '
                });

            });


            },


            profileLink(user_id){

                return '/admin/user/'+user_id;

            },


            deleteUsers(user_id){

                let user ={
                    id : user_id
                }



                console.log("the user is id " + user_id);

                axios.post('/api/admin/users/delete',user).then(response => {

                    console.log(response.data);
                this.fetchUsers();
                this.$notify({
                    group: 'foo',
                    type:'warn',
                    title: 'Important message',
                    text: 'User Deleted! '
                });

            });



            }



        }


    }

</script>