<template>
  <div class="container-fluid sale-daily-report-histories">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-1">
            <div class="card-body">
              <p class="mb-2">営業マン ※報告数順</p>
              <div class="sale-name-list">
                <button
                  @click="changeUserId(user.id)"
                  v-for="(user, index) in users"
                  :key="index"
                  class="btn btn-outline-primary ml-1 mt-1"
                  v-bind:class="{ 'is-active': userId == user.id }"
                >
                  {{ user.name }}
                </button>
              </div>
            </div>
          </div>
          <div class="card mb-1">
            <div class="card-body">
              <p class="mb-2">簡易検索</p>
              <div>
                <button
                  class="btn btn-outline-primary"
                  @click="changeDate(1)"
                  v-bind:class="{ 'is-active': valueSearch == 1 }"
                >
                  今日
                </button>
                <button
                  class="btn btn-outline-primary"
                  @click="changeDate(2)"
                  v-bind:class="{ 'is-active': valueSearch == 2 }"
                >
                  昨日
                </button>
                <button
                  class="btn btn-outline-primary"
                  @click="changeDate(8)"
                  v-bind:class="{ 'is-active': valueSearch == 8 }"
                >
                  直近7日間
                </button>
                <button
                  class="btn btn-outline-primary"
                  @click="changeDate(31)"
                  v-bind:class="{ 'is-active': valueSearch == 31 }"
                >
                  直近30日間
                </button>
              </div>
              <p class="mt-2 mb-2">期間で絞り込み</p>
              <div class="search-date-time">
                <date-picker
                  v-model="time"
                  :format="'YYYY年MM月DD日'"
                  range
                ></date-picker>
                <img
                  class="icon-calendar"
                  src="/image/iconCalendar.png"
                  alt=""
                  srcset=""
                />
              </div>
              <button class="btn btn-primary mt-2" @click="getData()">
                検索
              </button>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <p class="mb-0">
                {{ time[0] | formatDate }}～{{ time[1] | formatDate }}
              </p>
            </div>
            <div class="card-body pt-2">
              <div class="row">
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>ピンポン数</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">
                        {{
                          saleDailyHisries.ping_pong_num
                            ? saleDailyHisries.ping_pong_num
                            : "---"
                        }}<span>件</span>
                      </h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>総獲得数</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">
                        {{
                          saleDailyHisries.acquisitions_num
                            ? saleDailyHisries.acquisitions_num
                            : "---"
                        }}<span>件</span>
                      </h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>成約率</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">
                        {{ parseFloat(saleDailyHisries.contract_rate).toFixed(1) != "NaN" ? parseFloat(saleDailyHisries.contract_rate).toFixed(1)  : "---" }}<span>％</span>
                      </h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>生産性</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">
                        {{ parseFloat(saleDailyHisries.productivity).toFixed(1) != "NaN" ? parseFloat(saleDailyHisries.productivity).toFixed(1) : "---" }}<span>件/時間</span>
                      </h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>対面率</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">
                        {{ parseFloat(saleDailyHisries.meet_rate).toFixed(1) != "NaN" ? parseFloat(saleDailyHisries.meet_rate).toFixed(1) : "---" }}<span>％</span>
                      </h2>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>商談率</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">
                        {{ parseFloat(saleDailyHisries.deal_rate).toFixed(1) != "NaN" ? parseFloat(saleDailyHisries.deal_rate).toFixed(1) : "---" }}<span>％</span>
                      </h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>契約率</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">---<span>％</span></h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>1時間の平均ピンポン数</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">
                        {{ parseFloat(saleDailyHisries.ping_pong_num_one_hour).toFixed(1) != "NaN" ? parseFloat(saleDailyHisries.ping_pong_num_one_hour).toFixed(1) : "---" }}<span>件/時間</span>
                      </h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>アポの数</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">---<span>件</span></h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>稼働日数</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">
                        {{ parseFloat(saleDailyHisries.sale_time).toFixed(1) != "NaN" ? parseFloat(saleDailyHisries.sale_time).toFixed(1) : "---" }}<span>日</span>
                      </h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <loader :flag-show="flagShowLoader"></loader>
  </div>
</template>
<style scoped>
.is-active {
  color: #fff;
  background-color: #321fdb;
  border-color: #321fdb;
}
</style>>
  
<script>
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import axios from "axios";
import Loader from "./../../common/loader";


export default {
  components: { DatePicker,Loader },
  data() {
    return {
      time: [],
      saleDailyHisries: [],
      startDate: "",
      endDate: "",
      users: [],
      userId: null,
      valueSearch: null,
      data: [],
      flagShowLoader: false,
    };
  },
  props: ["urlGetData", "userResponse"],
  mounted() {
    var date = new Date(),
      y = date.getFullYear(),
      m = date.getMonth(),
      d = date.getDate();
    var startDate = new Date(y, m, d);
    var endDate = new Date(y, m, d);
    this.time = [startDate, endDate];
    var userIdSRHStorage = JSON.parse(localStorage.getItem('userIdSRHStorage'));
    userIdSRHStorage = userIdSRHStorage == null ? this.userResponse[0].id : userIdSRHStorage;
    this.userId = userIdSRHStorage;
    console.log(this.userId)
    localStorage.removeItem('userIdSRHStorage');
    this.getData();
    (this.users = this.userResponse), (this.valueSearch = 1);
  },
  methods: {
    getData() {
      let that = this;
      if( this.userId == null){
        this.userId = this.userResponse[0].id;
      }
      this.saleDailyHisries=[];
      this.flagShowLoader = true
      axios
        .post(this.urlGetData, {
          _token: Laravel.csrfToken,
          startDate: this.time[0],
          endDate: this.time[1],
        })
        .then(function (response) {
          that.data = response.data;
          for(let i = 0; i< response.data.length; i++) {
            if(that.userId == response.data[i].user_id) {
              that.saleDailyHisries = response.data[i]
            }
          }
          that.flagShowLoader = false
        })
        .catch((error) => {});
    },
    changeUserId(id) {
      this.userId = id;
      this.saleDailyHisries = []

      for(let i = 0; i< this.data.length; i++) {
            if(this.data[i].user_id === id) {
              this.saleDailyHisries = this.data[i]
            }
      }
    },
    changeDate(value) {
      this.valueSearch = value;
      this.time = []
      if (value != 0) {
        var date = new Date(),
          y = date.getFullYear(),
          m = date.getMonth(),
          d = date.getDate();
        var startDate = new Date(y, m, d - value + 1);
        var endDate = new Date(y, m, d);
        this.time = [startDate, endDate];
      }
    },
  },
};
</script>
