import axios from 'axios';
import router from '@/router';

// axios 配置
axios.defaults.timeout = 8000;
axios.defaults.baseURL = 'https://jx-api.sanyeda.com/api/v1/AppSellCar/car_search';
const token = '65dd56a9e5f72e11a6557fcef08daf9e'

// http request 拦截器
axios.interceptors.request.use(
  config => {
   
      config.headers.Authorization = token;  //将token设置成请求头
      
      return config;
    },
    err => {
      return Promise.reject(err);
    }
    );

// http response 拦截器
axios.interceptors.response.use(
  response => {
    if (response.data.errno === 999) {
      router.replace('/');
      console.log("token过期");
    }
    return response;
  },
  error => {
    return Promise.reject(error);
  }
  );
export default axios;