<template>
    <div class="container-fluid report-management">
        <div class="fade-in mb-3">
            <div class="row">
                <div class="col-lg-12">
                    <a :class="[isActive == 'now' || filters.date.toISOString().slice(0,10) == new Date().toISOString().slice(0,10) ? 'btn btn-outline-primary active' : 'btn btn-outline-secondary']" type="button"
                       @click="filters.date = new Date(); isActive = 'now'; updateTable();">今日</a>
                    <a :class="[isActive == 'yesterday' || Math.ceil(Math.abs(new Date() - filters.date)/ (1000*60*60*24)) == 2  && new Date() > filters.date ? 'btn btn-outline-primary active' : 'btn btn-outline-secondary']" type="button"
                       @click="filters.date = new Date(); filters.date.setDate(filters.date.getDate() - 1); isActive = 'yesterday'; updateTable();">昨日</a>
                    <a :class="[isActive == 'prev' ? 'btn btn-outline-primary active' : 'btn btn-outline-secondary']"
                       type="button"
                       @click="filters.date = new Date(filters.date); filters.date.setDate(filters.date.getDate() - 1); isActive = 'prev'; updateTable();"><
                        </a> <a
                        :class="[isActive == 'next' ? 'btn btn-outline-primary active' : 'btn btn-outline-secondary']"
                        type="button"
                        @click="filters.date = new Date(filters.date); filters.date.setDate(filters.date.getDate() + 1); isActive = 'next'; updateTable();">>
                </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i>
                        {{ filters.date.getFullYear() }}年
                        {{ filters.date.getMonth() + 1 }}月
                        {{ filters.date.getDate() }}日
                        {{ getDayData(filters.date) }}の報告
                    </div>
                    <div class="card-body">
                        <div class="cd-table-responsive">
                            <data-table :columns="columns" :filters="filters" :url="urlGetData" ref="reportList"
                                        :translate="translate" :classes="classes">
                                <span slot="filters"> </span>
                                <tbody slot="body" slot-scope="{ data }">
                                <tr :key="item.id" v-for="item in data">

                                    <td :key="column.name" v-for="column in columns">
                                        <data-table-cell :value="item" :name="column.name" :meta="column.meta"
                                                         :comp="column.component" :classes="column.classes">
                                        </data-table-cell>
                                        <slot v-if="column.name == 'name'">
                                            <svg class="c-icon" v-if="item.reportId != null" v-on:click="navigateReportHistory(item.userId)">
                                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-external-link"></use>
                                            </svg>

                                        </slot>


                                        <slot v-if="column.name == 'has_report'">
                                            <span>{{item.reportId != null  ? "〇" : ""}} </span>
                                            <svg class="c-icon" v-if="item.reportId != null" v-on:click="navigateReportHistory(item.userId)">
                                                <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-external-link"></use>
                                            </svg>


                                        </slot>


                                        <slot v-if="column.name == 'productivity' && item.reportId == null">
                                            ---
                                        </slot>

                                        <slot v-if="column.name == 'ping_pong_num' && item.reportId == null">
                                            ---
                                        </slot>

                                        <slot v-if="column.name == 'meet_num' && item.reportId == null ">
                                            ---
                                        </slot>

                                        <slot v-if="column.name == 'acquisitions_num' && item.reportId == null">
                                            ---                                        </slot>
                                        <slot v-if="column.name == 'sale_time' && item.reportId == null">
                                            ---                                        </slot>
                                        <slot v-if="column.name == 'conscious_point' && item.reportId == null">
                                            ---                                        </slot>
                                        <slot v-if="column.name == 'report_date' && item.reportId == null ">
                                            ---                                        </slot>

                                        <slot v-if="column.name == 'opportunity_rate'  && item.reportId == null">
                                             ---
                                        </slot>
                                        <slot v-if="column.name == 'contract_rate' && item.reportId == null">

                                            ---
                                        </slot>
                                    </td>
                                </tr>
                                </tbody>
                            </data-table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <div class="sales-chart-title pb-0">指標毎の営業マン成績 </div>
                    </div>
                    <div class="card-body pt-0">
                        <button v-on:click="redirect(pinPont)" class="btn btn-outline-primary" type="button">ピンポン数
                        </button>
                        <button v-on:click="redirect(contractRate)" class="btn btn-outline-primary ml-2" type="button">
                            成約率
                        </button>
                        <button v-on:click="redirect(acquisitionsNum)" class="btn btn-outline-primary ml-2"
                                type="button">総獲得数
                        </button>
                        <button v-on:click="redirect(productivity)" class="btn btn-outline-primary ml-2" type="button">
                            生産性
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    import Loader from "../../common/loader";

    const pinPont = 'pinPont';
    const contractRate = 'contractRate';
    const acquisitionsNum = 'acquisitionsNum';
    const productivity = 'productivity';

    export default {
        created: function () {
        },
        components: {
            Loader,
        },
        data() {
            return {
                pinPont,
                acquisitionsNum,
                contractRate,
                productivity,
                csrfToken: Laravel.csrfToken,
                flagShowLoader: false,
                urlGetData: this.data.urlGetData,
                isActive: 'now',
                date: new Date(),
                columns: [{
                    label: "アカウント名",
                    name: "name",
                    orderable: true
                },
                    {
                        label: "報告の有無",
                        name: "has_report",
                        orderable: true
                    },
                    {
                        label: "ピンポン数（件）",
                        name: "ping_pong_num",
                        orderable: true
                    },
                    {
                        label: "対面数（件）",
                        name: "meet_num",
                        orderable: true
                    },
                    {
                        label: "商談率（件）",
                        name: "opportunity_rate",
                        orderable: true
                    },
                    {
                        label: "獲得数（件）",
                        name: "acquisitions_num",
                        orderable: true
                    },
                    {
                        label: "成約率（％）",
                        name: "contract_rate",
                        orderable: true
                    },
                    {
                        label: "稼働時間（時間）",
                        name: "sale_time",
                        orderable: true
                    },
                    {
                        label: "生産性（件/時間）",
                        name: "productivity",
                        orderable: true
                    },
                    {
                        label: "今日意識した点",
                        name: "conscious_point",
                        orderable: true
                    },
                    {
                        label: "報告時間",
                        name: "report_date",
                        orderable: true
                    },
                ],
                filters: {
                    date: new Date()
                },
                translate: {
                    nextButton: ">",
                    previousButton: "<",
                    placeholderSearch: 'nkjankjnasjdn'
                },
                pagination: {
                    data: {},
                    hideWhenEmpty: true
                },
                classes : {
                    "table-container": {
                        "table-responsive": true,
                        "table": true,
                    },
                    "table": {
                        "table-borderless": true,
                        "border" : false,
                        "text-nowrap" : true
                    },
                    "t-head": {

                    },
                    "t-body": {
                    },
                    "t-head-tr": {

                    },
                    "t-body-tr": {
                        'abc' :true
                    },
                    "tr" : {
                        'abc' :true
                    },
                    "td": {
                    },
                    "th": {
                        "text-nowrap" : true,
                        'r-m-th' : true

                    },
                },
            };
        },
        props: ["data"],
        mounted() {

        },
        methods: {
            navigateReportHistory(userId) {
                this.$store.commit('setUserIdSRH', userId);
                var userIdSRHStorage = JSON.parse(localStorage.getItem('userIdSRHStorage'));
                window.location.href = '/admin/sale-report-histories';
            },
            redirect(ctype) {
                this.$store.commit('setCType', ctype);
                window.location.href = '/admin/sales-chart';
            },
            getDayData(date) {
                switch (date.getDay()) {
                    case 0:
                        return '（日）'
                        break;
                    case 1:
                        return '（月）'
                        break;
                    case 2:
                        return '（火）'
                        break;
                    case 3:
                        return '（水）'
                        break;
                    case 4:
                        return '（木）'
                        break;
                    case 5:
                        return '（金）'
                        break;
                    case 6:
                        return '（土）'
                        break;

                    default:
                        break;
                }
            },
            updateTable() {
                this.$refs.reportList.getData();
            },
        },
        created() {
        },
    }
</script>
