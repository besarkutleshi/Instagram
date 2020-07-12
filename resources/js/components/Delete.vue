<template>
    <div>
        <a class="ml-2 mr-auto" style="cursor: pointer" id="delete" @click="deletecomment" ><span class="fa fa-trash"></span></a>
    </div>
</template>

<script>
    export default {
        props:['commentid','postid'],
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            deletecomment(){
                alert(this.commentid);
                axios.get('c/delete/' + this.commentid)
                    .then(response =>{
                        console.log('hini');
                        let dic = document.getElementById('commentcard' + this.postid);
                        alert(dic);
                        dic.remove();
                        console.log('ufshi po su hjek');
                    })
                    .catch(errors =>{

                    });
            }
        }
    }
</script>
