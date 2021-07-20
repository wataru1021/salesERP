<template>
  <div class="container-fluid sale-daily-report-histories">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-1 sale-name-list">
            <div class="card-body">
              <label>営業マン</label><span> ※報告数順</span>
              <div>
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
              <p class="mt-2 mb-2">指標で絞り込み</p>
              <div class="search-date-time">
                <date-picker
                  v-model="time"
                  :format="'YYYY年MM月DD日'"
                  @change = "changeDate(null)"
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
                {{ timeRequest[0] | formatDate }}～{{ timeRequest[1] | formatDate }}
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
                        {{ parseFloat(saleDailyHisries.contract_rate).toFixed(2) != "NaN" ? parseFloat(saleDailyHisries.contract_rate).toFixed(2)  : "---" }}<span>％</span>
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
                        {{ parseFloat(saleDailyHisries.productivity).toFixed(2) != "NaN" ? parseFloat(saleDailyHisries.productivity).toFixed(2) : "---" }}<span>件/時間</span>
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
                        {{ parseFloat(saleDailyHisries.meet_rate).toFixed(2) != "NaN" ? parseFloat(saleDailyHisries.meet_rate).toFixed(2) : "---" }}<span>％</span>
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
                        {{ parseFloat(saleDailyHisries.deal_rate).toFixed(2) != "NaN" ? parseFloat(saleDailyHisries.deal_rate).toFixed(2) : "---" }}<span>％</span>
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
                        {{ parseFloat(saleDailyHisries.ping_pong_num_one_hour).toFixed(2) != "NaN" ? parseFloat(saleDailyHisries.ping_pong_num_one_hour).toFixed(2) : "---" }}<span>件/時間</span>
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
                        {{ parseFloat(saleDailyHisries.sale_time).toFixed(2) != "NaN" ? parseFloat(saleDailyHisries.sale_time).toFixed(2) : "---" }}<span>日</span>
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
      timeRequest: [],
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
    var startDate = new Date(Date.UTC(y, m, d));
    var endDate = new Date(Date.UTC(y, m, d));
    this.time = [startDate, endDate];
    var userIdSRHStorage = JSON.parse(localStorage.getItem('userIdSRHStorage'));
    userIdSRHStorage = userIdSRHStorage == null ? this.userResponse[0].id : userIdSRHStorage;
    this.userId = userIdSRHStorage;
    localStorage.removeItem('userIdSRHStorage');
    this.getData();
    (this.users = this.userResponse), (this.changeDate(1));
    this.timeRequest = this.time
  },
  methods: {
    getData() {
      let that = this;
      if( this.userId == null){
        this.userId = this.userResponse[0].id;
      }
      if(this.time.length != 0) {
        this.time[0] = new Date(Date.UTC(this.time[0].getFullYear(), this.time[0].getMonth(), this.time[0].getDate()));
        this.time[1] = new Date(Date.UTC(this.time[1].getFullYear(), this.time[1].getMonth(), this.time[1].getDate()));
        this.timeRequest = this.time
        this.valueSearch = null 
      }
      
      this.saleDailyHisries=[];
      this.flagShowLoader = true
      axios
        .post(this.urlGetData, {
          _token: Laravel.csrfToken,
          startDate: this.timeRequest[0],
          endDate: this.timeRequest[1],
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
      if(value != null) {
        this.valueSearch = value;
        this.timeRequest = []
        if (value != 0) {
          var date = new Date(),
            y = date.getFullYear(),
            m = date.getMonth(),
            d = date.getDate();
          var startDate = new Date(Date.UTC(y, m, d - value + 1));
          var endDate = new Date(Date.UTC(y, m, d));
          if (value == 2)  endDate = new Date(Date.UTC(y, m, d - value + 1));
          this.timeRequest = [startDate, endDate];
          this.time = [];
        }
      } else {
        this.valueSearch = value;
      }
      
    },
  },
};
</script>
