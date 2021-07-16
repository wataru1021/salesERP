<template>
  <div class="container success-email">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
              <h1>電子メールを正常に送信</h1>
              <div class="col-md-12 text-center mt-5">
                <img src="/image/changePasswordComplete.png" class="w-23" />
              </div>
              <div class="col-md-12 text-center mt-4">
                <a v-bind:href="formLogin" class="btn btn-link px-0 mt-3"
                  >ログイン画面へ</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
  
  <script>
export default {
  created: function () {},
  data() {
    return {};
  },
  props: ["formLogin"],
  mounted() {},
  methods: {},
};
</script>