<template>
    <div class="container daily_report_create">
        <div class="row content">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <h4>パスワード変更</h4>
                            </div>
                        </div>
                        <form
                                class="form-horizontal"
                                method="POST"
                                ref="changePasswordForm"
                                :action="formUrl"
                        >
                            <input type="hidden" :value="csrfToken" name="_token" />
                            <div class="form-group row mb-2">
                                <label class="col-md-3 col-form-label text-nowrap" for="password"
                                >パスワード変更</label
                                >
                                <div class="col-md-9">
                                    <input
                                            class="form-control"
                                            id="password"
                                            name="password"
                                            type="password"
                                            placeholder=""
                                            v-validate="'required|max:15|min:8'"
                                            @input="changeInput()"
                                            ref="password"
                                    />
                                    <div class="input-group is-danger" role="alert">
                                        {{ errors.first("password") }}
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <label class="col-md-3 col-form-label text-nowrap" for="repassword"
                                >パスワード（確認）</label
                                >
                                <div class="col-md-9">
                                    <input
                                            class="form-control"
                                            id="repassword"
                                            name="repassword"
                                            type="password"
                                            placeholder=""
                                            v-validate="'required|confirmed:password'"
                                            @input="changeInput()"
                                    />
                                    <div class="input-group is-danger" role="alert">
                                        {{ errors.first("repassword") }}
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
                                    <div>

                                    </div>
                                    <button class="btn btn-success change-password-submit" v-on:click="submit" >登録</button>
                                    <a :href="topUrl" class="btn btn-secondary " type="button">キャンセル</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 text-center">
                        <a v-bind:href="topUrl"><span class="custom-color">TOPに戻る</span></a>
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
                    password: {
                        required: "パスワードを入力してください。",
                        max : "15文字以内のパスワードを入力してください。",
                        min: "8文字以上のパスワードを入力してください。"
                    },
                    repassword: {
                        required : "パスワード （確認）を入力してください。",
                        confirmed: "パスワード が入力されたものと異なります。"
                    }
                },
            };
            this.$validator.localize("en", messError);
        },
        data() {
            return {
                csrfToken: Laravel.csrfToken,
                password: '',
                confirm_password: '',
                flagShowLoader: false,
                messageText: this.message,
                errorsData: {}
            };
        },
        props: ["formUrl", "message", "topUrl", "data",],
        mounted() {
        },
        methods: {
            submit: function (e) {
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
            }
        },
    };
</script>
