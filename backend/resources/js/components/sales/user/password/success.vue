<template>
  <div class="container success-password">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div>
            <div class="form-group row">
              <div class="col-md-9 col-lg-12">
                <h2 class="mg-left-20">リセット完了</h2>
              </div>
              <div class="col-md-9 col-lg-12 text-center mt-4">
                <img src="/image/changePasswordComplete.png" class="w-23" />
              </div>
              <div class="col-md-9 col-lg-12 text-center mt-4">
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