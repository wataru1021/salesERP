import Vue from "vue";
import VeeValidate from "vee-validate";
import VueAxios from 'vue-axios';
import axios from 'axios';
import AdminLogin from "./components/admin/user/login.vue"
import SaleDailyReportHistories from "./components/admin/saleDailyreportHistory/index.vue"
import moment from 'moment-timezone'

import AdminUserList from "./components/admin/user/list.vue"
import AdminForgotPassword from "./components/admin/user/password/forgot.vue"
import AdminChangePassword from "./components/admin/user/password/change.vue"
import AdminSuccessPassword from "./components/admin/user/password/success.vue"
import AdminSuccessEmail from "./components/admin/user/password/successemail.vue"
import AdminSalesChartIndex from "./components/admin/saleschart/index"
import DataTable from 'laravel-vue-datatable';
import VueSweetalert2 from 'vue-sweetalert2';
import { CChartBar } from '@coreui/vue-chartjs'
import DatePicker from 'vue2-datepicker'
import ReportManagement from './components/admin/reportManagement/reportmanagement'
import 'sweetalert2/dist/sweetalert2.min.css';
import 'vue2-datepicker/index.css';
import Vuex from 'vuex';

Vue.use(Vuex);
Vue.use(VueSweetalert2);
Vue.use(DatePicker);
Vue.use(VueAxios, axios);
Vue.use(VeeValidate, {
    locale: "ja"
});
Vue.component('CChartBar', CChartBar);

Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).tz('Asia/Tokyo').format('YYYY年MM月DD日')
    }
});
const store = new Vuex.Store({
    state: {
        ctype: '',
    },
    getters: {
        getCType : state => {
            return state.ctype;
        }
    },
    mutations: {
        setCType (state, ctype) {
            state.ctype = ctype;
            localStorage.setItem('ctypeStorage', JSON.stringify(ctype))
        },
    },
    actions: {
    },
});
Vue.use(DataTable);
new Vue({
    created() {},
    el: "#app",
    store,
    components: {
        AdminLogin,
        AdminUserList,
        AdminSalesChartIndex,
        SaleDailyReportHistories,
        AdminForgotPassword,
        AdminChangePassword,
        AdminSuccessPassword,
        AdminSuccessEmail,
        ReportManagement
    },
    methods: {},
    mounted() {}
});
