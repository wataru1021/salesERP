<template>
  <div class="container daily_report_create">
    <div class="row content">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group row mb-0">
              <div class="col-md-12">
                <h4>{{ date }}({{ th }})の日報</h4>
              </div>
            </div>
            <form
              class="form-horizontal"
              method="POST"
              ref="registerForm"
              :action="formUrl"
              @submit.prevent="register"
              autocomplete="off"
            >
              <input type="hidden" :value="csrfToken" name="_token" />
              <div class="form-group row mb-2">
                <label class="col-md-3 col-form-label text-nowrap" for="ping_pong_num"
                  >ピンポン数（訪問件数）</label
                >
                <div class="col-md-9">
                  <input
                    class="form-control"
                    id="ping_pong_num"
                    name="ping_pong_num"
                    type="text"
                    placeholder="333"
                    v-validate="'required|numeric'"
                    v-model="saleDailyReport.ping_pong_num"
                    @keypress="isNumber($event)"
                    @input="changeInput()"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("ping_pong_num") }}
                  </div>
                </div>
              </div>
              <div class="form-group row mb-2">
                <label class="col-md-3 col-form-label" for="meet_num"
                  >対面数</label
                >
                <div class="col-md-9">
                  <input
                    class="form-control"
                    id="meet_num"
                    name="meet_num"
                    type="text"
                    placeholder="80"
                    v-validate="'required|numeric'"
                    v-model="saleDailyReport.meet_num"
                    @keypress="isNumber($event)"
                    @input="changeInput()"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("meet_num") }}
                  </div>
                </div>
              </div>
              <div class="form-group row mb-2">
                <label class="col-md-3 col-form-label" for="deal_num"
                  >商談率</label
                >
                <div class="col-md-9">
                  <input
                    class="form-control"
                    id="deal_num"
                    name="deal_num"
                    type="text"
                    placeholder="30"
                    v-validate="'required|numeric'"
                    v-model="saleDailyReport.deal_num"
                    @keypress="isNumber($event)"
                    @input="changeInput()"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("deal_num") }}
                  </div>
                </div>
              </div>
              <div class="form-group row mb-2">
                <label class="col-md-3 col-form-label" for="acquisitions_num"
                  >獲得数</label
                >
                <div class="col-md-9">
                  <input
                    class="form-control"
                    id="acquisitions_num"
                    name="acquisitions_num"
                    type="text"
                    placeholder="20"
                    v-validate="'required|numeric'"
                    v-model="saleDailyReport.acquisitions_num"
                    @keypress="isNumber($event)"
                    @input="changeInput()"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("acquisitions_num") }}
                  </div>
                </div>
              </div>
              <div class="form-group row mb-2">
                <label class="col-md-3 col-form-label" for="sale_time"
                  >稼働時間（時間）※休憩時間は含まない</label
                >
                <div class="col-md-9">
                  <input
                    class="form-control"
                    id="sale_time"
                    name="sale_time"
                    type="number"
                    placeholder="10.5"
                    v-validate="'decimal:1|required'"
                    step="0.5"
                    v-model="saleDailyReport.sale_time"
                    @input="changeInput()"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("sale_time") }}
                  </div>
                </div>
              </div>

              <div class="form-group row mb-2">
                <label class="col-md-3 col-form-label" for="conscious_point"
                  >今日意識した点</label
                >
                <div class="col-md-9">
                  <textarea
                    class="form-control"
                    id="conscious_point"
                    name="conscious_point"
                    rows="4"
                    placeholder="商談から獲得に確実に繋がるよう、商談場所を意識した。"
                    v-model="saleDailyReport.conscious_point"
                    v-validate="'required'"
                  ></textarea>
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("conscious_point") }}
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label
                  class="col-md-3 col-form-label"
                  for="textarea-input"
                ></label>
                <div class="col-md-9 text-center is-danger" v-if="messageText">
                  {{ messageText }}
                </div>
                <div class="col-md-12 text-center">
                  <button class="btn btn-success w-100">報告</button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-12 text-center">
            <a v-bind:href="saleManagementUrl">営業管理に戻る</a>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-12 text-center">
            <a v-bind:href="topUrl">TOPに戻る</a>
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
  </div>
</template>
<style scoped>
h4 {
  font-size: 24px;
  color: #000000;
}
label {
  color: #768192;
  font-size: 14px;
}
</style>
<script>
export default {
  created: function () {
    let messError = {
      custom: {
        ping_pong_num: {
          required: "ピンポン数を入力してください",
          numeric: "数字で入力してください。",
        },
        meet_num: {
          required: "対面数を入力してください",
          numeric: "数字で入力してください。",
        },
        deal_num: {
          required: "商談率を入力してください",
          numeric: "数字で入力してください。",
        },
        acquisitions_num: {
          required: "獲得数を入力してください",
          numeric: "数字で入力してください。",
        },
        sale_time: {
          required: "稼働時間を入力してください",
          decimal:"数字で入力してください。"
        },
        conscious_point: {
          required: "今日意識した点を入力してください",
        },
      },
    };
    this.$validator.localize("en", messError);
  },
  data() {
    return {
      csrfToken: Laravel.csrfToken,
      messageText: this.message,
      saleDailyReport: {},
    };
  },
  props: ["formUrl", "message", "topUrl", "date", "th", "data", "saleManagementUrl"],
  mounted() {
    this.saleDailyReport = this.data || {}
  },
  methods: {
    register: function (e) {
      e.preventDefault();
      let that = this;
      this.$validator.validateAll().then((valid) => {
        if (valid) {
          that.$refs.registerForm.submit();
        }
      });
    },
    changeInput() {
      this.messageText = "";
    },
    isNumber: function(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();;
      } else {
        return true;
      }
    }
  },
};
</script>