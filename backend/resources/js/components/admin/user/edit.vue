<template>
    <div class="container-fluid register-user">
        <div class="fade-in">
            <div class="row">
                <div class="col-xs-12 col-lg-8 col-xl-6 m-auto">
                    <div class="card">
                        <div class="card-header">ユーザー編集</div>
                        <form class="form-horizontal" method="POST" ref="registerForm" @submit.prevent="editForm" autocomplete="off">
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                            <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
                                        </svg>
                                    </span>
                                    </div>
                                    <input type="text" class="form-control" id="nameUser" name="nameUser" placeholder="お名前" v-model="nameUser" @input="changeInput()" v-validate="'required|max:255'" />
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
                                    <input class="form-control" id="email" name="email" type="text" v-model="email" placeholder="メールアドレス" @input="changeInput()" v-validate="'required|email_format|max:255'" />
                                    <div class="input-group is-danger" role="alert">
                                        {{ errors.first("email") }}
                                    </div>
                                    <div class="input-group is-danger" role="alert" v-if="errorsData.email">{{ errorsData.email }}</div>
                                </div>


                                <div class="form-actions">
                                    <button class="btn btn-primary" type="submit">保存</button>
                                    <a :href="listUserUrl" class="btn btn-secondary" type="button">キャンセル</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <loader :flag-show="flagShowLoader"></loader>
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
                        max: "名前は255文字以内で入力してください。",
                    },
                    email: {
                        required: "メールアドレスを入力してください",
                        email_format: "メールアドレス形式は正しくありません。",
                        max: "メールアドレスは255文字以内で入力してください。",
                    }
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
                nameUser: this.user.name,
                email: this.user.email,
                flagShowLoader: false,
                messageText: this.message,
                errorsData: {}
            };
        },
        props: ["listUserUrl", "user"],
        mounted() {},
        methods: {
            editForm() {
                let that = this;
                let formData = new FormData();
                formData.append("name", this.nameUser);
                formData.append("email", this.email);
                this.$validator.validateAll().then((valid) => {
                    if (valid) {
                        that.flagShowLoader = true;
                        axios
                            .post(`post-edit-user`, formData, {
                                header: {
                                    "Content-Type": "multipart/form-data",
                                },
                            })
                            .then((res) => {
                                that.flagShowLoader = false;
                                this.$swal({
                                    title: "ユーザーが更新されました。",
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
                                        that.flagShowLoader = false;
                                        break;
                                    case 404:
                                    case 500:
                                        this.errorsData = err.response.data;
                                        that.flagShowLoader = false;
                                        this.$swal({
                                            title: "編集は失敗しました。",
                                            icon: "error",
                                            confirmButtonText: "OK",
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
        },
    }
</script>
