<template>
  <div class="container text-left">
    <div class="px-4 pt-4 pb-5">
      <div>
        <h1 class="text-primary font-weight-light">
          <strong class="font-weight-bold">yBank</strong>lite
          <sup style="font-size: 24px;">(beta)</sup>
        </h1>
      </div>
      <b-form class="text-left mt-4 pt-2">
        <h4 class="font-weight-normal mb-0">Sign In</h4>
        <p class="text-muted font-13">Please enter your Account ID</p>
        <b-form-group id="input-group-2">
          <b-form-input
            id="input"
            type="number"
            v-model="accountID"
            required
            placeholder="Account ID"
          ></b-form-input>
        </b-form-group>

        <b-button
          nuxt-link
          :to="'/accounts/' + accountID"
          variant="primary"
          class="font-weight-bold btn-block"
        >Login</b-button>
      </b-form>

      <p
        class="text-muted text-center mt-4"
        style="font-size: 13px;"
      >&copy; 2020 yBankLite, Inc. All rights reserved.</p>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from "vue";

export default Vue.extend({
  data() {
    return {
      accountID: 1 as number,
    };
  },
  components: {},
});
</script>

<style scoped>
.container {
  margin: 0 auto;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.title {
  font-family: "Quicksand", "Source Sans Pro", -apple-system, BlinkMacSystemFont,
    "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>
