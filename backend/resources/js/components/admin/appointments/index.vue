<template>
  <div class="container-fluid sale-daily-report-histories">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-1 sale-name-list">
            <div class="card-body">
              <div>
                <button
                  @click="changeUserId(user.id, user.name)"
                  v-for="(user, index) in users"
                  :key="index"
                  class="btn  ml-1 mt-1 btn-custom"
                  v-bind:class="{ 'btn-custom-active': userId == user.id }"
                >
                  {{ user.name }}
                </button>
              </div>
              <h2 class="mt-4 pl-3">{{userName}}</h2>
            </div>
          </div>
           <div class="card">
            <div class="card-body pt-2">
            <div v-if="appointments.length == 0" class="text-center">データなし</div>
            <div class="col card-item p-0" v-else v-for="item in appointments" :key="item.id">
                <div class="card" v-bind:class="{ 'disabled': item.deleted_at != null }">
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
                    <button class="btn btn-primary float-right" v-if="item.deleted_at == null" @click="deleteAppointment(item.id)">保存</button>
                    <button class="btn btn-primary float-right" v-else disabled>キャンセル</button>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
      </div>
    </div>
    <loader :flag-show="flagShowLoader"></loader>
  </div>
</template>
<style scoped>
.is-active {
  color: #fff;
  background-color: #321fdb;
  border-color: #321fdb;
}
</style>>
  
<script>
import axios from "axios";
import Loader from "./../../common/loader";


export default {
  components: { Loader },
  data() {
    return {
      users: [],
      userId: null,
      userName:null,
      flagShowLoader: false,
      data: [],
      appointments: []
    };
  },
  props: ["userResponse"],
  mounted() {
    var userIdSRHStorage = JSON.parse(localStorage.getItem('userIdSRHStorage'));
    userIdSRHStorage = userIdSRHStorage == null ? this.userResponse[0].id : userIdSRHStorage;
    this.userId = userIdSRHStorage;
    this.userName = this.userResponse[0].name;
    localStorage.removeItem('userIdSRHStorage');
    this.getData();
    (this.users = this.userResponse);
  },
  methods: {
    getData() {
      let that = this;
      if( this.userId == null){
        this.userId = this.userResponse[0].id;
      }
      this.flagShowLoader = true;
      axios
        .get(`/admin/getDataAppointments`, {
          _token: Laravel.csrfToken,
        })
        .then(function (response) {
          that.data = response.data;
          for(let i = 0; i< response.data.length; i++) {
            if(that.userId == response.data[i].user_id) {
              that.appointments.push(response.data[i])  
            }
          }
          that.flagShowLoader = false
        })
        .catch((error) => {});
    },
    changeUserId(id, name) {
      this.userId = id;
      this.userName = name;
      this.appointments = []

      for(let i = 0; i< this.data.length; i++) {
            if(this.data[i].user_id === id) {
              this.appointments.push(this.data[i])
            }
      }
    },
    formatTime(value) {
      return parseInt(value.split(':')[0]) + ':' + parseInt(value.split(':')[1]);
    }, 
    deleteAppointment(id){
        let that = this;
      this.$swal({
        title: "この情報をキャンセルしたい",
        confirmButtonText: "OK",
        showCancelButton: true,
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`/admin/appointments/${id}`)
            .then((res) => {
              this.$swal({
                    title: "情報が削除されました",
                    icon: "success",
                    confirmButtonText: "OK",
                }).then(function (confirm) {
                    that.appointments.forEach((value, index) => {
                        if ( value.id == id) {
                            value.deleted_at = new Date();
                        }
                    });
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
