<template>
    <div>
        <form @submit.prevent="like" method="post">
            <button style="background: none;border: none">
                <span id="heart" class="fa fa-heart" style="font-size:28px;"></span>
            </button>
        </form>
    </div>
</template>

<script>
    export default {

        props:['userid','postid','likes'],

        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
                status: this.likes,
            }
        },
        methods:{
          like(){
              let like = document.getElementById('likeid' + this.postid);
              let span = like.querySelector('span');
              axios.post('like',{
                  user_id : this.userid,
                  post_id : this.postid
              }).then(response =>{
                if(response.data == "deleted"){
                    this.status--;
                    document.getElementById('likes' + this.postid).textContent = this.status;
                    span.style.color = "#DADDE0";


                }else{
                    this.status++;
                    document.getElementById('likes' + this.postid ).textContent = this.status;
                    span.style.color = "red";
                }
            }).catch(errors =>{

            });
          }
        },
    }
</script>
