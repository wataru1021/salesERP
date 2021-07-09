<template>
  <div class="container-fluid">
    <div class="fade-in">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="sales-chart-title">指標</div>
              <div class="row align-items-center col-8">
                <div class="mb-3 mb-xl-0">
                  <button
                    class="btn btn-block btn-outline-primary btn-sc-type"
                    type="button"
                    v-if="showChartTypeComputed !== pinPont"
                    v-on:click="switchShowType(pinPont)"
                  >
                    ピンポン数
                  </button>
                  <button
                    v-if="showChartTypeComputed === pinPont"
                    class="btn btn-block btn-primary btn-sc-type"
                    type="button"
                  >
                    ピンポン数
                  </button>
                </div>
                <div class="sc-type-item mb-3 mb-xl-0">
                  <button
                    class="btn btn-block btn-outline-primary btn-sc-type"
                    type="button"
                    v-if="showChartTypeComputed !== contractRate"
                    v-on:click="switchShowType(contractRate)"
                  >
                    成約率
                  </button>
                  <button
                    v-if="showChartTypeComputed === contractRate"
                    class="btn btn-block btn-primary btn-sc-type"
                    type="button"
                  >
                    成約率
                  </button>
                </div>
                <div class="sc-type-item mb-3 mb-xl-0">
                  <button
                    class="btn btn-block btn-outline-primary btn-sc-type"
                    type="button"
                    v-if="showChartTypeComputed !== acquisitionsNum"
                    v-on:click="switchShowType(acquisitionsNum)"
                  >
                    総獲得数
                  </button>
                  <button
                          v-if="showChartTypeComputed === acquisitionsNum"
                          class="btn btn-block btn-primary btn-sc-type"
                          type="button"
                  >
                    総獲得数
                  </button>
                </div>
                <div class="sc-type-item mb-3 mb-xl-0">

                  <button
                          class="btn btn-block btn-outline-primary btn-sc-type"
                          type="button"
                          v-if="showChartTypeComputed !== productivity"
                          v-on:click="switchShowType(productivity)"
                  >
                    生産性
                  </button>


                  <button
                          v-if="showChartTypeComputed === productivity"
                          class="btn btn-block btn-primary btn-sc-type"
                          type="button"
                  >
                    生産性
                  </button>
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
              <div class="sales-chart-title">簡易検索</div>
              <div class="row align-items-center col-8">
                <div class="mb-3 mb-xl-0">





                  <button
                          class="btn btn-block btn-outline-primary btn-sc-type"
                          type="button"
                          v-if="showTimeLineComputed !== today"
                          v-on:click="switchTimeLine(today)"
                  >
                    今日
                  </button>


                  <button
                          v-if="showTimeLineComputed === today"
                          class="btn btn-block btn-primary btn-sc-type"
                          type="button"
                  >
                    今日
                  </button>

                </div>
                <div class="sc-type-item mb-3 mb-xl-0">
                  <button
                          class="btn btn-block btn-outline-primary btn-sc-type"
                          type="button"
                          v-if="showTimeLineComputed !== yesterDay"
                          v-on:click="switchTimeLine(yesterDay)"
                  >
                    昨日
                  </button>


                  <button
                          v-if="showTimeLineComputed === yesterDay"
                          class="btn btn-block btn-primary btn-sc-type"
                          type="button"
                  >
                    昨日
                  </button>

                </div>
                <div class="sc-type-item mb-3 mb-xl-0">

                  <button
                          class="btn btn-block btn-outline-primary btn-sc-type"
                          type="button"
                          v-if="showTimeLineComputed !== last7Days"
                          v-on:click="switchTimeLine(last7Days)"
                  >
                    直近7日間
                  </button>


                  <button
                          v-if="showTimeLineComputed === last7Days"
                          class="btn btn-block btn-primary btn-sc-type"
                          type="button"
                  >
                    直近7日間
                  </button>

                </div>
                <div class="sc-type-item mb-3 mb-xl-0">


                  <button
                          class="btn btn-block btn-outline-primary btn-sc-type"
                          type="button"
                          v-if="showTimeLineComputed !== last30Days"
                          v-on:click="switchTimeLine(last30Days)"
                  >
                    直近30日間
                  </button>


                  <button
                          v-if="showTimeLineComputed === last30Days"
                          class="btn btn-block btn-primary btn-sc-type"
                          type="button"
                  >
                    直近30日間
                  </button>
                </div>
              </div>
              <div class="mb-3"></div>
              <div class="sales-chart-title">期間で絞り込み</div>
              <div class="row align-items-center col-8">
                <div class="pl-0 form-group col-4">

                  <date-picker @change="clearTimeLine()" v-model="valueDateRange" type="date" :clearable="false"	 range
                  >
                    <div slot="input" class="input-group ig-date">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <div class="c-icon icon-sales-chart">
                          </div>
                        </div>
                      </div>
                      <input id="datefilter" type="text" name="datefilter" :placeholder="[[placeHolderComputed]]" class="form-control">
                    </div>
                    <span slot="icon-calendar">

                    </span>
                  </date-picker>



                </div>
              </div>
              <div class="form-group form-actions">
                <button class="btn pl-4 pr-4 btn-primary" type="submit" v-on:click="getChartData()">
                  検索
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="sales-chart-title">{{timeLineTextComputed}}</div>
              <CChartBar
                style="height: 300px"
                :labels="salesChartLabels"
                :datasets="[
                  {
                    data: salesChartDatas,
                    backgroundColor: '#F5F5F5',
                  },
                ]"
                :options="{
                animation : {
                duration : 0
                },

                  maintainAspectRatio: false,
                  legend: false,
                  scales: {
                    xAxes: [
                      {
                        gridLines: {
                          display: false,
                        },
                        ticks: {
                          reverse: true,
                        },
                      },
                    ],
                    yAxes: [
                      {
                        ticks: {
                          display: false,
                        },
                      },
                    ],
                  },
                }"
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

const pinPont = 'pinPont';
const contractRate = 'contractRate';
const acquisitionsNum = 'acquisitionsNum';
const productivity = 'productivity';

const  handMadeTimeLine = 0;
const today = 1;
const yesterDay = 2;
const last7Days = 3;
const last30Days = 4;
export default {
  created: function () {},
  components: {
    Loader,
  },
  data() {
    return {
      csrfToken: Laravel.csrfToken,
      flagShowLoader: false,
      salesChartLabels: [],
      showDataType: null,
      salesChartDatas: [],
      salesChartObjectDatas: [],
      pinPont,
      acquisitionsNum,
      contractRate,
      productivity,
      showTimeLine : today,
      today,
      last7Days,
      yesterDay,
      last30Days,
      handMadeTimeLine,
      timeLineText: '',
      valueDateRange: [new Date(), new Date()],
      placeholderText: '',
      namesUserNoData: []
    };
  },
  props: ["data"],
  mounted() {
    var ctypeStorage = JSON.parse(localStorage.getItem('ctypeStorage'));
    this.showDataType = ctypeStorage;
    this.getChartData();
  },
  computed: {
    showChartTypeComputed: function () {
      return this.showDataType;
    },
    showTimeLineComputed: function () {
      return this.showTimeLine;
    },
    timeLineTextComputed: function () {
      return this.timeLineText;
    },
    placeHolderComputed: function () {
      var startDay = this.valueDateRange[0].toLocaleString('ja',{month:'long',day:'numeric', year:'numeric'});
      var endDay = this.valueDateRange[1].toLocaleString('ja',{month:'long',day:'numeric', year:'numeric'});
      return startDay + '～' + endDay;
    }
  },
  methods: {
    clearTimeLine(){
      this.showTimeLine = handMadeTimeLine;
    },
    getChartData() {
      let that = this;
      that.flagShowLoader = true;
      axios
        .get("sales-chart/get-chart-data", {
          params: {
            timeLine : this.showTimeLine,
            startDate : this.valueDateRange[0],
            endDate : this.valueDateRange[1]
          }
        })
        .then((response) => {
          that.flagShowLoader = false;
          this.salesChartObjectDatas = response.data.data.arr;
          this.timeLineText = response.data.data.timeLineText;
          this.namesUserNoData = response.data.data.names;
          that.updateChartData();
        })
        .catch((error) => {
          alert(error);
        });
    },
    updateChartData() {
      this.salesChartLabels = this.salesChartObjectDatas.map(
              (a) => a.user.name
      );
      this.salesChartLabels = this.namesUserNoData.concat(this.salesChartLabels);
      this.salesChartLabels.unshift("");
      switch (this.showDataType) {
        case pinPont:
          this.salesChartDatas = this.salesChartObjectDatas.map(
                  (a) => a.ping_pong_num
          );
          break;
        case contractRate:
          this.salesChartDatas = this.salesChartObjectDatas.map(
                  (a) => a.contract_rate
          );
          break;
        case acquisitionsNum:
          this.salesChartDatas = this.salesChartObjectDatas.map(
                  (a) => a.acquisitions_num
          );
          break;
        case productivity:
          this.salesChartDatas = this.salesChartObjectDatas.map(
                  (a) => a.productivity
          );
          break;
      }
      this.salesChartDatas = Array(this.namesUserNoData.length).fill(0).concat(this.salesChartDatas);
      this.salesChartDatas.unshift(0);
    },
    switchShowType(type) {
      this.showDataType = type;
      this.updateChartData()
    },
    switchTimeLine(type) {
      this.showTimeLine = type;
      switch (type) {
        case today:
          this.valueDateRange = [new Date(), new Date()];
          break;
        case yesterDay:
          this.valueDateRange = [new Date((new Date()).valueOf() - 1000*60*60*24), new Date((new Date()).valueOf() - 1000*60*60*24)];
          break;
        case last7Days:
          this.valueDateRange = [ new Date((new Date()).valueOf() - 7*1000*60*60*24), new Date()];
          break;
          case last30Days:
          this.valueDateRange = [ new Date((new Date()).valueOf() - 30*1000*60*60*24), new Date()];
          break;
      }
    },
  },
  created() {},
};
</script>

