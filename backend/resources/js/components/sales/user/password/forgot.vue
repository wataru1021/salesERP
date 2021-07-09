<template>
  <div class="container forgot-password">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card-group">
          <div class="card p-4">
            <div>
              <form
                method="POST"
                ref="loginForm"
                :action="formUrl"
                @submit.prevent="sendMail"
                autocomplete="off"
              >
                <input type="hidden" :value="csrfToken" name="_token" />
                <h1>パスワードリセット</h1>
                <p class="text-muted">パスワードをリセットリンクを発行します</p>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <svg class="c-icon">
                        <use
                          xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user"
                        ></use>
                      </svg>
                    </span>
                  </div>
                  <input
                    type="text"
                    class="form-control"
                    name="email_address"
                    placeholder="メールアドレス"
                    v-validate="'required|email|max:255'"
                    v-model="email_address"
                    @input="changeInput()"
                  />
                  <div class="input-group is-danger" role="alert">
                    {{ errors.first("email_address") }}
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 text-center is-danger" v-if="messageText">
                    {{ messageText }}
                  </div>
                  <div class="col-xs-12 col-sm-6 w45">
                    <button class="btn btn-primary px-4 mt-2">送信</button>
                  </div>

                  <div class="col-sm-6 col-sx-12 w55 text-right">
                    <a v-bind:href="formLogin" class="btn btn-link px-0 mt-4"
                      >ログインはこちら</a
                    >
                    <a href="" class="btn btn-link px-0">新規登録はこちら</a>
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
export default {
  created: function () {
    let messError = {
      custom: {
        email_address: {
          required: "メールアドレスを入力してください",
          max: "メールアドレスは255文字以内で入力してください。",
          email: "メールアドレス形式は正しくありません。",
        },
      },
    };
    this.$validator.localize("en", messError);
  },
  data() {
    return {
      csrfToken: Laravel.csrfToken,
      messageText: this.message,
      email_address: '',
    };
  },
  props: ["formUrl", "message", "formLogin"],
  mounted() {},
  methods: {
    sendMail: function (e) {
      e.preventDefault();
      let that = this;
      this.$validator.validateAll().then((valid) => {
        if (valid) {
          that.$refs.loginForm.submit();
        }
      });
    },
    changeInput() {
      this.messageText = "";
    },
  },
};
</script>