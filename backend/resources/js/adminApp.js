import Vue from "vue";
import VeeValidate from "vee-validate";
import VueAxios from 'vue-axios';
import axios from 'axios';
import AdminLogin from "./components/admin/user/login.vue"
import AdminUserList from "./components/admin/user/list.vue"
import AdminForgotPassword from "./components/admin/user/password/forgot.vue"
import AdminChangePassword from "./components/admin/user/password/change.vue"
import AdminSuccessPassword from "./components/admin/user/password/success.vue"
import AdminErrorPassword from "./components/admin/user/password/error.vue"
import AdminSuccessEmail from "./components/admin/user/password/successemail.vue"
import AdminErrorEmail from "./components/admin/user/password/erroremail.vue"
import AdminSalesChartIndex from "./components/admin/saleschart/index"
import DataTable from 'laravel-vue-datatable';
import VueSweetalert2 from 'vue-sweetalert2';
import { CChartBar } from '@coreui/vue-chartjs'
import DatePicker from 'vue2-datepicker'
import 'sweetalert2/dist/sweetalert2.min.css';
import 'vue2-datepicker/index.css';

Vue.use(VueSweetalert2);
Vue.use(DatePicker);
Vue.use(VueAxios, axios);
Vue.use(VeeValidate, {
    locale: "ja"
});
Vue.component('CChartBar', CChartBar)

Vue.use(DataTable);

new Vue({
    created() {},
    el: "#app",
    components: {

        AdminLogin,
        AdminUserList,
        AdminForgotPassword,
        AdminChangePassword,
        AdminSuccessPassword,
        AdminErrorPassword,
        AdminSuccessEmail,
        AdminErrorEmail,
        AdminSalesChartIndex
    },
    methods: {},
    mounted() {}
});