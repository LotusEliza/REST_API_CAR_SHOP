<template>
    <div>
        <b-button v-b-modal.modal-login>Login</b-button>
        <b-modal
                id="modal-login"
                ref="modal"
                title="Submit Your Name"
                @show="resetModal"
                @hidden="resetModal"
                @ok="handleOk">
            <form ref="form" @submit.stop.prevent="login">
                <b-form-group
                        :state="nameState"
                        label="Name"
                        label-for="name-input"
                        invalid-feedback="Name is required">
                    <b-form-input
                            id="name-input"
                            v-model="name"
                            :state="nameState"
                            required
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                        :state="passwordState"
                        label="Password"
                        label-for="password-input"
                        invalid-feedback="Password is required">
                    <b-form-input
                            id="password-input"
                            v-model="password"
                            :state="passwordState"
                            required
                    ></b-form-input>
                </b-form-group>
            </form>
        </b-modal>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: 'ModalLogin ',
        data() {
            return {
                name: '',
                nameState: null,
                password: '',
                passwordState: null,
                submittedNames: []
            }
        },
        methods: {
            checkFormValidity() {
                const valid = this.$refs.form.checkValidity()
                this.nameState = valid ? 'valid' : 'invalid'
                this.passwordState = valid ? 'valid' : 'invalid'
                return valid
            },
            resetModal() {
                this.name = ''
                this.nameState = null
                this.password = ''
                this.passwordState = null
            },
            handleOk(bvModalEvt) {
                // Prevent modal from closing
                bvModalEvt.preventDefault()
                // Trigger submit handler
                this.login()
            },
            login() {
                // Exit when the form isn't valid
                if (!this.checkFormValidity()) {
                    return
                }

                let token = '';

                axios.post('http://localhost/rest/server/api/user/login/', {
                    loginUserName: this.name,
                    loginPassword: this.password,
                })
                .then(function (response) {
                    console.log(response.data)
                    token = response.data.data.jwt
                })
                .catch(function (error) {
                    if(error.response){
                        alert(error.response.data.status_message)
                    }
                    // console.log('error', error);
                    localStorage.removeItem('token')
                    // currentObj.output = error;
                });


                setTimeout( () => this.$store.dispatch('login', {
                    name: this.name,
                    password: this.password,
                    token: token,
                })
                    .then(() => this.$router.push('/'))
                    .catch(err => console.log(err)), 1000);

                this.$nextTick(() => {
                    this.$refs.modal.hide()
                })
            }
        }
    }
</script>
<style scoped>
    * {
       color: #50B9C5;
        font-weight: bold;
        font-size: large;
    }
</style>