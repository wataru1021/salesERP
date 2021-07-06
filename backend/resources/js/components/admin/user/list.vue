<template>
  <div class="container-fluid">
    <div class="fade-in">
      <div class="col-lg-12">
        <div class="">
          <div class="cd-table-responsive">
            <data-table
              :columns="columns"
              :url="urlGetData"
              :translate="translate"
            >
              <span slot="filters"> </span>
              <tbody slot="body" slot-scope="{ data }">
                <tr :key="item.id" v-for="item in data">
                  <td :key="column.name" v-for="column in columns">
                    <data-table-cell
                      :value="item"
                      :name="column.name"
                      :meta="column.meta"
                      :comp="column.component"
                      :classes="column.classes"
                    >
                    </data-table-cell>
                    <slot v-if="column.name == 'action'">
                      <button
                        class="btn btn-danger"
                        @click="handleDelete(item.id)"
                      >
                        削除
                      </button>
                    </slot>
                  </td>
                </tr>
              </tbody>
            </data-table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style >
.cd-table-responsive .flex.mb-3 {
  display: none;
}
</style>
<script>
import axios from "axios";
export default {
  created: function () {},
  data() {
    return {
      csrfToken: Laravel.csrfToken,
      urlGetData: this.data.urlGetData,
      columns: [
        { label: "アカウント名", name: "name", orderable: true },
        { label: "メールアドレス", name: "email", orderable: true },
        { label: "登録日時", name: "created_at_format", orderable: true },
        { label: "", name: "action" },
      ],
      filters: {},
      translate: { nextButton: ">", previousButton: "<" },
      pagination: { data: {}, hideWhenEmpty: true },
      classes: {
        "table-container": {
          "table-responsive": true,
        },
        table: {
          table: true,
          "table-striped": true,
          "table-bordered": true,
          "table-borderless": true,
        },
        "t-head": {},
        "t-body": {},
        "t-head-tr": {},
        "t-body-tr": {},
        td: {},
        th: {},
      },
    };
  },
  props: ["data"],
  mounted() {},
  methods: {
    handleDelete(id) {
      axios
        .get("users/" + id + "/delete")
        .then((response) => {
          window.location.reload();
        })
        .catch((error) => {});
    },
  },
  created() {},
};
</script>

