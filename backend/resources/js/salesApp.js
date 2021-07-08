import Vue from "vue";
import VeeValidate from "vee-validate";
import VueAxios from 'vue-axios';
import axios from 'axios';
import SalesLogin from "./components/sales/user/login.vue"
import SalesForgotPassword from "./components/sales/user/password/forgot.vue"
import SalesChangePassword from "./components/sales/user/password/change.vue"
import SalesSuccessPassword from "./components/sales/user/password/success.vue"
import SalesSuccessEmail from "./components/sales/user/password/successemail.vue"
import DailyReportCreate from "./components/sales/dailyReport/create.vue"
import DailyReportComplete from "./components/sales/dailyReport/complete.vue"
import SalesTop from "./components/sales/user/top/top.vue";
import SalesManagement from "./components/sales/user/salesmanagement.vue"

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
        SalesSuccessPassword,
        SalesSuccessEmail,
        DailyReportCreate,
        DailyReportComplete,
        SalesTop,
        SalesManagement
    },
    methods: {},
    mounted() {}
});