<template>
  <div class="container success-password">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
              <h1>リセット完了</h1>
              <div class="col-md-12 text-center mt-5">
                <img src="/image/changePasswordComplete.png" class="w-23" />
              </div>
              <div class="col-md-12 text-center mt-3">
                <a v-bind:href="formLogin" class="btn btn-link px-0 mt-3 custom-color"
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
