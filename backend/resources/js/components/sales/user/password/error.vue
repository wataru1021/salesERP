<template>
  <div class="container error-password ">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div>
            <div class="form-group row">
              <label
                class="col-md-3 col-form-label"
                for="ping_pong_num"
              ></label>
              <div class="col-md-9" v-if="messageText2">
                <h1>{{messageText2}}</h1>
              </div>
              <div class="col-md-9 text-center mt-4">
                <img src="/image/changePasswordError.png" class="w-10" />
              </div>
              <div class="col-md-9 text-center mt-4">
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
    return {
      messageText2: this.message2,
    };
  },
  props: ["formLogin", "message2"],
  mounted() {},
  methods: {},
};
</script>