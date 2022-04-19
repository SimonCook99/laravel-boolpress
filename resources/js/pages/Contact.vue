<template>
    <div class="container">
        <h1>I nostri contatti sono i seguenti</h1>
        
        <form @submit.prevent="sendForm">

            <div class="form-group">
                <label for="name">Inserisci il tuo nome</label>
                <input class="form-control" type="text" name="name" id="name" v-model="name">
            </div>

            <div class="form-group">
                <label for="email">Inserisci la tua mail</label>
                <input class="form-control" type="email" name="email" id="email" v-model="email">
            </div>

            <div class="form-group">
                <label for="message">Spiegaci perchè ci stai contattando</label>
                <textarea class="form-control" id="message" rows="10" name="message" v-model="message"></textarea>
            </div>

            <button class="btn btn-primary" type="submit">Invia</button>

        </form>
    </div>
</template>

<script>
    export default {
        name: "Contact",
        data(){
            return {
                name: "",
                email: "",
                message: ""
            }
        },
        methods: {
            sendForm(){
                axios.post("/api/contacts", {
                    "name" : this.name,
                    "email" : this.email,
                    "message" : this.message
                }).then ( response =>{
                    console.log(response);
                })
            }
        }
    }
</script>

<style>

</style>