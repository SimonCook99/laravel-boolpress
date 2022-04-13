<template>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <a class="navbar-brand" href="#">Boolpress</a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">

                    <!--router-link è un altro componente predefinito di vue-router,-->
                    <!--e serve ad avere un link diretto al nome di una rotta, senza ricaricare la pagina ogni volta-->
                    <!--come succederebbe con il tag <a>, e il riferimento diretto al link della rotta-->

                    <router-link class="nav-link" :to="{name: 'home'}">Home</router-link>

                </li>
                <li class="nav-item">    
                    <router-link class="nav-link" :to="{name: 'about'}">Chi Siamo</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'contact'}">Contatti</router-link>
                </li>
                <li class="nav-item">
                    <router-link class="nav-link" :to="{name: 'blog'}">Blog</router-link>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/admin">Accesso Admin</a>
                </li>
            </ul>
        </nav>
</template>

<script>
    export default {
        name: "header"
    }
</script>

<style>

</style>