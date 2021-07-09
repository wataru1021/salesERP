import Vue from "vue";
import VeeValidate from "vee-validate";
import VueAxios from 'vue-axios';
import axios from 'axios';
import AdminLogin from "./components/admin/user/login.vue"
import AdminUserList from "./components/admin/user/list.vue"
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

const store = new Vuex.Store({
    state: {
        ctype: '',
        count: 0
    },
    getters: {
        getCType : state => {
            return state.ctype;
        }
    },
    mutations: {
        setCType (contact, ctype) {
            contact.ctype = ctype
        },
        increment (context, count) {
            context.count = count
        }
    },
    actions: {
        setCTypeAction(context, ctype) {
            context.commit('setCType', ctype);
        },
        setIncrementAction(context, ctype) {
            context.commit('increment', ctype);
        }
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
        ReportManagement
    },
    methods: {},
    mounted() {}
});
