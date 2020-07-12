<template>
    <div>
        <a id="likeslink" @click="getlikes" data-toggle="modal" data-target="#likesmodal" href="#likesmodal" class="ml-1 text-dark">likes</a>
    </div>
</template>

<script>
    export default {
        name: "Likes",
        props:['postid'],
        methods:{
            getlikes(){
                let maindiv = document.getElementById('likescard');
                axios.get('/likes/' + this.postid)
                    .then(response =>{

                        maindiv.innerHTML = "";
                        $.each(response.data,function (key,value) {
                            let a = document.createElement('a');
                            a.className = "text-dark";
                            a.href = "/profile/" + value.user_id;

                            let div = document.createElement('div');
                            div.className = "card-body d-flex align-items-center";

                            let img = document.createElement('img');
                            img.className = "rounded-circle";
                            img.height = 42;
                            img.width = 42;
                            axios.get('/profile/image/' + value.user_id)
                                .then(message =>{
                                    img.src = message.data;
                                });

                            let h5 = document.createElement('h5');
                            h5.className = "mt-2 pl-3";
                            h5.textContent = value.username;

                            div.appendChild(img);
                            div.appendChild(h5);

                            a.appendChild(div);

                            maindiv.appendChild(a);

                        })
                    })
                    .catch(errors =>{

                    })
            }
        }
    }
</script>

<style scoped>

</style>
