<template>
    <div class="container">
        <h1>I nostri contatti sono i seguenti</h1>

        <div v-if="success" class="alert alert-success">
            Email inviata con successo, grazie per averci contattato
        </div>
        
        <form @submit.prevent="sendForm">

            <div class="form-group">
                <label for="name">Inserisci il tuo nome</label>
                <input class="form-control" :class="{'is-invalid':errorsList.name}" type="text" name="name" id="name" v-model="name">

                <p v-for="(error, index) in errorsList.name" :key=" 'error_name' + index" class="invalid-feedback">
                    {{error}}
                </p>
            
            </div>

            <div class="form-group">
                <label for="email">Inserisci la tua mail</label>
                <input class="form-control" :class="{'is-invalid':errorsList.email}" type="email" name="email" id="email" v-model="email">
            
                <p v-for="(error, index) in errorsList.email" :key=" 'error_email' + index" class="invalid-feedback">
                    {{error}}
                </p>
            </div>

            <div class="form-group">
                <label for="message">Spiegaci perchè ci stai contattando</label>
                <textarea class="form-control" :class="{'is-invalid':errorsList.message}" id="message" rows="10" name="message" v-model="message"></textarea>
            
                <p v-for="(error, index) in errorsList.message" :key=" 'error_message' + index" class="invalid-feedback">
                    {{error}}
                </p>

            </div>

            <button class="btn btn-primary" type="submit" :disabled='sendingLoading'>{{sendingLoading ? 'Invio in corso' : 'Invia'}}</button>

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
                message: "",

                success: false, //booleano che indica se il messaggio è stato correttamente inviato, mostrando eventualmente un div di conferma in cima al form

                sendingLoading: false, //booleano per indicare se c'è il caricamento di una nuova email

                errorsList: {} //oggetto che conterrà la lista degli errori presenti qualora l'invio non vada a buon fine
            }
        },
        methods: {
            sendForm(){

                this.sendingLoading = true;

                axios.post("/api/contacts", {
                    "name" : this.name,
                    "email" : this.email,
                    "message" : this.message
                }).then (response =>{
                    this.sendingLoading = false;


                    //se ci sono degli errori, allora li inserisco nell'oggetto errors e li mostro nei paragrafi del form,
                    //altrimenti settiamo il success a true per indicare all'utente il corretto invio del messaggio, e infine resettiamo i campi
                    if(response.data.errors){
                        this.errorsList = response.data.errors;
                        this.success = false;
                    }else{

                        this.success = true;

                        this.name = this.email = this.message = '';
                        this.errors = {};
                    }

                    console.log(response);
                })
            }
        }
    }
</script>

<style>

</style>