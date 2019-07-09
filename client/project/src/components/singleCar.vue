<template>
    <div id="single-blog" >
        <div  v-for="value in car">
            <h1>brand: {{ value.brand }}</h1>
            <p>model: {{ value.model }}</p>
            <p>speed: {{ value.speed }}</p>
            <p>capacity: {{ value.capacity }}</p>
            <p>price: {{ value.price }}</p>
            <router-link to="/show/" tag="button" class="btn btn-info">return</router-link>
            <router-link v-bind:to="'/buy/' + id" tag="button" class="btn btn-info">buy</router-link>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return{
                id: this.$route.params.id,
                car: [],
            }
        },
        created(){
            axios.get('http://localhost/rest/server/api/car/' + this.id, {
            }).then(res => {
                console.log(res.data);
                console.log(res.data.data.car);
                this.car = res.data.data.car
            }).catch(error => {
                console.log('error', error);
            })
        }
    }
</script>

<style>
    #single-blog{
        max-width: 960px;
        margin: 0 auto;
    }
</style>