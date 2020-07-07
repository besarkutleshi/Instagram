<template>
    <div>
        <form @submit.prevent="createcomment">
            <div class="d-flex">
                <input id="txtcomment" type="text" class="form-control" v-model="comment"  name="comment" placeholder="comment">
                <input type="submit" class="btn btn-primary ml-2" value="Send">
            </div>
        </form>
    </div>
</template>

<script>
    export default {

        props:['userid','postid','username','exist'],

        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
                comment:''
            }
        },
        methods:{
            createcomment(){
                let maindiv = document.createElement('div');
                let card = document.getElementById('card');
                if(this.exist == 0){
                    console.log('u kriju');
                    maindiv.className = "card-body";
                    maindiv.style.marginTop = "-30px";
                }else{
                    maindiv = document.getElementById('commentcard');
                }
                console.log('dul');
                axios.post('/c',{
                    user_id : this.userid,
                    post_id: this.postid,
                    comment: this.comment
                })
                    .then(response =>
                    {
                       let firstdiv = document.createElement("div");
                        firstdiv.className = "d-flex align-items-center";

                        let img = document.createElement("img");
                        img.style.height = "40px";
                        img.style.width = "40px";
                        axios.get('/profile/image/' + this.userid)
                            .then(message =>{
                                img.src = message.data;
                            });
                        img.className = "rounded-circle";

                        let a = document.createElement('a');
                        a.href = "/profile/" + this.userid;
                        a.textContent = this.username;
                        a.className = "text-dark ml-2";

                        let p = document.createElement('p');
                        p.textContent = this.comment;
                        p.className = "mt-3 ml-2";

                        firstdiv.appendChild(img);
                        firstdiv.appendChild(a);
                        firstdiv.appendChild(p);

                        maindiv.appendChild(firstdiv);
                        card.appendChild(maindiv);
                        document.getElementById('txtcomment').textContent = null;
                    });
            }
        },
    }
</script>
