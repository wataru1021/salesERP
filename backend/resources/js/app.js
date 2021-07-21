import Vue from "vue";
import VeeValidate from "vee-validate";
import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.use(VueAxios, axios);
Vue.use(VeeValidate, {
  locale: "ja"
});

new Vue({
    created() {
    },
    el: "#app",
    components: {
       
    },
    methods: {},
    mounted() {}
});
