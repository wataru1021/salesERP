import Vue from "vue";
import VeeValidate from "vee-validate";
import VueAxios from 'vue-axios';
import axios from 'axios';
import SalesLogin from "./components/sales/user/login.vue";
import SalesTop from "./components/sales/user/top/top.vue";
import SalesManagement from "./components/sales/user/salesmanagement.vue"

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
        SalesTop,
        SalesManagement
    },
    methods: {},
    mounted() {}
});
