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
                let card = document.getElementById(this.postid);
                var counter = 0;
                if(this.exist == 0){
                    console.log('u kriju maindiv');
                    maindiv.className = "card-body";
                    maindiv.style.marginTop = "-30px";

                }else{
                    console.log('u eee');
                    maindiv = document.getElementById('commentcard' + this.postid);
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
                        firstdiv.id = "firstdiv" + response.data.id;
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

                        let clear = document.createElement('button');
                        clear.style.background = "none";
                        clear.style.border = "0";
                        clear.style.outline = "none";
                        clear.className = "ml-2 mr-auto";
                        clear.onclick = function(){
                            axios.get('c/delete/' + response.data.id)
                                .then(response =>{
                                    console.log('ufshi');
                                    firstdiv.remove();
                                })
                                .catch(errors =>{

                                });
                        };


                        let span = document.createElement('span');
                        span.className = "fa fa-trash ml-2";
                        span.style.color = "red";
                        clear.appendChild(span);




                        firstdiv.appendChild(img);
                        firstdiv.appendChild(a);
                        firstdiv.appendChild(p);
                        firstdiv.appendChild(clear);

                        maindiv.appendChild(firstdiv);
                        card.appendChild(maindiv);
                        document.getElementById('txtcomment').value = '';
                    });
            }
        },
    }
</script>
