<template>

    <div class="card-body d-flex flex-column">
        <h5 class="card-title">{{title}}</h5>
        <p class="card-text">{{ truncateText(content)}}</p>

        <!--&nbsp serve a mantenere lo spazio dell'elemento anche qualora non fosse presente-->
        <!--In questo caso quindi, anche se non ci fosse una categoria associata al post, ci sarebbe comunque un bottone vuoto con la stessa grandezza-->
        <button type="button" class="btn btn-outline-success">{{category ? category.name : '&nbsp;'}}</button>

        <router-link class="btn btn-primary" :to="{name: 'single-post', params: {slug: slug}}">Mostra dettagli post</router-link>

    </div>
    
</template>

<script>
    export default {
        name: "Post",
        props: ["title", "content", "slug", "category", "tags"],
        data(){
            return{
                lunghezzaContent: 40
            }
        },

        methods:{
            //funzione per tagliare il testo del content, se raggiunge una lunghezza prestabilita (in questo caso 50)
            truncateText(text){
                if(text.length > this.lunghezzaContent){
                    return text.substring(0, this.lunghezzaContent) + "...";
                }else{
                    return text;
                }
            }
        }
    }
</script>

<style>

</style>