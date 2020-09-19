<template>
  <div class="container">
    <div class="pt-4 pb-2">
      <h2 class="font-weight-light text-primary">
        <strong class="font-weight-bold">yBank</strong>lite - The Leading Email Marketing Bank
      </h2>
    </div>

    <!-- begin::account card -->
    <AccountCard />
    <!-- end::account card -->

    <!-- begin::payment form -->
    <div v-show="show">
      <PaymentForm />
    </div>
    <!-- end::payment form -->

    <!-- begin::transactions table(payment history) -->
    <TransactionsTable />
    <!-- end::transactions table -->

    <!-- begin::footer -->
    <p
      class="text-muted text-center mt-4"
      style="font-size: 13px;"
    >&copy; 2020 yBankLite, Inc. All rights reserved.</p>
    <!-- end::footer -->
  </div>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({
  data() {
    return {
      show: false as boolean,
    };
  },
});
</script>
