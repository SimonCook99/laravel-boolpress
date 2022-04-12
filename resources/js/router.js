//FILE NUOVO CREATO DA NOI PER LA GESTIONE DI VUE-ROUTER

import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);


//La cartella "pages" dentro resources, conterrà tutte le view di frontend che saranno gestite da VueRouter (rigo 13)
import Home from "./pages/Home";
import About from "./pages/About.vue";
import Contact from "./pages/Contact.vue";
import Posts from "./pages/Posts.vue";
import SinglePost from "./pages/SinglePost.vue";




const router = new VueRouter({
    mode: "history",

    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/chi-siamo",
            name: "about",
            component: About
        },
        {
            path: "/contatti",
            name: "contact",
            component: Contact
        },
        {
            path: "/posts",
            name: "posts",
            component: Posts
        },
        {
            path: '/posts/:slug', //equivale a Laravel: Route::get('/posts/{slug}', 'Api\PostController@show');
            name: 'single-post',
            component: SinglePost
        },
    ]
});


export default router;
