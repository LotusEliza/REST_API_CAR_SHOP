import Vue from 'vue';
import Vuex from 'vuex';
// import user from './modules/user';
import axios from 'axios'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        status: '',
        token: localStorage.getItem('token') || '',
        user : {},
        // cars: [
        //     {"id":"1","brand":"Aston-Martin","model":"DB5"},
        //     {"id":"2","brand":"Aston-Martin","model":"V8 Vantage"},
        //     {"id":"3","brand":"Audi","model":"A3"},
        //     {"id":"4","brand":"Audi","model":"S3"},
        //     {"id":"5","brand":"Bugatti","model":"Type 2"},
        //     {"id":"6","brand":"Bugatti","model":"Type 5"},
        //     {"id":"7","brand":"Aston-Martin","model":"S3"}
        // ],
    },


    mutations: {
        auth_request(state){
            state.status = 'loading'
        },
        auth_success(state, token, user){
            state.status = 'success'
            state.token = token
            state.user = user
        },
        auth_error(state){
            state.status = 'error'
        },
        logout(state){
            state.status = ''
            state.token = ''
        },
    },

    actions: {

        login({commit}, { name, password, token }){
            commit('auth_success', token, {name, password})
            localStorage.setItem('token', token)

        // login({commit}, user, token){
        //
        //         commit('auth_success', token, user)
        //         localStorage.setItem('token', token)

            // return new Promise((resolve, reject) => {
            //     commit('auth_request')
            //     axios({url: 'http://localhost/rest/server/api/user/login/', data: user, method: 'POST' })
            //     // axios({url: 'https://jsonplaceholder.typicode.com/posts', data: user, method: 'POST' })
            //         .then(resp => {
            //
            //             console.log(resp.data)
            //             const token = resp.data.data.jwt
            //             // const token = '12122'
            //             localStorage.setItem('token', token)
            //             // Add the following line:
            //             commit('auth_success', token, user)
            //             resolve(resp)
            //         })
            //         .catch(err => {
            //             commit('auth_error')
            //             localStorage.removeItem('token')
            //             reject(err)
            //         })
            // })
        },
        register({commit}, { name, password, token }){
            commit('auth_success', token, {name, password})
            localStorage.setItem('token', token)
            // return new Promise((resolve, reject) => {
            //     commit('auth_request')
            //     axios({url: 'http://localhost/rest/server/api/user/register/', data: user, method: 'POST' })
            //     // axios({url: 'https://jsonplaceholder.typicode.com/posts', data: user, method: 'POST' })
            //         .then(resp => {
            //
            //             console.log(resp.data)
            //             const token = resp.data.data.jwt
            //
            //             // const token = '12122'
            //             console.log(token)
            //             localStorage.setItem('token', token)
            //             commit('auth_success', token, user)
            //             resolve(resp)
            //         })
            //         .catch(err => {
            //             commit('auth_error', err)
            //             localStorage.removeItem('token')
            //             reject(err)
            //         })
            // })
        },

        logout({commit}){
            return new Promise((resolve, reject) => {
                commit('logout')
                localStorage.removeItem('token')
                // delete axios.defaults.headers.common['Authorization']
                resolve()
            })
        },


    },

    getters : {
        isLoggedIn: state => state.token,
        authStatus: state => state.status,
    }
})