<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div v-if="success" class="alert alert-success" role="alert">
                Messaggio inviato correttamente!
                </div>
                <form method="post" @submit.prevent="sendForm()">
                    <div class="form-group">
                    <label for="email">
                        Email
                    </label>
                    <input v-model="email" type="email" name="email">
                    <div v-if="errors && errors.email">
                        <ul>
                            <li v-for="(errorText, index) in errors.email" :key="'error_email' + index">
                                {{ errorText }}
                            </li>
                        </ul>
                    </div>
                    </div>
                    <div class="form-group">
                    <label for="name">
                        Name
                    </label>
                    <input v-model="name" type="text" name="name">
                    <div v-if="errors && errors.name">
                        <ul>
                            <li v-for="(errorText, index) in errors.name" :key="'error_name' + index">
                                {{ errorText }}
                            </li>
                        </ul>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                    <textarea v-model="message" name="message" cols="30" rows="10">


                    </textarea>
                    <div v-if="errors && errors.Message">
                        <ul>
                            <li v-for="(errorText, index) in errors.message" :key="'error_message' + index">
                                {{ errorText }}
                            </li>
                        </ul>
                    </div>
                    </div>
                    <button type="submit" :disabled="sending">Invia mail</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ContactsComponent',
    data(){
        return{
            email: '',
            name: '',
            message: '',
            sending: false,
            success: false,
            errors: []
        }
    },
    methods:{
        sendForm(){
            this.sending = true;
            this.success = false;

            window.axios.post('/api/contacts', {
                name: this.name,
                email: this.email,
                message: this.message,
            }).then(({data, status})=>{
                console.log(data);
                this.sending = false;

                if(status === 200){
                    this.success = data.success;
                    
                    if(!data.success){
                        this.errors = data.errors;
                        console.log(this.errors)
                    }
                }
                // this.message = '';
            }).catch(error =>{
                console.log(error);
            })
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
