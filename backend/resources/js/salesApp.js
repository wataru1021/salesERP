import Vue from "vue";
import VeeValidate from "vee-validate";
import VueAxios from 'vue-axios';
import axios from 'axios';
import SalesLogin from "./components/sales/user/login.vue"
import SalesRegister from "./components/sales/user/register.vue"

Vue.use(VueAxios, axios);
Vue.use(VeeValidate, {
    locale: "ja"
});

new Vue({
    created() {
    },
    el: "#app",
    components: {
        SalesLogin,
        SalesRegister
    },
    methods: {},
    mounted() {}
});
