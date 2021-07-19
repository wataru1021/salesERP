<template>
  <div class="container daily_report_complete">
    <div class="row content">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="form-group row">
              <div class="col-md-9">
                <p class="header">{{ date }}({{ th }})の日報を</p>
              </div>
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
                  <div class="col-7"><p>ピンポン数（訪問件数）</p></div>
                  <div class="col-5 text-right">
                    <label class="h5">{{  saleDailyReport.ping_pong_num | format_number }}</label><span> 件</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-7"><p>対面数</p></div>
                  <div class="col-5 text-right">
                    <label class="h5">{{ saleDailyReport.meet_num | format_number }}</label><span> 件</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-7"><p>商談率</p></div>
                  <div class="col-5 text-right">
                    <label class="h5">{{ saleDailyReport.deal_num | format_number }}</label><span> 件</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-7"><p>獲得数</p></div>
                  <div class="col-5 text-right">
                    <label class="h5">{{ saleDailyReport.acquisitions_num | format_number }}</label><span> 件</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-7"><p>稼働時間</p></div>
                  <div class="col-5 text-right">
                    <label class="h5">{{ saleDailyReport.sale_time | format_decimal }}</label><span> 時間</span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <p>今日意識した点</p>
              </div>
              <div class="col-md-12">
                <h5>{{ saleDailyReport.conscious_point }}</h5>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-12 text-center">
            <a v-bind:href="saleManagementUrl">営業管理に戻る</a>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-md-12 text-center">
            <a v-bind:href="topUrl">TOPに戻る</a>
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
  </div>
</template>
<style scoped>
p,label,span {
  color: #7D8797;
}
h5 {
  color: #768192;
}
.header {
  color: #000000;
  font-size: 16px;
}
h3 {
  font-size: 24px !important;
}
.note-content {
  font-size: 12px;
}
</style>>
<script>
export default {
  created: function () {},
  data() {
    return {
      csrfToken: Laravel.csrfToken,
      saleDailyReport: {},
    };
  },
  props: ["data", "topUrl", "date", "th", "saleManagementUrl"],
  mounted() {
    this.saleDailyReport = this.data;
  },
  methods: {
    
  },
};
</script>