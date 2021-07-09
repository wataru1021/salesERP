import Vue from "vue";
import VeeValidate from "vee-validate";
import VueAxios from 'vue-axios';
import axios from 'axios';
import SalesLogin from "./components/sales/user/login.vue"
import DailyReportCreate from "./components/sales/dailyReport/create.vue"
import DailyReportComplete from "./components/sales/dailyReport/complete.vue"
import SalesTop from "./components/sales/user/top/top.vue";
import SalesManagement from "./components/sales/user/salesmanagement.vue"
import SalesReportHistories from './components/sales/repothistories'

Vue.use(VueAxios, axios);
Vue.use(VeeValidate, {
    locale: "ja"
});

new Vue({
    created() {},
    el: "#app",
    components: {
        SalesLogin,
        DailyReportCreate,
        DailyReportComplete,
        SalesTop,
        SalesManagement,
        SalesReportHistories
    },
    methods: {},
    mounted() {}
});