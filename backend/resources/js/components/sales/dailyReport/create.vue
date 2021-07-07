<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="form-group row mb-0">
              <div class="col-md-9">
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
                <label class="col-md-3 col-form-label" for="ping_pong_num"
                  >ピンポン数（訪問件数）</label
                >
                <div class="col-md-9">
                  <input
                    class="form-control"
                    id="ping_pong_num"
                    name="ping_pong_num"
                    type="number"
                    placeholder="333"
                    v-validate="'required|numeric'"
                    v-model="data.ping_pong_num"
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
                    type="number"
                    placeholder="80"
                    v-validate="'required|numeric'"
                    v-model="data.meet_num"
                    @input="changeInput()"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("meet_num") }}
                  </div>
                </div>
              </div>
              <div class="form-group row mb-2">
                <label class="col-md-3 col-form-label" for="deal_num"
                  >商談数</label
                >
                <div class="col-md-9">
                  <input
                    class="form-control"
                    id="deal_num"
                    name="deal_num"
                    type="number"
                    placeholder="30"
                    v-validate="'required|numeric'"
                    v-model="data.deal_num"
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
                    type="number"
                    placeholder="20"
                    v-validate="'required|numeric'"
                    v-model="data.acquisitions_num"
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
                    v-validate="'required'"
                    v-model="data.sale_time"
                    step="0.5"
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
                    v-model="data.conscious_point"
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
                <div class="col-md-9">
                  <button class="btn btn-success w-100">報告</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group row">
          <div class="col-md-9 text-center">
            <a href="">営業管理に戻る</a>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-9 text-center">
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
          required: "商談数を入力してください",
          numeric: "数字で入力してください。",
        },
        acquisitions_num: {
          required: "獲得数を入力してください",
          numeric: "数字で入力してください。",
        },
        sale_time: {
          required: "稼働時間を入力してください",
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
      data: this.data,
    };
  },
  props: ["formUrl", "message", "topUrl", "date", "th", "data"],
  mounted() {
    console.log(this.data);
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
  },
};
</script>