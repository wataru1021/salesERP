import Vue from "vue";
import VeeValidate from "vee-validate";
import VueAxios from 'vue-axios';
import axios from 'axios';
import SalesLogin from "./components/sales/user/login.vue"
import SalesForgotPassword from "./components/sales/user/password/forgot.vue"
import SalesChangePassword from "./components/sales/user/password/change.vue"
import SalesSuccessPassword from "./components/sales/user/password/success.vue"

Vue.use(VueAxios, axios);
Vue.use(VeeValidate, {
    locale: "ja"
});

new Vue({
    created() {},
    el: "#app",
    components: {
        SalesLogin,
        SalesForgotPassword,
        SalesChangePassword,
        SalesSuccessPassword
    },
    methods: {},
    mounted() {}
});