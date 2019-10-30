import Vue from "vue";
import Agenda from "./Agenda.vue";
import Modal from "./components/Modal.vue";
import store from "./store";
import jQuery from "jquery";
import Moment from "vue-moment";
import FullCalendar from "vue-full-calendar";
import "./assets/tailwind.css";
import Axios from "axios"

Vue.config.productionTip = false;
Vue.use(FullCalendar);

Vue.prototype.$http = Axios;

if(process.env.NODE_ENV != 'production') {
  Vue.prototype.BASE_URL = "http://localhost:8080/"
} else  {
  Vue.prototype.BASE_URL = "/newtech/";
}

new Vue({
  store,
  render: h => h(Agenda)
}).$mount("#Agenda");
