<template>
    <div>
        {{$route.params.slug}}
    </div>
</template>

<script>
    export default {
        name: "SingePost",

        mounted(){
            const slug = route.params.slug;

            axios.get("/api/posts/" + slug).then( (response) =>{
                console.log(response);
            });
        }
    }
</script>

<style>

</style>