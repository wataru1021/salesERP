<template>
  <div class="container daily_report_complete">
    <div class="row content">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group row">
              <div class="col-md-12 mt-2">
                <h3 class="text-success text-center font-weight-bold">報告完了しました</h3>
              </div>
              <div class="col-md-12 text-center mt-3">
                <img src="/image/dailyReportComplete.png" class="w-25" />
              </div>
              <div class="col-md-12 mt-3">
                <p class="note-content">
                  以下報告内容に不備がないか再度ご確認し、変更が必要な場合は管理者までお問い合わせください。
                </p>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-5"><p>話した人の名前</p></div>
                  <div class="col-7 text-right">
                    <div class="h5 font-size-20">{{  data.appointee_name }}</div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-5"><p>話した人の立場</p></div>
                  <div class="col-7 text-right">
                    <div class="h5 font-size-20">{{ data.appointment_address }}</div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-5"><p>アポの日</p></div>
                  <div class="col-7 text-right">
                    <div class="h5 font-size-20">{{ data.appointment_date }}</div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-5"><p>時間帯</p></div>
                  <div class="col-7 text-right">
                    <div class="h5 font-size-20">{{ formatTime(data.appointment_time) }}</div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-5"><p>メモ</p></div>
                  <div class="col-7 text-right">
                    <div class="h5 font-size-20">{{ data.appointment_memo }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-12 text-center">
            <a v-bind:href="appointmentsIndexUrl"><span class="custom-color">アポイント管理</span></a>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-12 text-center">
            <a v-bind:href="topUrl"><span class="custom-color">TOPに戻る</span> </a>
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
  </div>
</template>

<script>
export default {
  created: function () {},
  data() {
    return {
      csrfToken: Laravel.csrfToken,
      saleDailyReport: {},
    };
  },
  props: ["data", "topUrl", "appointmentsIndexUrl"],
  mounted() {
    this.saleDailyReport = this.data;
  },
  methods: {
    formatTime(value) {
      return value.split(':')[0] + ':' + value.split(':')[1];
    },  
    
  },
};
</script>
