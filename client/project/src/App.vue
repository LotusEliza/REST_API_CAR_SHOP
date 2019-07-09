<template>
    <div>
        <app-header></app-header>
        <router-view></router-view>
        <app-footer></app-footer>
    </div>
</template>

<script>

    import showCars from './components/showCars.vue';
    import header from './components/header.vue';
    import footer from './components/footer.vue';
    import modalRegister from './components/modalRegister.vue';
    import modalLogin from './components/modalLogin.vue';
    import buyCar from './components/buyCar.vue';
    import search from './components/search.vue';
    import secure from './components/secure.vue';

export default {
  name: 'App',

    components:{
      'show-cars': showCars,
      'app-header': header,
      'app-footer': footer,
      'modal': modalRegister,
      'buyCar': buyCar,
      'modalLogin': modalLogin,
      'search': search,
      'secure': secure,
    },

    data () {
        return {

        }
    },
    methods: {

    }
}
</script>

<style>
  /*body {*/
  /*width: 100wh;*/
  /*height: 90vh;*/
  /*color: #fff;*/
  /*background: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB);*/
  /*background-size: 400% 400%;*/
  /*-webkit-animation: Gradient 15s ease infinite;*/
  /*-moz-animation: Gradient 15s ease infinite;*/
  /*animation: Gradient 15s ease infinite;*/
  /*}*/

  /*@-webkit-keyframes Gradient {*/
  /*0% {*/
  /*background-position: 0% 50%*/
  /*}*/
  /*50% {*/
  /*background-position: 100% 50%*/
  /*}*/
  /*100% {*/
  /*background-position: 0% 50%*/
  /*}*/
  /*}*/

  /*@-moz-keyframes Gradient {*/
  /*0% {*/
  /*background-position: 0% 50%*/
  /*}*/
  /*50% {*/
  /*background-position: 100% 50%*/
  /*}*/
  /*100% {*/
  /*background-position: 0% 50%*/
  /*}*/
  /*}*/

  /*@keyframes Gradient {*/
  /*0% {*/
  /*background-position: 0% 50%*/
  /*}*/
  /*50% {*/
  /*background-position: 100% 50%*/
  /*}*/
  /*100% {*/
  /*background-position: 0% 50%*/
  /*}*/
  /*}*/

  /*h1,*/
  /*h6 {*/
  /*font-family: 'Open Sans';*/
  /*font-weight: 300;*/
  /*text-align: center;*/
  /*position: absolute;*/
  /*top: 45%;*/
  /*right: 0;*/
  /*left: 0;*/
  /*}*/
</style>


