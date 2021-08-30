<template>
    <div class="container daily_report_complete">
        <div class="row content">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-9">
                            </div>
                            <div class="col-md-12 mt-2">
                                <h3 class="text-success text-center font-weight-bold">パスワード変更が完了しました。</h3>
                            </div>
                            <div class="col-md-12 text-center mt-3">
                                <img src="/image/dailyReportComplete.png" class="w-25" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-12 text-center">
                        <a v-bind:href="topUrl"><span class="custom-color">TOPに戻る</span> </a>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
    </div>
</template>

<script>
    export default {
        created: function () {},
        data() {
            return {
                csrfToken: Laravel.csrfToken,
            };
        },
        props: ["data", "topUrl"],
        mounted() {
        },
        methods: {

        },
    };
</script>
