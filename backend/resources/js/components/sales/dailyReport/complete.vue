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
                <img src="/image/changePasswordComplete.png" class="w-25" />
              </div>
              <div class="col-md-12 mt-3">
                <p>
                  以下報告内容に不備がないか再度ご確認し、変更が必要な場合は管理者までお問い合わせください。
                </p>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-8"><p>ピンポン数（訪問件数）</p></div>
                  <div class="col-4 text-right">
                    <p>{{ saleDailyReport.ping_pong_num }}件</p>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-8"><p>対面数</p></div>
                  <div class="col-4 text-right">
                    <p>{{ saleDailyReport.meet_num }}件</p>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-8"><p>商談数</p></div>
                  <div class="col-4 text-right">
                    <p>{{ saleDailyReport.deal_num }}件</p>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-8"><p>獲得数</p></div>
                  <div class="col-4 text-right">
                    <p>{{ saleDailyReport.acquisitions_num }}件</p>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-8"><p>稼働時間</p></div>
                  <div class="col-4 text-right">
                    <p>{{ saleDailyReport.sale_time }}時間</p>
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
p {
  color: #7D8797;
}
h5 {
  color: #768192;
}
.header {
  color: #000000;
  font-size: 16px;
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