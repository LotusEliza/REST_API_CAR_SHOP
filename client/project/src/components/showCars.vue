    <template>
        <div>
            <div class="container">
                <div class="row">
                    <div class='col' style="text-align:center">
                        <h3>Car list:</h3>
                    </div>
                </div>
                <div class="row">
                    <div class='col-6 col-md-4 d-flex align-items-center' style='padding: 20px 20px 20px 20px;' v-for="car in cars">
                        <div class="item-car">
                            <router-link v-bind:to="'/car/' + car.id">
                                <img src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT5b2ZRBIdlgBkk9ceFmhFoS4
                    MO0esAmBS8IUaPZeJO-ZD56OzhuA'><br>
                                <h3 v-rainbow>{{ car.brand }} {{car.model}}</h3></router-link>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios';

    export default {
        data () {
            return {
                cars: [],
            }
        },
        created() {
            axios.get('http://localhost/rest/server/api/car/', {
            }).then(res => {
                console.log(res.data);
                this.cars = res.data.data.cars
            }).catch(error => {
                console.log('error', error);
            })
        },
        directives: {
            'rainbow':{
                bind(el, binding, vnode){
                    el.style.color = "#" + Math.random().toString().slice(2,8);
                }
            }
        },
    }
</script>

<style>
    .item-car{
        background-color: rgba(255, 0, 0, 0.5);
    }

    img {
        width: 300px; /* You can set the dimensions to whatever you want */
        height: 150px;
        object-fit: cover;
    }
</style>