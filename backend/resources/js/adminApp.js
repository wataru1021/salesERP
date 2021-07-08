import Vue from "vue";
import VeeValidate from "vee-validate";
import VueAxios from 'vue-axios';
import axios from 'axios';
import AdminLogin from "./components/admin/user/login.vue"
import AdminUserList from "./components/admin/user/list.vue"
import AdminForgotPassword from "./components/admin/user/password/forgot.vue"
import AdminChangePassword from "./components/admin/user/password/change.vue"
import AdminSuccessPassword from "./components/admin/user/password/success.vue"
import AdminSuccessEmail from "./components/admin/user/password/successemail.vue"
import DataTable from 'laravel-vue-datatable';
import VueSweetalert2 from 'vue-sweetalert2';

import 'sweetalert2/dist/sweetalert2.min.css';

Vue.use(VueSweetalert2);
Vue.use(VueAxios, axios);
Vue.use(VeeValidate, {
    locale: "ja"
});

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
        AdminSuccessEmail
    },
    methods: {},
    mounted() {}
});