<template>
  <b-card class="mt-3">
    <div class="py-2 mb-2">
      <h5 class="font-weight-bold mb-1">Make payment</h5>
      <p class="text-muted">Fill the form below to send a new payment</p>
    </div>
    <b-form @submit.prevent="onSubmit">
      <b-form-group
        id="input-group-1"
        label-cols-lg="2"
        label="Receiver's Account ID:"
        label-for="input-1"
      >
        <b-form-input
          id="input-1"
          size="sm"
          v-model="payment.to"
          type="number"
          required
          placeholder="Destination ID"
        ></b-form-input>
      </b-form-group>

      <b-form-group
        id="input-group-2"
        label-cols-lg="2"
        label="Payment Amount:"
        label-for="input-2"
      >
        <b-input-group prepend="$" size="sm">
          <b-form-input
            id="input-2"
            v-model="payment.amount"
            type="number"
            required
            placeholder="Amount"
          ></b-form-input>
        </b-input-group>
      </b-form-group>

      <b-form-group id="input-group-3" label-cols-lg="2" label="Details:" label-for="input-3">
        <b-form-input
          id="input-3"
          size="sm"
          v-model="payment.details"
          required
          placeholder="Payment details"
        ></b-form-input>
      </b-form-group>

      <b-button type="submit" size="sm" variant="primary" class="font-weight-bold mt-4 px-5">Send</b-button>
    </b-form>
  </b-card>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({
  data() {
    return {
      payment: {} as object,
      account_id: null as any,
    };
  },
  methods: {
    async onSubmit() {
      this.account_id = this.$route.params.id;

      /**
       * Add "from" account to payment post payload
       */
      this.payment.from = this.account_id;

      /**
       * Dispatch submitTransaction action
       */
      await this.$accessor.modules.transactions.submitTransaction({
        payment: this.payment,
      });

      /**
       *  Re-initialise and hide payment form
       */
      this.payment = {};
      this.$parent.$data.show = false;

      /**
       * Fetch and update account data and transactions data
       */
      this.$accessor.modules.account.fetchAccount({ id: this.account_id });
      this.$accessor.modules.transactions.fetchTransactions({
        id: this.account_id,
      });
    },
  },
});
</script>