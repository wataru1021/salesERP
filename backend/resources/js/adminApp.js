import Vue from "vue";
import VeeValidate from "vee-validate";
import VueAxios from 'vue-axios';
import axios from 'axios';
import AdminLogin from "./components/admin/user/login.vue"
import SaleDailyReportHistories from "./components/admin/saleDailyreportHistory/index.vue"
import moment from 'moment-timezone'


Vue.use(VueAxios, axios);
Vue.use(VeeValidate, {
    locale: "ja"
});

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).tz('Asia/Tokyo').format('YYYY年MM月DD日')
    }
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
