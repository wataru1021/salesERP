import Vue from "vue";
import VeeValidate from "vee-validate";
import VueAxios from 'vue-axios';
import axios from 'axios';
import AdminLogin from "./components/admin/user/login.vue"
import SaleDailyReportHistories from "./components/admin/saleDailyreportHistory/index.vue"

Vue.use(VueAxios, axios);
Vue.use(VeeValidate, {
    locale: "ja"
});

new Vue({
    created() {
    },
    el: "#app",
    components: {
        
        AdminLogin,
        SaleDailyReportHistories
    },
    methods: {},
    mounted() {}
});
