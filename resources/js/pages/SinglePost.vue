<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div v-if="post">
                    <h1>{{post.title}}</h1>
                    <p>{{post.content}}</p>

                    <h3 v-if="post.category">Categoria: {{post.category.name}}</h3>

                    <p>Lista tags:</p>
                    <ul>
                        <li v-for="tag in post.tags" :key="tag.id">{{tag.name}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "SingePost",

        data(){
            return{
                post: null
            }
        },

        mounted(){
            const slug = this.$route.params.slug;

            axios.get("/api/posts/" + slug).then( (response) =>{

                if(response.data.success == false){
                    this.$router.push({name: "not-found"}); //con questa sintassi, faccio il redirect alla rotta 404
                }else{
                    this.post = response.data.result; //memorizzo le informazioni del singolo post nella variabile this.post
                }

            });
        }
    }
</script>

<style>

</style>