<template>
<div class="container-fluid report-management">
    <div class="fade-in mb-3">
        <div class="row">
            <div class="col-lg-12">
                <a :class="[isActive == 'now' ? 'active' : '', 'btn btn-secondary']" type="button" @click="filters.date = new Date(); isActive = 'now'; updateTable();">今日</a>
                <a :class="[isActive == 'yesterday' ? 'active' : '', 'btn btn-secondary ml-2']" type="button" @click="filters.date = new Date(); filters.date.setDate(filters.date.getDate() - 1); isActive = 'yesterday'; updateTable();">昨日</a>
                <a :class="[isActive == 'prev' ? 'active' : '', 'btn btn-square btn-secondary rounded-left ml-2']" type="button" @click="filters.date = new Date(filters.date); filters.date.setDate(filters.date.getDate() - 1); isActive = 'prev'; updateTable();">
                    <</a> <a :class="[isActive == 'next' ? 'active' : '', 'btn btn-square btn-secondary rounded-right']" type="button" @click="filters.date = new Date(filters.date); filters.date.setDate(filters.date.getDate() + 1); isActive = 'next'; updateTable();">>
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
                        <data-table :columns="columns" :filters="filters" :url="urlGetData" ref="reportList" :translate="translate">
                            <span slot="filters"> </span>
                            <tbody slot="body" slot-scope="{ data }">
                                <tr :key="item.id" v-for="item in data">
                                    <td :key="column.name" v-for="column in columns">
                                        <data-table-cell :value="item" :name="column.name" :meta="column.meta" :comp="column.component" :classes="column.classes">
                                        </data-table-cell>
                                        <slot v-if="column.name == 'account_name'">
                                            {{ item.user.name }}
                                        </slot>
                                        <slot v-if="column.name == 'action'">
                                            <button class="btn btn-danger" @click="handleDelete(item.id)">
                                                削除
                                            </button>
                                        </slot>
                                        <slot v-if="column.name == 'opportunity_rate'">
                                            {{ item.deal_num / item.ping_pong_num * 100 }}
                                        </slot>
                                        <slot v-if="column.name == 'contract_rate'">
                                            {{ item.acquisitions_num / item.ping_pong_num * 100 }}
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
            <h5>指標毎の営業マン成績</h5>
            <button class="btn btn-outline-primary" type="button">ピンポン数</button>
            <button class="btn btn-outline-primary ml-2" type="button">成約率</button>
            <button class="btn btn-outline-primary ml-2" type="button">総獲得数</button>
            <button class="btn btn-outline-primary ml-2" type="button">生産性</button>
        </div>
    </div>
</div>
</template>

<script>
import axios from "axios";
import Loader from "./../common/loader";

export default {
    created: function () {},
    components: {
        Loader,
    },
    data() {
        return {
            csrfToken: Laravel.csrfToken,
            flagShowLoader: false,
            urlGetData: this.data.urlGetData,
            isActive: 'now',
            date: new Date(),
            columns: [{
                    label: "アカウント名",
                    name: "account_name",
                    orderable: true
                },
                {
                    label: "報告の有無",
                    name: "action",
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
                    label: "商談数（件）",
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
                    name: "created_at_format",
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
            classes: {
                "table-container": {
                    "table-responsive": true,
                },
                table: {
                    table: true,
                    "table-striped": true,
                    "table-bordered": true,
                    "table-borderless": true,
                },
                "t-head": {},
                "t-body": {},
                "t-head-tr": {},
                "t-body-tr": {},
                td: {},
                th: {},
            },
        };
    },
    props: ["data"],
    mounted() {},
    methods: {
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
    created() {},
}
</script>
