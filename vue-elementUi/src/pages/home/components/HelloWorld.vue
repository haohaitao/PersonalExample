<template>
  <Card style="width:350px; margin:0 auto; display: none;">
    <a href="#" @click="btnChange">
      <Icon type="ios-loop-strong"></Icon>
      <Button type="error">删除</Button>
    </a>
    <p slot="title">
      我要卖车
    </p>
<a href="#" slot="extra" @click="change" class="state">
      <Icon type="ios-loop-strong"></Icon>
      <Button type="info">显示</Button>
    </a> 
    <p><span style="float:left; margin-left: 1.5rem; display: inline;">详情</span>
      <span style="float:right; margin-right: 1.5rem; display: inline;">价格</span>
    </p>
    <ul v-for="item in listData"> 
      <li>
        <div class="shadow"></div>
        <div class="content">
          <img :src="item.thum">
          <div>
            <div class="odd">
              <p>求购:</p>
              <span>{{item.machine_name}}</span>
            </div>
          </div>
          <div class="info">
            <span>电话：{{item.phone}}</span>
            <span style="margin-left: 0.2rem">时间：{{item.create_time}}</span>
          </div>
          <span class="pri">{{item.price}}</span>
          <div
          class="address11"
          >地区：{{item.province_name}}{{item.city_name!=null?"-"+item.city_name:""}}{{item.area_name!=null?"-"+item.area_name:""}}</div>
        </div>
      </li>
          <!-- <li v-show="item.area_name!=null">区域：{{item.province_name}}{{'-'+item.city_name}}{{'-'+item.area_name}}</li>
            <li v-show="item.area_name==null">区域：{{item.province_name}}</li> -->
          </ul>
          <Page size="small" style="margin-top: 2rem" :total="pageTotal" :page-size="pagenum" show-elevator show-total @on-change="handlePage"></Page>
        </Card>
      </template>

<script>
import axios from "axios";
import $ from 'jquery'
function timestampToTime(timestamp) {
  var date = new Date(timestamp * 1000); //时间戳为10位需*1000，时间戳为13位的话不需乘1000
  var Y = date.getFullYear() + "-";
  var M = (date.getMonth() + 1 < 10 ? "0" + (date.getMonth() + 1) : date.getMonth() + 1) + "-"
  var D = date.getDate() < 10 ? "0" + date.getDate() : date.getDate() + " "
  var h = date.getHours() < 10 ? "0" + date.getHours() + ":" : date.getHours() + ":"
  var m = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes()

  return Y + M + D + h + m;
}
export default {
  name: "HelloWorld",
  data() {
    return {
      result:{},
      province_name:'',
      city_name:'',
      area_name:'',
      arr:[],
      listData:[],
      id: "",
      msg: "Welcome to Your Vue.js App",
      hitokoto: "",
      sum:"",
      created_at:'',
      pageTotal: 0,//一共多少条数据
      pagenum: 10,    //默认页面条数的数量
      start: 1,  //第几页
      msg:{},  //错误消息
      nowPage:'',//当前页
    }
  },
  methods: {
    handlePage(curpage) {
      this.getRequest(curpage)
      this.pageChangeSuccess(curpage)
      this.listData = this.arr.splice(0,this.arr.length)
      console.log(this.start)
      console.log(this.listData)
    },
    // 发送axios请求
    getRequest(curpage) {
      let _start = curpage
      this.$axios.post("/syd/api/v1/AppSellCar/car_search",
      {
        'pagenum': this.pagenum,
        'start': _start
      })
      .then((this.getRequestResult))
    },
      //把拿到的数据赋值给result
      getRequestResult(res) {
        if (res.data.cscode==0) { //0是成功的代码
          this.result = res.data  //将获取到的数据赋值给result，数据的格式是 res.data.data.list
          this.pageTotal = this.result.data.count   //所有数据条数的和
          for(let i =0; i<this.result.data.list.length; i++){  //循环获取到的数据长度存在arr中
            var times = timestampToTime(this.result.data.list[i].create_time);  //解析时间戳为时间
            this.result.data.list[i].create_time = times;  //将解析后的时间赋值给create_time
            this.arr.push(this.result.data.list[i]);   //将获取到的数据存到arr
          }
          if(this.start < Math.round(this.result.data.count/this.pagenum)){ //Math.round向上取整，判断当前页码数是否小于总数
              this.start+=1
              this.success(true)
            }
            else if(Math.round(this.result.data.count/this.pagenum) == this.start){
            this.page_error(true)
          }
          }
        else{
          this.msg = res.data.msg
          this.confirm()
        }
      },
      //点击change事件发送一个请求
    change: function(){
      this.getRequest()
      $(".state").css("display","none");
    },

    btnChange: function(){
      if(this.arr.length>0){
        this.arr = [];
        this.listData = [];
        this.pageTotal = 0;
        this.start = 1;
        $(".state").css("display","block");
        this.delete_success (true)
      }
      else{
        this.error(true);
      }
    },
    //获取数据失败弹出对话框
    confirm () {
                this.$Modal.confirm({
                    title: '提示',
                    content: this.msg,
                });
            },
    page_error (nodesc) {
      this.$Notice.error({
        title: '数据已全部加载！',
      })
    },
    success (nodesc) {
      this.$Notice.success({
        title: '获取数据成功',
      })
    },
    delete_success (nodesc) {
      this.$Notice.success({
        title: '删除成功',
      })
    },
    error (nodesc) {
      this.$Notice.error({
        title: '没有数据的时候，请不要乱点！',
      })
    },
    //打印当前页数和页面总数的提示
    pageChangeSuccess (curpage) {
      this.$Message.success("当前页"+curpage)
    },
  },
  mounted() {
    // $(".state").css("display","none");
    // this.getRequest()
    // this.getHomeInfo();
    // this.created_at = timestampToTime(this.times);
    //this.getRequest();
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
html{
  font-size: 10px;
  margin: 0;
  padding: 0;
}
.shadow {
  height: 0.05rem;
  background: #f4f4f4;
}

.content {
  height: 0.78rem;
  margin-left: 0.14rem;
  margin-top: 1.98rem;
  margin-right: 0.13rem;
  position: relative;
}

.content img {
  width: 1.5rem;
  height: 1.5rem;
  float: left;
  margin-right: 0.15rem;
  border-radius: 0.05rem;
}

.odd {
  height: 0.8rem;
  line-height: 0.8rem;
}

.odd p,
.odd span {
  float: left;
  font-size: 0.14rem;
  text-align: left;
}

.odd span {
  width: 2.2rem;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.info span {
  margin-right: 0.1rem;
  float: left;
  font-size: 0.13rem;
  margin-top: 0.8rem;
}

.pri {
  position: absolute;
  bottom: 0rem;
  right: 0.1rem;
  font-weight: 900;
  color: #ff4949;
}

.address11 {
  position: absolute;
  font-size: 0.14rem;
  left: 1.8rem;
}

ul li{
  height:3rem;
  list-style-type: none; 
}

</style>
