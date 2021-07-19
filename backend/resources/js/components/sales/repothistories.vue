<template>
<div class="container report-histories">
    <div class="row">
        <div class="col-sm-9 col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="form-group row mb-0">
                        <div class="col-sm-9 col-md-12">
                            <h5 class="mb-0">簡易検索</h5>
                        </div>
                        <div class="col-sm-9 col-md-12">
                            <div class="list-group d-inline-block col-lg-9">
                                <div class="border border-primary rounded text-center d-inline-block mt-2 mr-2">
                                    <a href="javascript:;" :class="[isActive == '1' ? activeClass : '', 'list-group-item', 'list-group-item-action']" @click="changeDate(1)">
                                        <h5 class="text-primary mb-0">
                                            今日
                                        </h5>
                                    </a>
                                </div>
                                <div class="border border-primary rounded text-center d-inline-block mt-2 mr-2">
                                    <a href="javascript:;" :class="[isActive == '2' ? activeClass : '', 'list-group-item', 'list-group-item-action']" @click="changeDate(2)">
                                        <h5 class="text-primary mb-0">
                                            昨日
                                        </h5>
                                    </a>
                                </div>
                                <div class="border border-primary rounded text-center d-inline-block mt-2 mr-2">
                                    <a href="javascript:;" :class="[isActive == '8' ? activeClass : '', 'list-group-item', 'list-group-item-action']" @click="changeDate(8)">
                                        <h5 class="text-primary mb-0">
                                            直近7日間
                                        </h5>
                                    </a>
                                </div>
                                <div class="border border-primary rounded text-center d-inline-block mt-2 mr-2">
                                    <a href="javascript:;" :class="[isActive == '31' ? activeClass : '', 'list-group-item', 'list-group-item-action']" @click="changeDate(31)">
                                        <h5 class="text-primary mb-0">
                                            直近30日間
                                        </h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9 col-md-12 mt-3">
                            <h5>指標で絞り込み</h5>
                        </div>
                        <div class="col-sm-9 col-md-12">
                            <form v-on:submit.prevent="getData">
                                <div class="form-group col-lg-9 col-xl-6 p-0">
                                    <div class="search-date-time">
                                        <date-picker v-model="time" :format="'YYYY年MM月DD日'" @change="changeDate(null)" range></date-picker>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary h-45">
                                    <h5 class="mb-0">検索</h5>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="form-group row mb-0">
                        <div class="col-sm-9 col-md-12">
                            <table class="w-100 text-center">
                                <tr>
                                    <td class="pr-1">
                                        <table class="table table-borderless mb-2">
                                            <tr>
                                                <td>ピンポン数</td>
                                            </tr>
                                            <tr>
                                                <td>{{ dataReport.ping_pong_num != null ? fomatNumber(dataReport.ping_pong_num) : '---' }}</td>
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
                                                <td>{{ dataReport.meet_num != null ? fomatNumber(dataReport.meet_num) : '---' }}</td>
                                            </tr>
                                            <tr>
                                                <td>件</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="pl-1">
                                        <table class="table table-borderless mb-2">
                                            <tr>
                                                <td>商談率</td>
                                            </tr>
                                            <tr>
                                                <td>{{dataReport.deal_num != null ? fomatNumber(dataReport.deal_num) : '---' }}</td>
                                            </tr>
                                            <tr>
                                                <td>件</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pr-1">
                                        <table class="table table-borderless m-0">
                                            <tr>
                                                <td>獲得数</td>
                                            </tr>
                                            <tr>
                                                <td>{{ dataReport.acquisitions_num != null ? fomatNumber(dataReport.acquisitions_num) : '---' }}</td>
                                            </tr>
                                            <tr>
                                                <td>件</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="pr-1 pl-1">
                                        <table class="table table-borderless m-0">
                                            <tr>
                                                <td>稼働時間</td>
                                            </tr>
                                            <tr>
                                                <td>{{ dataReport.sale_time != null ? fomatNumber(dataReport.sale_time) : '---' }}</td>
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
        <div class="col-sm-9 col-md-12">
            <div class="form-group row mb-2">
                <div class="col-md-9 col-lg-12 text-center">
                    <a :href="salesManagementUrl">営業管理に戻る</a>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9 col-lg-12 text-center">
                    <a :href="topPageUrl">TOPに戻る</a>
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
import Loader from "./../common/loader";

export default {
    components: {
        DatePicker,
        Loader
    },
    data() {
        return {
            time: [new Date(), new Date()],
            isActive: null,
            activeClass: 'active',
            flagShowLoader: false,
            getDate: null,
            getMonth: null,
            getFullYear: null,
            dataReport: [],
            requestTime: []
        };
    },
    props: ["salesManagementUrl", "topPageUrl"],
    mounted() {
        var date = new Date();
        this.getDate = date.getDate();
        this.getMonth = date.getMonth();
        this.getFullYear = date.getFullYear();
        this.requestTime = this.time
        this.getData();
        this.changeDate(1)
    },
    methods: {
        fomatNumber(number) {
            return new Intl.NumberFormat('en-IN', {
                maximumSignificantDigits: 3
            }).format(number);
        },
        getData() {
            let that = this;
            console.log(this.requestTime)
            let formData = new FormData();
            var start_date = this.requestTime[0].getFullYear() + '-' + (this.requestTime[0].getMonth() + 1) + '-' + this.requestTime[0].getDate();
            var end_date = this.requestTime[1].getFullYear() + '-' + (this.requestTime[1].getMonth() + 1) + '-' + this.requestTime[1].getDate();
            formData.append("start_date", start_date);
            formData.append("end_date", end_date);
            that.flagShowLoader = true;
            axios
                .post(`get_data_report_histories`, formData, {
                    header: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((res) => {
                    that.dataReport = res.data.data[0];
                    that.flagShowLoader = false;
                })
                .catch((err) => {});
        },
        changeDate(value) {
            if(value != null) {
                this.isActive = value;
                this.time = []
                if (value != 0) {
                    var date = new Date(),
                        y = date.getFullYear(),
                        m = date.getMonth(),
                        d = date.getDate();
                    var startDate = new Date(Date.UTC(y, m, d - value + 1));
                    var endDate = new Date(Date.UTC(y, m, d));
                    if (value == 2) endDate = new Date(Date.UTC(y, m, d - value + 1));
                    this.time = [startDate, endDate];
                    this.requestTime = this.time;
                    this.time = []
                }
            } else {
                this.isActive = value
                this.requestTime = this.time;
            }
            console.log(this.requestTime)
        },
    }
};
</script>
