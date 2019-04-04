import Vue from "vue";
import Agenda from "./Agenda.vue";
import store from "./store";

Vue.config.productionTip = false;

new Vue({
  store,
  render: h => h(Agenda)
}).$mount("#Agenda");
