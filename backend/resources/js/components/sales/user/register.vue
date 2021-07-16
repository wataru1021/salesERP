<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-group">
                <div class="card p-4">
                    <div class="card-body">
                        <form method="POST" ref="loginForm" :action="formUrl" @submit.prevent="login" autocomplete="off">
                            <input type="hidden" :value="csrfToken" name="_token" />
                            <h1>新規登録</h1>
                            <p class="text-muted">
                                新しいアカウントを作成します
                            </p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="name" v-model="name" placeholder="お名前" v-validate="'required'" @input="changeInput()" />
                                <div class="input-group is-danger" role="alert">
                                    {{ errors.first("name") }}
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-envelope-open"></use>
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="email" v-model="email" placeholder="メールアドレス" v-validate="'required|email'" @input="changeInput()" />
                                <div class="input-group is-danger" role="alert">
                                    {{ errors.first("email") }}
                                </div>
                                <div class="input-group is-danger" v-if="messageErrorEmail" role="alert">
                                    {{ messageErrorEmail }}
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
                                        </svg>
                                    </span>
                                </div>
                                <input type="password" class="form-control" name="password" v-model="password" placeholder="パスワード" v-validate="'required|min:8|max:15'" ref="password" @input="changeInput()" />
                                <div class="input-group is-danger" role="alert">
                                    {{ errors.first("password") }}
                                </div>
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
                                        </svg>
                                    </span>
                                </div>
                                <input type="password" class="form-control" name="repassword" v-model="repassword" placeholder="確認用パスワード" v-validate="'required|confirmed:password'" data-vv-as="password" @input="changeInput()" />
                                <div class="input-group is-danger" role="alert">
                                    {{ errors.first("repassword") }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-center is-danger" v-if="messageText">
                                    {{ messageText }}
                                </div>
                                <div class="col-xs-12 col-sm-12 text-center mb-3">
                                    <button type="submit" class="btn btn-success mt-3 sales-register-btn">
                                        新規登録
                                    </button>
                                </div>

                                <div class="col-sm-12 col-sx-12 text-center">
                                    <a v-bind:href="loginUrl" class="btn btn-link sales-register-link">すでにアカウントをお持ちの方はこちら</a>
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
                name: {
                    required: "お名前を入力してください"
                },
                email: {
                    required: "メールアドレスを入力してください",
                    email: "メールアドレス形式は正しくありません。"
                },
                password: {
                    required: "パスワードを入力してください",
                    min: "8文字以上のパスワードを入力してください。",
                    max: "15文字以内のパスワードを入力してください。",
                },
                repassword: {
                    required: "確認用パスワード",
                    confirmed: "パスワードの確認が一致しません"
                }
            }
        };
        this.$validator.localize("en", messError);
    },
    data() {
        return {
            csrfToken: Laravel.csrfToken,
            messageText: this.message,
            messageErrorEmail: this.messageEmail,
            name: this.nameUser,
            email: this.emailUser,
            password: this.passwordUser,
            repassword: this.passwordUser
        };
    },
    props: ["formUrl", "loginUrl", "message", "messageEmail", "nameUser", "emailUser", "passwordUser"],
    mounted() {},
    methods: {
        login: function (e) {
            e.preventDefault();

            let that = this;
            this.$validator.validateAll().then(valid => {
                if (valid) {
                    that.$refs.loginForm.submit();
                }
            });
        },
        changeInput() {
            this.messageText = "";
            this.messageErrorEmail = ""
        }

    }
};
</script>
