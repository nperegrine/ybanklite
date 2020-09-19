import { getAccessorType, mutationTree } from "nuxt-typed-vuex";

import * as account from "~/store/modules/account";
import * as transactions from "~/store/modules/transactions";

export const state = () => ({
  payment_form_visible: false as boolean
});

export type RootState = ReturnType<typeof state>;

export const getters = {
  payment_form_visible: (state: RootState) => state.payment_form_visible
};

export const mutations = mutationTree(state, {
  TOGGLE_PAYMENT_FORM_VISIBILITY: state =>
    (state.payment_form_visible = !state.payment_form_visible)
});

// This compiles to nothing and only serves to return the correct type of the accessor
export const accessorType = getAccessorType({
  state,
  getters,
  mutations,
  modules: {
    account,
    transactions
  }
});
