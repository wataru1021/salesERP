<template>
  <div class="container success-password">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card-group">
          <div class="card p-4">
            <div class="card-body">
              <h1>メール送信に失敗しました</h1>
              <div class="col-md-12 text-center mt-4">
                <img src="/image/changePasswordError.png" class="w-10" />
              </div>
              <div class="col-md-12 text-center mt-3">
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