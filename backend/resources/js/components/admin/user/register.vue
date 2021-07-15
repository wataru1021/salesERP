<template>
<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <form class="form-horizontal" method="POST" ref="registerForm" @submit.prevent="register" autocomplete="off">
                        <div class="card-body">
                            <h1>新規登録</h1>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                                        </svg>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="nameUser" name="nameUser" placeholder="お名前" v-model="nameUser" @input="changeInput()" v-validate="'required'" />
                                <div class="input-group is-danger" role="alert">
                                    {{ errors.first("nameUser") }}
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-envelope-closed"></use>
                                        </svg>
                                    </span>
                                </div>
                                <input class="form-control" id="email" name="email" type="text" v-model="email" placeholder="メールアドレス" @input="changeInput()" v-validate="'required|email_format'" />
                                <div class="input-group is-danger" role="alert">
                                    {{ errors.first("email") }}
                                </div>
                                <div class="input-group is-danger" role="alert" v-if="errorsData.email">{{ errorsData.email }}</div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-lock-locked"></use>
                                        </svg>
                                    </span>
                                </div>
                                <input class="form-control" id="password" name="password" type="password" ref="password" v-model="password" placeholder="パスワード" @input="changeInput()" v-validate="'required|min:8|max:15'" @focus="handleType" @blur="handleType" value="" autocomplete="new-password" />
                                <div class="input-group is-danger" role="alert">
                                    {{ errors.first("password") }}
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
                                <input class="form-control" id="confirm_password" name="confirm_password" type="password" v-model="confirm_password" placeholder="確認用パスワード" @input="changeInput()" v-validate="'required|confirmed:password'" />
                                <div class="input-group is-danger" role="alert">
                                    {{ errors.first("confirm_password") }}
                                </div>
                            </div>
                            <div class="form-actions">
                                <button class="btn btn-primary" type="submit">セーブ</button>
                                <a :href="listUserUrl" class="btn btn-secondary" type="button">キャンセル</a>
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
import axios from 'axios';
import Loader from "./../../common/loader";

export default {
    created: function () {
        let messError = {
            custom: {
                nameUser: {
                    required: "名前を入力してください",
                },
                email: {
                    required: "メールアドレスを入力してください",
                    email_format: "メールアドレス形式は正しくありません。",
                },
                password: {
                    required: "パスワードを入力してください",
                    min: "8文字以上のパスワードを入力してください。",
                    max: "15文字以内のパスワードを入力してください。",
                },
                confirm_password: {
                    required: "パスワードを再入力してください",
                    confirmed: "パスワード が入力されたものと異なります。",
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
            nameUser: '',
            email: '',
            password: '',
            confirm_password: '',
            flagShowLoader: false,
            messageText: this.message,
            errorsData: {}
        };
    },
    props: ["listUserUrl"],
    mounted() {},
    methods: {
        register() {
            let that = this;
            let formData = new FormData();
            formData.append("name", this.nameUser);
            formData.append("email", this.email);
            formData.append("password", this.password);
            formData.append("confirm_password", this.confirm_password);
            this.$validator.validateAll().then((valid) => {
                if (valid) {
                    that.flagShowLoader = true;
                    axios
                        .post(`post-register-user`, formData, {
                            header: {
                                "Content-Type": "multipart/form-data",
                            },
                        })
                        .then((res) => {
                            this.$swal({
                                title: "データが正常に追加されました",
                                icon: "success",
                                confirmButtonText: "OK",
                            }).then(function (confirm) {
                                that.flagShowLoader = false;
                                location.replace(res.data);
                            });
                        })
                        .catch((err) => {
                            switch (err.response.status) {
                                case 400:
                                    this.errorsData = err.response.data;
                                    break;
                                case 500:
                                    this.$swal({
                                        title: "失敗したデータを追加しました",
                                        icon: "error",
                                        confirmButtonText: "Cool",
                                    }).then(function (confirm) {});
                                    break;
                                default:
                                    break;
                            }
                        });
                }
            });

        },
        changeInput() {
            this.errorsData = [];
            this.messageText = "";
        },
        handleType(event) {
            const {
                srcElement,
                type
            } = event;
            const {
                name,
                value
            } = srcElement;

            if (type === "blur" && !value) {
                this.fieldTypes[name] = "text";
            } else {
                this.fieldTypes[name] = "password";
            }
        },
    },
}
</script>
