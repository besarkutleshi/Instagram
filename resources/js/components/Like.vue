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
              axios.post('like',{
                  user_id : this.userid,
                  post_id : this.postid
              }).then(response =>{
                if(response.data == "deleted"){
                    this.status--;
                    let span = document.createElement('span');
                    span.className="ml-1"
                    span.textContent = "likes";
                    document.getElementById('likes').textContent = this.status;
                    document.getElementById('likes').appendChild(span);
                    document.getElementById('heart').style.color = "#DADDE0";
                }else{
                    this.status++;
                    let span = document.createElement('span');
                    span.className="ml-1"
                    span.textContent = "likes";
                    document.getElementById('likes').textContent = this.status;
                    document.getElementById('likes').appendChild(span);
                    document.getElementById('heart').style.color = "red";
                }
            }).catch(errors =>{

            });
          }
        },
    }
</script>
