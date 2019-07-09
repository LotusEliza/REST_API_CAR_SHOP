<template>
        <div>
             <div class="container">
                     <div class="row">
                             <div class="col-md-6 offset-md-3" style="text-align:center">
                                     <h1>Please make your order:</h1>
                             </div>
                     </div>
                <div class="row">
                        <div class="col-md-6 offset-md-3">

                                <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                                        <b-form-group
                                                id="input-group-1"
                                                label="Your name:"
                                                label-for="input-1"
                                        >
                                                <b-form-input
                                                        id="input-1"
                                                        v-model="form.name"
                                                        type="name"
                                                        required
                                                        placeholder="Enter name"
                                                ></b-form-input>
                                        </b-form-group>

                                        <b-form-group id="input-group-2" label="Your Surname:" label-for="input-2">
                                                <b-form-input
                                                        id="input-2"
                                                        v-model="form.surname"
                                                        required
                                                        placeholder="Enter surname"
                                                ></b-form-input>
                                        </b-form-group>

                                        <b-form-group id="input-group-3" label="Car ID:" label-for="input-3">
                                                <input class="form-control" type="text" v-model="form.carId" id="input-3" v-bind:placeholder="id" readonly>
                                        </b-form-group>

                                        <b-form-group id="input-group-4" >
                                                <b-form-checkbox-group v-model="form.payment" id="checkboxes-4" >
                                                                <b-form-checkbox value="1" v-model="additional" :disabled="hasAdditional">Cash</b-form-checkbox>
                                                                <b-form-checkbox value="2" v-model="additional" :disabled="hasAdditional">Credit cart</b-form-checkbox>

<!--                                                        <b-form-checkbox value="cash" v-model="payment" :disabled="hasAdditional">Cash</b-form-checkbox>-->
<!--                                                        <b-form-checkbox value="credit cart" v-model="payment" :disabled="hasAdditional">Credit cart</b-form-checkbox>-->
                                                </b-form-checkbox-group>
                                        </b-form-group>

                                        <b-button type="submit" variant="primary">Submit</b-button>
                                        <b-button type="reset" variant="danger">Reset</b-button>
                                        <router-link to="/show/" tag="button" class="btn btn-info">Back to Shop</router-link>
                                </b-form>
                        </div>
                </div>
             </div>
        </div>
</template>

<script>
        import axios from 'axios';

    export default {
        data() {
            let id = this.$route.params.id;
            return {
                form: {
                    surname: '',
                    name: '',
                    carId: id,
                    payment: '',
                },
                show: true,
                additional: 0
            }
        },
        computed:{
            hasAdditional() {
                return this.additional.length > 0
            }
        },
        methods: {
            onSubmit(evt) {
                evt.preventDefault()
                    axios.post('http://localhost/rest/server/api/order/', {
                            name: this.form.name,
                            surname: this.form.surname,
                            carId: this.form.carId,
                            payment: this.additional[0],
                            jwt: localStorage.getItem('token')
                    })
                            .then(function (response) {
                                    console.log(response.data)
                                    alert("Thank you for your order!")
                            })
                            .catch(function (error) {
                                    console.log('error', error);
                                    alert("Error!")
                                    // currentObj.output = error;
                            });

                    setTimeout( () => this.$router.push({ path: '/'}), 1000);

            },
            onReset(evt) {
                evt.preventDefault()
                // Reset our form values
                this.form.name = ''
                this.form.surname = ''
                this.form.payment = null
                this.additional = 0

                // Trick to reset/clear native browser form validation state
                this.show = false
                this.$nextTick(() => {
                    this.show = true
                })
            }
        }
    }
</script>