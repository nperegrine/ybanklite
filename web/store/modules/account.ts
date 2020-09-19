import { getterTree, mutationTree, actionTree } from "nuxt-typed-vuex";
import Account from "~/models/Account";

export const state = () => ({
  account: {} as Account,
  loading: true as boolean
});

export type AccountState = ReturnType<typeof state>;

export const getters = getterTree(state, {
  getAccount: state => state.account,
  getLoading: state => state.loading
});

export const mutations = mutationTree(state, {
  SET_ACCOUNT: (state: AccountState, account: Account) =>
    (state.account = account),
  RESET_ACCOUNT: (state: AccountState) => (state.account = {} as Account),
  SET_LOADING_FALSE: state => (state.loading = false)
});

export const actions = actionTree(
  { state, getters },
  {
    async fetchAccount({ commit }, { id }) {
      // reset account
      commit("RESET_ACCOUNT");
      try {
        const response = await this.$axios.$get(`/accounts/${id}`);

        commit("SET_ACCOUNT", response.item);
        commit("SET_LOADING_FALSE");
      } catch (e) {
        //
      }
    }
  }
);
