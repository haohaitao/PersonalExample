// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import iView from 'iview'
import 'iview/dist/styles/iview.css'    // 使用 CSS
import axios from "axios";
import $ from 'jquery'
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.prototype.$axios = axios //将axios挂载在Vue实例原型上

// 设置axios请求的token
axios.defaults.headers.common['token'] = '*********************'
//设置请求头
axios.defaults.headers.post["Content-type"] = "application/json"

Vue.use(iView) 
Vue.use(ElementUI) 

Vue.config.productionTip = false
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
