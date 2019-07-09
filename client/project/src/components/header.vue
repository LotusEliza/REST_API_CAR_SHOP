<template>
    <nav>
        <ul>
            <li><router-link to="/" exact>Home</router-link></li>
            <li><router-link to="/show" exact>Cars</router-link></li>
            <li><router-link to="/search" exact>Search</router-link></li>
            <li><router-link to="/secure" exact>Account</router-link></li>
            <span v-if="isLoggedIn"><a @click="logout">Logout</a></span>
        </ul>
    </nav>
</template>

<script>

    export default {
        computed : {
            isLoggedIn : function(){ return this.$store.getters.isLoggedIn}
        },
        methods: {
            logout: function () {
                // localStorage.removeItem('token')
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/')
                    })
            }
        },
    }
</script>

<style scoped>
    ul{
        list-style-type: none;
        text-align: center;
        margin: 0;
    }
    li{
        display: inline-block;
        margin: 0 10px;
    }
    a{
        color: #fff;
        text-decoration: none;
        padding: 6px 8px;
        border-radius: 10px;
    }
    span{
        color: #fff;
    }
    nav{
        background: #444;
        padding: 14px 0;
        margin-bottom: 40px;
    }
</style>