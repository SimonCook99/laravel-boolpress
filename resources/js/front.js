//File nuovo creato da noi, che si occuperà della parte javascript del frontend del sito, istanziando il componente Vue

window.Vue = require("vue");

window.axios = require("axios"); //importiamo axios per le chiamate API che faremo nel frontend
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from "vue";
import App from "./views/App";

//agiungo il componente router, così da poter usare vue-router nell'istanza di Vue del progetto (rigo 18)
import router from "./router";

const app = new Vue({

    el: "#root",
    render: h => h(App),
    router
});