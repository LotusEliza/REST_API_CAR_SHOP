<template>
    <div>
        <div class="container">
            <div class="row">
                <div class='col' style="text-align:center">
                    <h3>Find a car that perfectly suits you:</h3>
                </div>
            </div>
            <div class="row padding">
                    <div class='col'>
                        <b-button block v-b-toggle.collapse-2 variant="info">Advanced Search</b-button>
                        <b-collapse id="collapse-2" class="mt-2">
                            <b-card>
                                <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                                    <b-form-group
                                            id="input-group-1"
                                            label="Year:"
                                            label-for="input-1"
                                    >
                                        <b-form-input
                                                id="input-1"
                                                v-model="form.year"
                                                type="name"
                                                required
                                                placeholder="Enter year"
                                        ></b-form-input>
                                    </b-form-group>

                                    <b-form-group
                                            id="input-group-1"
                                            label="Color:"
                                            label-for="input-1"
                                    >
                                        <b-form-input
                                                id="input-1"
                                                v-model="form.color"
                                                type="name"
                                                placeholder="Enter color"
                                        ></b-form-input>
                                    </b-form-group>

                                    <b-form-group id="input-group-2" label="Price:" label-for="input-2">
                                        <b-form-input
                                                id="input-2"
                                                v-model="form.price"
                                                placeholder="Enter color"
                                        ></b-form-input>
                                    </b-form-group>

                                    <b-form-group
                                            id="input-group-1"
                                            label="Speed:"
                                            label-for="input-1"
                                    >
                                        <b-form-input
                                                id="input-1"
                                                v-model="form.speed"
                                                type="name"
                                                placeholder="Enter year"
                                        ></b-form-input>
                                    </b-form-group>

                                    <b-form-group
                                            id="input-group-1"
                                            label="Capacity:"
                                            label-for="input-1"
                                    >
                                        <b-form-input
                                                id="input-1"
                                                v-model="form.capacity"
                                                type="name"
                                                placeholder="Enter capacity"
                                        ></b-form-input>
                                    </b-form-group>

                                    <b-button type="submit" variant="primary">Search</b-button>
                                </b-form>
                            </b-card>
                        </b-collapse>
                    </div>
                </div>
            <div class="row">
                <div class='col-6 col-md-4 d-flex align-items-center' style='padding: 20px 20px 20px 20px;' v-for="car in searchCars">
                    <div class="item-car">
                        <img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5b2ZRBIdlgBkk9ceFmhFoS4
                    MO0esAmBS8IUaPZeJO-ZD56OzhuA' width='300' height='150'><br>
                        <router-link v-bind:to="'/car/' + 1">
                            <h3>{{ car.brand }}{{car.model}}</h3></router-link>
                    </div>
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
                    year: '',
                    color: '',
                    price: null,
                    speed: null,
                    capacity: null,
                },
                show: true,
                additional: 0,
                searchCars: []
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

                let cars = [];
                axios.post('http://localhost/rest/server/api/car/search/', {
                    year: this.form.year,
                    color: this.form.color,
                    price: this.form.price,
                    speed: this.form.speed,
                    capacity: this.form.capacity,
                })
                .then(function (response) {
                    console.log(response.data)
                    console.log(response.data.data)

                    cars = response.data.data
                    // currentObj.output = response.data;
                })
                .catch(function (error) {
                    console.log('error', error);
                    // currentObj.output = error;
                });

                setTimeout( () => this.searchCars = cars, 1000);
            },
            onReset(evt) {
                evt.preventDefault()
                // Reset our form values
                this.form.year = ''
                this.form.color = ''
                this.form.price = null
                this.speed = null
                this.capacity = null

                // Trick to reset/clear native browser form validation state
                this.show = false
                this.$nextTick(() => {
                    this.show = true
                })
            }
        }
    }
</script>
<style>
    .padding{
        padding: 50px;
    }
</style>