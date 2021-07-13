<template>
<div class="container report-histories">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="form-group row mb-0">
                        <div class="col-md-9">
                            <h5 class="mb-0">簡易検索</h5>
                        </div>
                        <div class="col-md-9">
                            <div class="list-group d-inline-block">
                                <div class="border border-primary rounded text-center d-inline-block mt-2 mr-2">
                                    <a :class="[isActive == 'now' ? activeClass : '', 'list-group-item', 'list-group-item-action']" @click="time = [new Date(), new Date()]; isActive = 'now'">
                                        <h5 class="text-primary mb-0">
                                            今日
                                        </h5>
                                    </a>
                                </div>
                                <div class="border border-primary rounded text-center d-inline-block mt-2 mr-2">
                                    <a :class="[isActive == 'yesterday' ? activeClass : '', 'list-group-item', 'list-group-item-action']" @click="time = [new Date(getFullYear, getMonth, getDate - 1), new Date(getFullYear, getMonth, getDate - 1)]; isActive = 'yesterday'">
                                        <h5 class="text-primary mb-0">
                                            昨日
                                        </h5>
                                    </a>
                                </div>
                                <div class="border border-primary rounded text-center d-inline-block mt-2 mr-2">
                                    <a :class="[isActive == 'Last7days' ? activeClass : '', 'list-group-item', 'list-group-item-action']" @click="time = [new Date(getFullYear, getMonth, getDate - 7), new Date()]; isActive = 'Last7days'">
                                        <h5 class="text-primary mb-0">
                                            直近7日間
                                        </h5>
                                    </a>
                                </div>
                                <div class="border border-primary rounded text-center d-inline-block mt-2 mr-2">
                                    <a :class="[isActive == 'Last30days' ? activeClass : '', 'list-group-item', 'list-group-item-action']" @click="time = [new Date(getFullYear, getMonth -1, getDate), new Date()]; isActive = 'Last30days'">
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
                                    <div class="search-date-time">
                                        <date-picker v-model="time" :format="'YYYY年MM月DD日'"  @change="isActive = ''" range></date-picker>
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
                        <div class="col-md-9">
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
                                                <td>商談数</td>
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
        <div class="col-md-6">
            <div class="form-group row mb-2">
                <div class="col-md-9 text-center">
                    <a :href="salesManagementUrl">営業管理に戻る</a>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9 text-center">
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
export default {
    components: {
        DatePicker
    },
    data() {
        return {
            time: [new Date(), new Date()],
            isActive: "now",
            activeClass: 'active',
            getDate: null,
            getMonth: null,
            getFullYear: null,
            dataReport: []
        };
    },
    props: ["salesManagementUrl", "topPageUrl"],
    mounted() {
        var date = new Date();
        this.getDate = date.getDate();
        this.getMonth = date.getMonth();
        this.getFullYear = date.getFullYear();
        this.getData();
    },
    methods: {
        fomatNumber(number) {
            return new Intl.NumberFormat('en-IN', {
                maximumSignificantDigits: 3
            }).format(number);
        },
        getData() {
            let that = this;
            let formData = new FormData();
            var start_date = this.time[0].getFullYear() + '-' + (this.time[0].getMonth() + 1) + '-' + this.time[0].getDate();
            var end_date = this.time[1].getFullYear() + '-' + (this.time[1].getMonth() + 1) + '-' + this.time[1].getDate();
            formData.append("start_date", start_date);
            formData.append("end_date", end_date);
            axios
                .post(`get_data_report_histories`, formData, {
                    header: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((res) => {
                    that.dataReport = res.data.data[0];
                })
                .catch((err) => {});
        },
    }
};
</script>
