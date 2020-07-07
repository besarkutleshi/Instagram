<template>
    <div>
        <button class="btn btn-primary ml-5" @click="followuser" v-text="buttontext"></button>
    </div>
</template>

<script>
    export default {

        props:['userId','follows'],

        data:function(){
            return {
                status:this.follows,
            }
        },

        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            followuser(){
                axios.post('/following/' + this.userId)
                    .then(response =>
                    {
                        console.log(response.data)
                        this.status = !this.status;
                    })
                    .catch(errors =>{
                       if(errors.response.status == 401){
                           window.location = '/login';
                       }
                    });
            }
        },
        computed:{
            buttontext(){
                return (this.status) ? 'Un Follow' : 'Follow'
            }
        }
    }
</script>
