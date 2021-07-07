<template>
<div class="container report-histories">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="ping_pong_num"></label>
                        <div class="col-md-9">
                            <h5 class="mb-0">簡易検索</h5>
                        </div>
                        <div class="col-md-9">
                            <div class="list-group d-inline-block">
                                <div class="border border-primary rounded text-center d-inline-block mt-2 mr-2">
                                    <a class="list-group-item list-group-item-action" @click="getNowData">
                                        <h5 class="text-primary mb-0">
                                            今日
                                        </h5>
                                    </a>
                                </div>
                                <div class="border border-primary rounded text-center d-inline-block mt-2 mr-2">
                                    <a class="list-group-item list-group-item-action" @click="getYesterDayData">
                                        <h5 class="text-primary mb-0">
                                            昨日
                                        </h5>
                                    </a>
                                </div>
                                <div class="border border-primary rounded text-center d-inline-block mt-2 mr-2">
                                    <a class="list-group-item list-group-item-action" @click="getLast7DaysData">
                                        <h5 class="text-primary mb-0">
                                            直近7日間
                                        </h5>
                                    </a>
                                </div>
                                <div class="border border-primary rounded text-center d-inline-block mt-2 mr-2">
                                    <a class="list-group-item list-group-item-action" @click="getLast30DaysData">
                                        <h5 class="text-primary mb-0">
                                            直近30日間
                                        </h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 mt-3">
                            <h5>期間で絞り込み</h5>
                        </div>
                        <div class="col-md-9">
                            <form v-on:submit.prevent="getData">
                                <div class="form-group">
                                    <date-picker v-model="time" ref="datePicker" format="YYYY年MM月DD日" range></date-picker>
                                </div>
                                <button type="submit" class="btn btn-primary h-45">
                                    <h5 class="mb-0">検索</h5>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-9">
                            <table class="w-100 text-center">
                                <tr>
                                    <td class="pr-1">
                                        <table class="table table-borderless mb-2">
                                            <tr>
                                                <td>ピンポン数</td>
                                            </tr>
                                            <tr>
                                                <td>{{ fomatNumber(data[0].ping_pong_num) }}</td>
                                            </tr>
                                            <tr>
                                                <td>件</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="pr-1 pl-1">
                                        <table class="table table-borderless mb-2">
                                            <tr>
                                                <td>対面数</td>
                                            </tr>
                                            <tr>
                                                <td>{{ fomatNumber(data[0].meet_num) }}</td>
                                            </tr>
                                            <tr>
                                                <td>件</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="pl-1">
                                        <table class="table table-borderless mb-2">
                                            <tr>
                                                <td>商談数</td>
                                            </tr>
                                            <tr>
                                                <td>{{ fomatNumber(data[0].deal_num) }}</td>
                                            </tr>
                                            <tr>
                                                <td>件</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pr-1">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>獲得数</td>
                                            </tr>
                                            <tr>
                                                <td>{{ fomatNumber(data[0].acquisitions_num) }}</td>
                                            </tr>
                                            <tr>
                                                <td>件</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="pr-1 pl-1">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>稼働時間</td>
                                            </tr>
                                            <tr>
                                                <td>{{ fomatNumber(data[0].sale_time) }}</td>
                                            </tr>
                                            <tr>
                                                <td>時間</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
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
                    <a>TOPに戻る</a>
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
</div>
</template>

<script>
import axios from 'axios';
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
export default {
    components: {
        DatePicker
    },
    data() {
        return {
            time: [],
            data: this.data
        };
    },
    props: ["data", "formUrl"],
    mounted() {
        var date = new Date(),
            y = date.getFullYear(),
            m = date.getMonth(),
            d = date.getDate();
        var firstDay = new Date(y, m - 1, d);
        this.time = [firstDay, new Date()];
    },
    methods: {
        fomatNumber(number) {
            return new Intl.NumberFormat('en-IN', {
                maximumSignificantDigits: 3
            }).format(number);
        },
        getNowData() {
            this.time = [new Date(), new Date()];
            this.getData();
        },
        getYesterDayData() {
            var date = new Date(),
                y = date.getFullYear(),
                m = date.getMonth(),
                d = date.getDate();
            var firstDay = new Date(y, m, d - 1);
            this.time = [firstDay, new Date()];
            this.getData();
        },
        getLast7DaysData() {
            var date = new Date(),
                y = date.getFullYear(),
                m = date.getMonth(),
                d = date.getDate();
            var firstDay = new Date(y, m, d - 7);
            this.time = [firstDay, new Date()];
            this.getData();
        },
        getLast30DaysData() {
            var date = new Date(),
                y = date.getFullYear(),
                m = date.getMonth(),
                d = date.getDate();
            var firstDay = new Date(y, m -1, d);
            this.time = [firstDay, new Date()];
            this.getData();
        },
        getData() {
            let formData = new FormData();
            var start_date = this.time[0].getFullYear() + '-' + (this.time[0].getMonth() + 1) + '-' + this.time[0].getDate();
            var end_date = this.time[1].getFullYear() + '-' + (this.time[1].getMonth() + 1) + '-' + this.time[1].getDate();
            console.log(this.time[0].getDate());
            formData.append("start_date", start_date);
            formData.append("end_date", end_date);
            axios
                .post(`api/report_histories`, formData, {
                    header: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((res) => {
                    this.data = res.data;
                })
                .catch((err) => {

                });
        },
    }
};
</script>
