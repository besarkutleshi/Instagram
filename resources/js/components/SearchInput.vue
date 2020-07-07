<template>
    <div>
        <input id="txtsearch"  @input="showtext" class="form-control" type="text" placeholder="search">
    </div>
</template>

<script>
    export default {

        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            showtext(){
                var searchtext = document.getElementById('txtsearch').value;
                var drop = document.getElementById('drop');
                var modalbody = document.getElementById('modalbody');
                let firstdiv = document.createElement("div");
                console.log(searchtext);

                if(searchtext == ''){
                    console.log("ufshi");
                    modalbody.innerHTML = "";
                }else{
                    axios.get('/profile/search/' + searchtext)
                        .then(response =>
                        {
                            modalbody.innerHTML = "";
                            if(searchtext == 'undefined'){
                                console.log("ufshi");
                                modalbody.removeChild(firstdiv);
                            }
                            else{
                                $.each(response.data, function(key, value) {
                                    firstdiv.className = "row justify-content-center";

                                    let seconddiv = document.createElement("div");
                                    seconddiv.classList.add("card");
                                    seconddiv.style.width="350px";

                                    let a = document.createElement("a");
                                    a.classList.add("text-dark");
                                    a.href = "/profile/" + value.id;

                                    let thirddiv = document.createElement("div");
                                    thirddiv.className = "card-body d-flex align-items-center";

                                    let img = document.createElement("img");
                                    img.style.height = "42px";
                                    img.style.width = "42px";
                                    axios.get('/profile/image/' + value.id)
                                        .then(message =>{
                                            img.src = message.data;
                                        });
                                    img.className = "rounded-circle";

                                    let h5 = document.createElement("h5");
                                    h5.textContent = value.username;
                                    h5.className = "ml-3 mt-1";

                                    thirddiv.appendChild(img);
                                    thirddiv.appendChild(h5);
                                    a.appendChild(thirddiv);
                                    seconddiv.appendChild(a);
                                    firstdiv.appendChild(seconddiv);

                                    modalbody.append(firstdiv);
                                });
                            }
                        });
                }
            }
        },
    }
</script>
