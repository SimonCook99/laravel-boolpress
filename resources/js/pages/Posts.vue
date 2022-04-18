<template>
    <main class="container">
        <h1>Test prova Vue-Laravel</h1>
        <h3>Sezione front-end del sito</h3>

        <br>

        <h1>Lista post:</h1>

        <!--contenitore delle card, che sarò ripetuto per ogni post-->
        <div class="row">
            <div class="card d-flex col-4" v-for="post in posts" :key="post.id" style="width: 18rem;">
                <Post
                    :title="post.title"
                    :content="post.content"
                    :slug="post.slug"
                    :category="post.category"
                    :tags="post.tags"
                    :img="post.cover"
                />
            </div>
        </div>

        <!--Barra di navigazione per cambiare pagina, verrà chiamata la funzione apposita, passandogli come parametro la pagina precedente o successiva-->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item" :class="currentPage==1 ? 'd-none' : '' ">
                    <button class="page-link" @click="changePagePosts(currentPage - 1)">Previous</button>
                </li>
                <li class="page-item" :class="currentPage==lastPage ? 'd-none' : '' ">
                    <button class="page-link" @click="changePagePosts(currentPage + 1)">Next</button>
                </li>
            </ul>
        </nav>
        
    </main>
</template>

<script>
    import Post from "./Post";

    export default {
        name : "Posts",
        components:{
            Post
        },

        data(){
            return{
                posts: [],
                currentPage: 1,
                lastPage: null
            }
        },

        methods:{

            //passiamo alla chiamata axios come parametro, la pagina dove deve andare
            changePagePosts(PaginaDaCambiare){
                axios.get("/api/posts", {
                    "params": {
                        "page": PaginaDaCambiare
                    }
                }).then( (response) => {
                    console.log(response);
                    

                    //Aggiorniamo la pagina corrente, con la variabile "current_page" creata in automatico da Laravel
                    this.currentPage = response.data.results.current_page;

                    this.posts = response.data.results.data;
                    console.log(this.posts);

                    this.lastPage = response.data.results.last_page;
                });
            }
        },

        created(){
            this.changePagePosts(this.currentPage);
        }
    }
</script>

<style>

</style>