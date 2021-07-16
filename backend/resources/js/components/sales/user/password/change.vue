<template>
  <div class="container change-password">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card-group">
          <div class="card p-4">
            <div v-if="messageText">
              <h2>エラー</h2>
              <p class="text-muted">{{ messageText }}</p>
              <div class="col-md-9 col-lg-12 text-center">
                <img src="/image/changePasswordError.png" class="w-10" />
              </div>
              <div class="col-md-9 col-lg-12 text-center mt-4">
                <a v-bind:href="formLogin" class="btn btn-link px-0 mt-3"
                  >ログインページに戻る</a
                >
                <br />
                <a v-bind:href="formForgot" class="btn btn-link px-0"
                  >パスワードを忘れたページに戻る</a
                >
              </div>
            </div>

            <div v-else>
              <form
                method="POST"
                ref="changePasswordForm"
                :action="formUrl"
                @submit.prevent="changePassword"
                autocomplete="off"
              >
                <input type="hidden" :value="csrfToken" name="_token" />
                <input
                  type="hidden"
                  :value="token"
                  name="reset_password_token"
                />
                <h2>パスワードリマインダー</h2>
                <p class="text-muted">パスワードをリセットリンクを発行します</p>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <svg class="c-icon">
                        <use
                          xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"
                        ></use>
                      </svg>
                    </span>
                  </div>
                  <input
                    type="password"
                    class="form-control"
                    name="password"
                    placeholder="新しいパスワード"
                    v-validate="'required|min:8|max:15'"
                    v-model="password"
                    ref="password"
                    autocomplete="new-password"
                    @input="changeInput()"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("password") }}
                  </div>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <svg class="c-icon">
                        <use
                          xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"
                        ></use>
                      </svg>
                    </span>
                  </div>
                  <input
                    type="password"
                    class="form-control"
                    name="password_confirm"
                    placeholder="確認用新しいパスワード"
                    v-validate="'required|confirmed:password'"
                    v-model="password_confirm"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("password_confirm") }}
                  </div>
                </div>

                <div class="row">
                  <div class="col-12 text-center is-danger" v-if="messageText2">
                    {{ messageText2 }}
                  </div>
                  <div class="col-xs-12 col-sm-6 w45">
                    <button class="btn btn-primary mt-2">リセット</button>
                  </div>

                  <div class="col-sm-6 col-xs-12 w55 text-right">
                    <a v-bind:href="formLogin" class="btn btn-link px-0 mt-4"
                      >ログインはこちら</a
                    >

                    <a v-bind:href="formForgot" class="btn btn-link px-0"
                      >新規登録はこちら</a
                    >
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Reset",
  created: function () {
    let messError = {
      custom: {
        password: {
          required: "パスワードを入力してください。",
          min: "8文字以上のパスワードを入力してください。",
          max: "15文字以内のパスワードを入力してください。",
        },
        password_confirm: {
          required: "パスワードを入力してください。",
          confirmed: "パスワード が入力されたものと異なります。",
        },
      },
    };
    this.$validator.localize("en", messError);
  },
  data() {
    return {
      csrfToken: Laravel.csrfToken,
      messageText: this.message,
      messageText2: this.message2,
      password: "",
      password_confirm: "",
      token: this.tokenUrl,
    };
  },
  props: [
    "formUrl",
    "tokenUrl",
    "message",
    "message2",
    "formLogin",
    "formForgot",
  ],
  mounted() {},
  methods: {
    changePassword(e) {
      e.preventDefault();

      let that = this;
      this.$validator.validateAll().then((valid) => {
        if (valid) {
          that.$refs.changePasswordForm.submit();
        }
      });
    },
    changeInput() {
      this.messageText = "";
    },
  },
};
</script>