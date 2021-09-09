/*
 * @Description  :
 * @Author       : pacino
 * @Date         : 2021-09-08 17:25:08
 * @LastEditTime : 2021-09-09 17:39:32
 * @LastEditors  : pacino
 */
// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from "vue";
import App from "./App";
import router from "./router";
import "./assets/font/iconfont.css";

Vue.config.productionTip = false;

/* eslint-disable no-new */
new Vue({
  el: "#app",
  router,
  components: { App },
  template: "<App/>"
});
