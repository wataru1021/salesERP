<template>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="form-group row">
              <label
                class="col-md-3 col-form-label"
                for="ping_pong_num"
              ></label>
              <div class="col-md-9">
                <h5>2021年12月30日(土)の日報を</h5>
              </div>
              <div class="col-md-9">
                <h2 class="text-success text-center">報告完了しました</h2>
              </div>
              <div class="col-md-9 text-center mt-3">
                <img src="/assets/img/dailyReportComplete.png" class="w-25" />
              </div>
              <div class="col-md-9 mt-3">
                <p>
                  以下報告内容に不備がないか再度ご確認し、変更が必要な場合は管理者までお問い合わせください。
                </p>
              </div>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-6"><p>ピンポン数（訪問件数）</p></div>
                  <div class="col-6 text-right">
                    <p>{{ data.ping_pong_num }}件</p>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-6"><p>対面数</p></div>
                  <div class="col-6 text-right">
                    <p>{{ data.meet_num }}件</p>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-6"><p>商談数</p></div>
                  <div class="col-6 text-right">
                    <p>{{ data.deal_num }}件</p>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-6"><p>獲得数</p></div>
                  <div class="col-6 text-right">
                    <p>{{ data.acquisitions_num }}件</p>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="row">
                  <div class="col-6"><p>稼働時間</p></div>
                  <div class="col-6 text-right">
                    <p>{{ data.sale_time }}時間</p>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <p>今日意識した点</p>
              </div>
              <div class="col-md-9">
                <p>{{ data.conscious_point }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group row">
          <label class="col-md-3 col-form-label" for="input5"></label>
          <div class="col-md-9 text-center">
            <a href="">営業管理に戻る</a>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-3 col-form-label" for="input5"></label>
          <div class="col-md-9 text-center">
            <a v-bind:href="topUrl">TOPに戻る</a>
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
      data: this.data,
    };
  },
  props: ["data", "topUrl"],
  mounted() {
  },
  methods: {
    
  },
};
</script>