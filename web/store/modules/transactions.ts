import { getterTree, mutationTree, actionTree } from "nuxt-typed-vuex";

import Transaction from "~/models/Transaction";

export const state = () => ({
  transactions: [] as Array<Transaction>,
  loading: true as boolean
});

export type TransactionsState = ReturnType<typeof state>;

export const getters = getterTree(state, {
  getTransactions: state => state.transactions,
  getLoading: state => state.loading
});

export const mutations = mutationTree(state, {
  SET_TRANSACTIONS(state, transactions: Array<Transaction>) {
    state.transactions = transactions;
  },
  SET_LOADING_FALSE: state => (state.loading = false)
});

export const actions = actionTree(
  { state, getters },
  {
    async fetchTransactions({ commit, rootState }, { id }) {
      try {
        const response = await this.$axios.$get(`/accounts/${id}/transactions`);

        let transactions = response.items;

        /**
         * Format transaction currency
         */
        for (let i = 0; i < transactions.length; i++) {
          transactions[i].amount =
            (rootState.modules.account.account.currency === "usd" ? "$" : "€") +
            transactions[i].amount;

          if (rootState.modules.account.account.id != transactions[i].to) {
            transactions[i].amount = "-" + transactions[i].amount;
          }
        }

        commit("SET_TRANSACTIONS", transactions);
        commit("SET_LOADING_FALSE");
      } catch (e) {
        //
      }
    },
    async submitTransaction({ commit }, { payment }) {
      try {
        await this.$axios.$post("/transactions", payment);
      } catch (e) {
        //
      }
    }
  }
);
