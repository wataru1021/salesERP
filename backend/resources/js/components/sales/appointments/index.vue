<template>
  <div class="container daily_report_complete">
    <div class="animated fadeIn">  
      <div class="card">
        <div class="card-body pt-2 pb-2">
          <div class="col card-item p-0" v-for="(item, index) in data" :key="item.id">
            <div class="card" v-bind:class="{ 'mt-3': index == 0 }">
              <div class="card-body border-primary">
                <div class="row">
                  <div class="width-115">&#8226;&nbsp;&nbsp;話した人の名前</div>
                  <div class="width-td mb-1 pl-2 position-relative">{{ item.appointee_name }}</div>
                </div>
                <div class="row">
                  <div class="width-115">&#8226;&nbsp;&nbsp;話した人の立場</div>
                  <div class="width-td mb-1 pl-2 position-relative">{{ item.appointment_address }}</div>
                </div>
                <div class="row">
                  <div class="width-115">&#8226;&nbsp;&nbsp;アポの日</div>
                  <div class="width-td mb-1 pl-2 position-relative">{{ item.appointment_date }}</div>
                </div>
                <div class="row">
                  <div class="width-115">&#8226;&nbsp;&nbsp;時間帯</div>
                  <div class="width-td mb-1 pl-2 position-relative">{{ formatTime(item.appointment_time) }}</div>
                </div>
                <div class="row">
                  <div class="width-115">&#8226;&nbsp;&nbsp;メモ</div>
                  <div class="width-td mb-1 pl-2 position-relative">{{ item.appointment_memo }}</div>
                </div>
                <button class="btn btn-primary float-right" @click="deleteAppointment(item.id)">削除</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-12 text-center">
          <a v-bind:href="topUrl"
            ><span class="custom-color">TOPに戻る</span></a
          >
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
  props: ["data", "topUrl"],
  mounted() {
    this.saleDailyReport = this.data;
  },
  methods: {
    formatTime(value) {
      return value.split(':')[0] + ':' + value.split(':')[1];
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
