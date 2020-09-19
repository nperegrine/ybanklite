<template>
  <div>
    <div class="container card p-4 mt-4" v-if="loading">
      <div class="d-flex align-items-center">
        <span>Loading account...</span>
        <div class="spinner-border ml-auto text-primary" role="status" aria-hidden="true"></div>
      </div>
    </div>
    <b-card class="mt-3" v-if="!loading">
      <div>
        <h4 class="font-weight-light mb-1">Welcome, {{ account.name }}!</h4>
        <p class="text-muted">Manage your yBank account intuitively from here</p>
      </div>
      <hr />
      <b-card-text>
        <div>
          Account:
          <code>{{ account.name }}</code>
        </div>
        <div>
          Account Number:
          <code>{{ account.id }}</code>
        </div>
        <div>
          Balance:
          <code>
            {{ account.currency === "usd" ? "$" : "€"
            }}{{ account.balance }}
          </code>
        </div>
      </b-card-text>

      <div class="mt-5">
        <b-button size="sm" variant="primary" @click="toggleShow" class="font-weight-bold px-4">
          <svg
            width="1em"
            height="1em"
            viewBox="0 0 16 16"
            class="mr-2 mb-1"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"
            />
          </svg> New payment
        </b-button>

        <b-button
          class="font-weight-bold float-right px-4"
          variant="danger"
          size="sm"
          nuxt-link
          to="/"
        >
          <svg
            width="1em"
            height="1em"
            viewBox="0 0 16 16"
            class="bi bi-box-arrow-in-left mb-1 mr-2"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              fill-rule="evenodd"
              d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"
            />
            <path
              fill-rule="evenodd"
              d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"
            />
          </svg>
          Logout
        </b-button>
      </div>
    </b-card>
  </div>
</template>

<script lang="ts">
import Vue, { PropOptions } from "vue";

export default Vue.extend({
  name: "AccountCard",
  /**
   * Dynamic computed properties for account
   */
  computed: {
    account() {
      return this.$accessor.modules.account.getAccount;
    },
    loading() {
      return this.$accessor.modules.account.getLoading;
    },
  },
  /**
   * Fetch account by dispatching fetchAccount vuex acction
   */
  async mounted() {
    await this.$accessor.modules.account.fetchAccount({
      id: +this.$route.params.id as number,
    });

    if (Object.keys(this.account).length === 0) {
      this.$router.push("/");
    }
  },
  methods: {
    /**
     * Toggle the show data property in parent component
     */
    toggleShow() {
      this.$parent.$data.show = !this.$parent.$data.show;
    },
  },
});
</script>