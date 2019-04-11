import Vue from "vue";
import Agenda from "./Agenda.vue";
import Modal from "./components/Modal.vue";
import store from "./store";
import jQuery from "jquery";
import Moment from "vue-moment";
import FullCalendar from "vue-full-calendar";

Vue.config.productionTip = false;
Vue.use(FullCalendar);

new Vue({
  store,
  render: h => h(Agenda)
}).$mount("#Agenda");
