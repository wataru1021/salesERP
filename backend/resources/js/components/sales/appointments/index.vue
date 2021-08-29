<template>
  <div class="container daily_report_complete">
    <div class="animated fadeIn">  
      <div class="card">
        <div class="card-body pt-2">
          <a :href="addAppointmentUrl" class="btn btn-primary mb-3 text-white">予定を追加する</a>
          <div class="col card-item p-0" v-for="item in data" :key="item.id">
            <div class="card">
              <div class="card-body border-primary">
                <table>
                  <tr>
                    <td>&#8226;&nbsp;&nbsp;話した人の名前</td>
                    <td>&nbsp;:&nbsp;{{ item.appointee_name }}</td>
                  </tr>
                  <tr>
                    <td>&#8226;&nbsp;&nbsp;話した人の立場</td>
                    <td>&nbsp;:&nbsp;{{ item.appointment_address }}</td>
                  </tr>
                  <tr>
                    <td>&#8226;&nbsp;&nbsp;アポの日</td>
                    <td>&nbsp;:&nbsp;{{ item.appointment_date }}</td>
                  </tr>
                  <tr>
                    <td>&#8226;&nbsp;&nbsp;時間帯</td>
                    <td>&nbsp;:&nbsp;{{ formatTime(item.appointment_time) }}</td>
                  </tr>
                  <tr>
                    <td>&#8226;&nbsp;&nbsp;メモ</td>
                    <td>&nbsp;:&nbsp;{{ item.appointment_memo }}</td>
                  </tr>
                </table>
                <button class="btn btn-primary float-right" @click="deleteAppointment(item.id)">保存</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Loader from "./../../common/loader";

export default {
  created: function () {},
  data() {
    return {
      csrfToken: Laravel.csrfToken,
      saleDailyReport: {},
    };
  },
  components: {
      Loader,
  },
  props: ["data", "addAppointmentUrl"],
  mounted() {
    this.saleDailyReport = this.data;
  },
  methods: {
    formatTime(value) {
      return parseInt(value.split(':')[0]) + ':' + parseInt(value.split(':')[1]);
    },  
    deleteAppointment(id){
      this.$swal({
        title: "この情報をキャンセルしたい",
        confirmButtonText: "OK",
        showCancelButton: true,
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`appointments/${id}`)
            .then((res) => {
              this.$swal({
                    title: "情報が削除されました",
                    icon: "success",
                    confirmButtonText: "OK",
                }).then(function (confirm) {
                  window.location.href = '/appointments'
                });
            })
            .catch((err) => {
              this.$swal({
                    title: "失敗した情報の削除",
                    icon: "error",
                    confirmButtonText: "Cool",
                }).then(function (confirm) {});
            });
        }
      });
    },
  },
};
</script>
