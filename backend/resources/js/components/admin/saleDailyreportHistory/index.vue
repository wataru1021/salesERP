<template>
  <div class="container-fluid sale-daily-report-histories">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-1">
            <div class="card-body">
              <p>営業マン ※報告数順</p>
              <div>
                <button class="btn btn-primary">赤坂 次郎</button>
                <button class="btn btn-outline-primary">赤坂 次郎</button>
                <button class="btn btn-outline-primary">赤坂 次郎</button>
                <button class="btn btn-outline-primary">赤坂 次郎</button>
                <button class="btn btn-outline-primary">赤坂 次郎</button>
                <button class="btn btn-outline-primary">赤坂 次郎</button>
                <button class="btn btn-outline-primary">赤坂 次郎</button>
                <button class="btn btn-outline-primary">赤坂 次郎</button>
              </div>
            </div>
          </div>
          <div class="card mb-1">
            <div class="card-body">
              <p>簡易検索</p>
              <div>
                <button class="btn btn-outline-primary">今日</button>
                <button class="btn btn-outline-primary">昨日</button>
                <button class="btn btn-outline-primary">直近7日間</button>
                <button class="btn btn-outline-primary">直近30日間</button>
              </div>
              <p class="mt-2">期間で絞り込み</p>
              <div>
                <date-picker v-model="time" :format="'YYYY年MM月DD日'" range></date-picker>
              </div>
              <button class="btn btn-primary mt-2">検索</button>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <p class="mb-0">2020年6月14日～2021年6月30日</p>
            </div>
            <div class="card-body pt-2">
              <div class="row">
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>ピンポン数</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">{{ saleDailyHisries.ping_pong_num }}<span>件</span></h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>総獲得数</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">{{ saleDailyHisries.acquisitions_num }}<span>件</span></h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>成約率</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">11.2<span>％</span></h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>生産性</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">7.1<span>件/時間</span></h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>対面率</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">100<span>％</span></h2>
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
                      <h2 class="text-center">100<span>％</span></h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>契約率</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">100<span>％</span></h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>1時間の平均ピンポン数</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">100<span>件/時間</span></h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>アポの数</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">100<span>件</span></h2>
                    </div>
                  </div>
                </div>
                <div class="col card-item">
                  <div class="card">
                    <div class="card-header">
                      <p>稼働日数</p>
                    </div>
                    <div class="card-body">
                      <h2 class="text-center">100<span>日</span></h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import axios from "axios";

export default {
  components: { DatePicker },
  data() {
    return {
      time: [],
      saleDailyHisries: {},
      startDate:"",
      endDate: "",
    };
  },
  props: ["urlGetData"],
  mounted() {
    var date = new Date(),
      y = date.getFullYear(),
      m = date.getMonth(),
      d = date.getDate();
    var startDate = new Date(y, m - 1, d);
    var endDate = new Date(y, m, d);
    this.startDate = startDate;
    this.endDate = endDate;
    this.time = [this.startDate, this.endDate ];
    this.getData()
    console.log(this.endDate)
  },
  methods: {
    getData() {
      let that = this;
      axios
        .post(this.urlGetData, {
          _token: Laravel.csrfToken,
          startDate: this.startDate,
          endDate: this.endDate,
        })
        .then(function (response) {
            that.saleDailyHisries = response.data[0]
        })
        .catch(error => {});
    }
  }
};
</script>
