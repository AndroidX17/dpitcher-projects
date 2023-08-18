// sharedState.js
import { reactive } from 'vue';

const state = reactive({
  userBalance: 0,
  userId: null,
  purchasedItems: [],
});

export default state;
