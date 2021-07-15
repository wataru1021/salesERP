<template>
  <div class="container login-password">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card-group">
          <div class="card p-4">
            <form
              method="POST"
              ref="loginForm"
              :action="formUrl"
              @submit.prevent="login"
              autocomplete="off"
            >
              <input type="hidden" :value="csrfToken" name="_token" />
              <h1>ログイン</h1>
              <p class="text-muted">アカウントを入力してください。</p>
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
                  name="email"
                  placeholder="メールアドレス"
                  v-validate="'required'"
                  v-model="loginIdValue"
                  @input="changeInput()"
                />
                <div class="input-group is-danger" role="alert">
                  {{ errors.first("email") }}
                </div>
              </div>
              <div class="input-group">
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
                  class="form-control"
                  name="password"
                  :type="fieldTypes.password"
                  @focus="handleType"
                  @blur="handleType"
                  value=""
                  autocomplete="new-password"
                  placeholder="パスワード"
                  v-validate="'required'"
                  @input="changeInput()"
                />
                <div class="input-group is-danger" role="alert">
                  {{ errors.first("password") }}
                </div>
              </div>
              <div class="row">
                <div class="col-12 text-center is-danger" v-if="messageText">
                  {{ messageText }}
                </div>
                <div class="col-xs-6 col-sm-4 w45">
                  <button class="btn btn-primary px-5 mt-3">ログイン</button>
                </div>

                <div class="col-xs-6 col-sm-8 text-right">
                  <a
                    v-bind:href="forgotPasswordUrl"
                    class="btn btn-link px-0 mt-3"
                    >パスワードを忘れた方へ</a
                  >
                </div>
              </div>
            </form>
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
        email: {
          required: "メールアドレスを入力してください",
        },
        password: {
          required: "パスワードを入力してください",
        },
      },
    };
    this.$validator.localize("en", messError);
  },
  data() {
    return {
      csrfToken: Laravel.csrfToken,
      loginIdValue: this.loginId,
      messageText: this.message,
      fieldTypes: {
        password: "text",
      },
    };
  },
  props: ["formUrl", "forgotPasswordUrl", "message", "loginId"],
  mounted() {},
  methods: {
    login: function (e) {
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
    handleType(event) {
      const { srcElement, type } = event;
      const { name, value } = srcElement;

      if (type === "blur" && !value) {
        this.fieldTypes[name] = "text";
      } else {
        this.fieldTypes[name] = "password";
      }
    },
  },
};
</script>