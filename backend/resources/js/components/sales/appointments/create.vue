<template>
  <div class="container daily_report_create">
    <div class="row content">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form
              class="form-horizontal"
              method="POST"
              ref="registerForm"
              @submit.prevent="register"
              autocomplete="off"
            >
              <input type="hidden" :value="csrfToken" name="_token" />
              <div class="form-group row mb-2">
                <label
                  class="col-md-3 col-form-label text-nowrap"
                  for="appointee_name"
                  >話した人の名前</label
                >
                <div class="col-md-9">
                  <input
                    class="form-control"
                    id="appointee_name"
                    name="appointee_name"
                    type="text"
                    v-validate="'required|max:255'"
                    v-model="appointee_name"
                    @input="changeInput()"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("appointee_name") }}
                  </div>
                </div>
              </div>
              <div class="form-group row mb-2">
                <label class="col-md-3 col-form-label" for="appointment_address"
                  >話した人の立場</label
                >
                <div class="col-md-9">
                  <input
                    class="form-control"
                    id="appointment_address"
                    name="appointment_address"
                    type="text"
                    v-validate="'required|max:255'"
                    v-model="appointment_address"
                    @input="changeInput()"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("appointment_address") }}
                  </div>
                </div>
              </div>
              <div class="form-group row mb-2">
                <label class="col-md-3 col-form-label" for="appointment_date"
                  >アポの日</label
                >
                <div class="col-md-9">
                  <date-picker
                    v-model="appointment_date"
                    type="date"
                    :input-attr="{
                      name: 'appointment_date',
                      id: 'appointment_date',
                    }"
                    input-class="form-control"
                    :format="'YYYY年MM月DD日'"
                  ></date-picker>
                  <input
                    v-model="appointment_date"
                    name="appointment_date"
                    v-show="false"
                    v-validate="'required'"
                    @input="changeInput()"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("appointment_date") }}
                  </div>
                </div>
              </div>
              <div class="form-group row mb-2">
                <label class="col-md-3 col-form-label" for="appointment_time"
                  >時間帯</label
                >
                <div class="col-md-9">
                  <div class="time-picker-image">
                    <date-picker
                      v-model="appointment_time"
                      :input-attr="{
                        name: 'appointment_time',
                        id: 'appointment_time',
                      }"
                      :format="'HH:mm'"
                      type="time"
                      input-class="form-control"
                    ></date-picker>
                    <input
                      v-model="appointment_time"
                      name="appointment_time"
                      v-show="false"
                      v-validate="'required'"
                      @input="changeInput()"
                    />
                  </div>
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("appointment_time") }}
                  </div>
                </div>
              </div>
              <div class="form-group row mb-2">
                <label class="col-md-3 col-form-label" for="appointment_memo"
                  >メモ</label
                >
                <div class="col-md-9">
                  <textarea
                    class="form-control"
                    id="appointment_memo"
                    name="appointment_memo"
                    v-validate="'required'"
                    v-model="appointment_memo"
                    @input="changeInput()"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("appointment_memo") }}
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label
                  class="col-md-3 col-form-label"
                  for="textarea-input"
                ></label>
                <div class="col-md-12 text-center">
                  <button class="btn btn-success w-100">報告</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-12 text-center">
            <a v-bind:href="appointmentsIndexUrl"
              ><span class="custom-color">アポイント管理</span></a
            >
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
      <!-- /.col-->
    </div>
    <loader :flag-show="flagShowLoader"></loader>
  </div>
</template>

<script>
import axios from "axios";
import Loader from "./../../common/loader";
export default {
  created: function () {
    let messError = {
      custom: {
        appointee_name: {
          required: "話した人の名前入力してください。",
          max: "話した人の名前は255文字以内で入力してください。",
        },
        appointment_address: {
          required: "話した人の立場入力してください。",
          max: "話した人の立場は255文字以内で入力してください。",
        },
        appointment_date: {
          required: "アポの日入力してください。",
        },
        appointment_time: {
          required: "時間帯入力してください。",
        },
        appointment_memo: {
          required: "メモ入力してください。",
        },
      },
    };
    this.$validator.localize("en", messError);
  },
  components: {
    Loader,
  },
  data() {
    return {
      csrfToken: Laravel.csrfToken,
      flagShowLoader: false,
      appointee_name: "",
      appointment_address: "",
      appointment_date: "",
      appointment_time: "",
      appointment_memo: "",
    };
  },
  props: ["appointmentsIndexUrl", "topUrl"],
  methods: {
    register() {
      let that = this;
      this.$validator.validateAll().then((valid) => {
        if (valid) {
          let formData = new FormData();
          formData.append("appointee_name", this.appointee_name);
          formData.append("appointment_address", this.appointment_address);
          formData.append("appointment_date", this.appointment_date.getFullYear() + "-" + this.appointment_date.getMonth() + "-" + this.appointment_date.getDate());
          formData.append("appointment_time", this.appointment_time.getHours() + ":" + this.appointment_time.getMinutes() + ":" + this.appointment_time.getMilliseconds());
          formData.append("appointment_memo", this.appointment_memo);
          that.flagShowLoader = true;
          this.$swal({
            title: "この情報を保存したい",
            confirmButtonText: "OK",
            showCancelButton: true,
          }).then((result) => {
            if (result.isConfirmed) {
              axios
                .post(`/appointments`, formData, {
                  header: {
                    "Content-Type": "multipart/form-data",
                  },
                })
                .then((res) => {
                  this.$swal({
                    title: "予定が追加されました。",
                    icon: "success",
                    confirmButtonText: "OK",
                  }).then(function (confirm) {
                    that.flagShowLoader = false;
                    window.location.href = "/appointments";
                  });
                })
                .catch((err) => {
                  that.flagShowLoader = false;
                  this.$swal({
                    title: "失敗したデータを追加しました。",
                    icon: "error",
                    confirmButtonText: "Cool",
                  }).then(function (confirm) {});
                });
            }
          });
        }
      });
    },
    changeInput() {},
  },
};
</script>