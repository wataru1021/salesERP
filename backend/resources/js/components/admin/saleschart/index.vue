<template>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="sales-chart-title">
                                指標
                            </div>
                            <div class="row align-items-center col-8">
                                <div class="  mb-3 mb-xl-0">
                                    <button class="btn btn-block btn-primary btn-sc-type" type="button" >ピンポン数</button>
                                </div>
                                <div class=" sc-type-item mb-3 mb-xl-0">
                                    <button class="btn btn-block btn-outline-primary btn-sc-type" type="button">成約率</button>
                                </div>
                                <div class=" sc-type-item mb-3 mb-xl-0">
                                    <button class="btn btn-block btn-outline-primary btn-sc-type" type="button">総獲得数</button>
                                </div>
                                <div class=" sc-type-item mb-3 mb-xl-0">
                                    <button class="btn btn-block btn-outline-primary btn-sc-type" type="button">生産性</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="sales-chart-title">
                                簡易検索
                            </div>
                            <div class="row align-items-center col-8">
                                <div class="  mb-3 mb-xl-0">
                                    <button class="btn btn-block btn-outline-primary btn-sc-type" type="button">今日</button>
                                </div>
                                <div class=" sc-type-item mb-3 mb-xl-0">
                                    <button class="btn btn-block btn-outline-primary btn-sc-type" type="button">昨日</button>
                                </div>
                                <div class=" sc-type-item mb-3 mb-xl-0">
                                    <button class="btn btn-block btn-outline-primary btn-sc-type" type="button">直近7日間</button>
                                </div>
                                <div class=" sc-type-item mb-3 mb-xl-0">
                                    <button class="btn btn-block btn-outline-primary btn-sc-type" type="button">直近30日間</button>
                                </div>
                            </div>
                            <div class="mb-3">

                            </div>
                            <div class="sales-chart-title">
                                簡易検索
                            </div>
                            <div class="row align-items-center col-8">
                                <div class="pl-0 form-group col-4">
                                    <div class="input-group ig-date ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <svg class="c-icon">
                                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-calendar"></use>
                                            </svg>
                                            </span>
                                        </div>
                                        <input class="form-control" id="datefilter" type="text" name="datefilter" placeholder="2020年6月14日～2021年6月30日" autocomplete="username">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <button class="btn pl-4 pr-4 btn-primary" type="submit">検索</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="sales-chart-title">
                                2020年6月14日～2021年6月30日
                            </div>
                            <CChartBar
                                    style="height:300px"
                                    :datasets="[
      {
        data: [10, 22, 33],
        backgroundColor: '#F5F5F5',
      }
    ]"
                                    :options="{ maintainAspectRatio: false, legend: false, barThickness: true, categoryPercentage: 0.5 }"
                            />


                        </div>
                    </div>
                </div>
            </div>


        </div>
        <loader :flag-show="flagShowLoader"></loader>
    </div>
</template>
<style >

</style>
<script>
    import axios from "axios";
    import Loader from "./../../common/loader";

    export default {
        created: function () {},
        components: {
            Loader,
        },
        data() {
            return {
                csrfToken: Laravel.csrfToken,
                flagShowLoader: false,
            };
        },
        props: ["data"],
        mounted() {},
        methods: {
            handleDelete(id) {
                let that = this;
                this.$swal({
                    title: "ユーザーを削除しますか？",
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonText: "キャンセル",
                    confirmButtonText: "削除",
                }).then((result) => {
                    if (result.value) {
                        that.flagShowLoader = true;
                        axios
                            .get("users/" + id + "/delete")
                            .then((response) => {
                                this.$swal({
                                    title: "ユーザーが削除されました。",
                                    icon: "success",
                                    confirmButtonText: "OK",
                                }).then(function (confirm) {});
                                that.updateTable();
                                that.flagShowLoader = false;
                            })
                            .catch((error) => {
                                alert(error);
                            });
                    }
                });
            },
            updateTable() {
                this.$refs.userList.getData();
            },
        },
        created() {},
    };
</script>

