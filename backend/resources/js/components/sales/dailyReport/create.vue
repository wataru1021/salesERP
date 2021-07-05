<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header border-bottom-0"><h3>2021年12月30日(土)の日報</h3></div>
          <div class="card-body">
            <form
              class="form-horizontal"
              method="POST"
              ref="registerForm"
              :action="formUrl"
              @submit.prevent="register"
              autocomplete="off"
            >
              <input type="hidden" :value="csrfToken" name="_token" />
              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="ping_pong_num"
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
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("ping_pong_num") }}
                  </div>
                </div>
              </div>
              <div class="form-group row">
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
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("meet_num") }}
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="deal_num"
                  >商談数</label
                >
                <div class="col-md-9">
                  <input
                    class="form-control"
                    id="deal_num"
                    name="deal_num"
                    type="text"
                    placeholder="30"
                    v-validate="'required|numeric'"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("deal_num") }}
                  </div>
                </div>
              </div>
              <div class="form-group row">
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
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("acquisitions_num") }}
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label" for="sale_time"
                  >稼働時間（時間）※休憩時間は含まない</label
                >
                <div class="col-md-9">
                  <input
                    class="form-control"
                    id="sale_time"
                    name="sale_time"
                    type="text"
                    placeholder="10.5"
                    v-validate="'required'"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("sale_time") }}
                  </div>
                </div>
              </div>

              <div class="form-group row">
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
          <label class="col-md-3 col-form-label" for="input5"></label>
          <div class="col-md-9 text-center">
            <a href="">営業管理に戻る</a>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-3 col-form-label" for="input5"></label>
          <div class="col-md-9 text-center">
            <a v-bind:href="topUrl">TOPに戻る</a>
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
  </div>
</template>

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
      //   loginIdValue: this.loginId,
      messageText: this.message,
    };
  },
  props: ["formUrl", "message", "topUrl"],
  mounted() {},
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
    // changeInput() {
    //   this.messageText = "";
    // },
  },
};
</script>