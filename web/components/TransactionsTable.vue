<template>
  <div>
    <div class="container card p-4 mt-4" v-if="loading">
      <div class="d-flex align-items-center">
        <span>Loading transactions...</span>
        <div class="spinner-border ml-auto text-primary" role="status" aria-hidden="true"></div>
      </div>
    </div>
    <b-card class="mt-3" v-if="!loading">
      <div>
        <h4 class="font-weight-light mb-1">Payment History</h4>
        <p class="text-muted">See your payment and transaction history below</p>
      </div>
      <b-table striped hover :items="transactions"></b-table>
    </b-card>
  </div>
</template>

<script lang="ts">
import Vue, { PropOptions } from "vue";

export default Vue.extend({
  name: "TransactionsTable",
  /**
   * Dynamic computed properties for transactions
   */
  computed: {
    transactions() {
      return this.$accessor.modules.transactions.getTransactions;
    },
    loading() {
      return this.$accessor.modules.transactions.getLoading;
    },
  },
  async mounted() {
    /**
     * Dispatch fetchTransactions action
     */
    await this.$accessor.modules.transactions.fetchTransactions({
      id: +this.$route.params.id as number,
    });
  },
});
</script>