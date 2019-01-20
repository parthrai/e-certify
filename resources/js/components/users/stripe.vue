<template>
    <div>

        <modal name="hello-world"
               :width="300"
               :height="200"
        >
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                        <h1>E-Certify Education</h1>
                        <h3>E-Certify Realestate Education</h3>

                </div>
                <div class="panel-body">

                    <input type="text" class="form-control" placeholder="Discount Coupon">
                    <br>
                    <button @click="getCheckoutRef">Apply</button>

                    <button class="btn btn-primary">Pay {{ amount - discount}} </button>

                </div>
            </div>
        </modal>

        <vue-stripe-checkout
                ref="checkoutRef"

                :name="name"
                :description="description"
                :currency="currency"
                :amount="amount"
                :allow-remember-me="false"
                :auto-open-modal= "true"
                @done="done"
                @opened="opened"
                @closed="closed"
                @canceled="canceled"
        >
            <input type="text" class="form-control">
        </vue-stripe-checkout>


    </div>
</template>

<script>
    export default {
        data() {
            return {

                name: 'E-Certify Education',
                description: 'E-Certify Real Estate Education',
                currency: 'USD',
                amount: 2900,
                coupon:'',
                discount:0,
            }
        },
        methods: {


            discount(){

                let data={
                    code : coupon
                }
                axios.get('/api/admin/coupons/get',data).then(response => {

                    console.log(response.data);

                this.discount=response.data;


            });

            },



            async checkout () {
        // token - is the token object
        // args - is an object containing the billing and shipping address if enabled
        const { token, args } = await this.$refs.checkoutRef.open();


        axios.post('/user/pay',token).then(response => {

            console.log(response.data);


         });
    },
    done ({token, args}) {
        // token - is the token object
        // args - is an object containing the billing and shipping address if enabled
        // do stuff...
    },


    opened () {
        // do stuff
    },
    closed () {
        // do stuff

        this.$modal.show('hello-world');
        console.log("closed !!")
    },
    canceled () {
        // do stuff
    }
    }
    }
</script>