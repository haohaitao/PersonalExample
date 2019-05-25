<template>
  <div>   
    <!-- 导航栏 -->
    <el-menu
    :default-active="$route.path"
    class="el-menu-demo"
    mode="vertical"
    @select="handleSelect"
    background-color="#545c64"
    text-color="#fff"
    router 
    active-text-color="#ffd04b">
<el-menu-item index="/">首页</el-menu-item>
<el-menu-item index="/sellcars">我要卖车</el-menu-item>
    <el-menu-item index="/buycars">我要买车</el-menu-item>
    <el-menu-item index="/recruit">我要招人</el-menu-item>
    <el-menu-item index="/job">我要求职</el-menu-item>
  </el-menu>
  <div class="line"></div>
  <!-- 轮播图 -->
  <el-carousel :interval="4000" type="card" height="500px">
    <el-carousel-item v-for="item in imagesList" :key="item.id">
      <h3 class="medium"><img :src="item.url" style="max-height: 500px; min-width: 960px;"></h3>
    </el-carousel-item>
  </el-carousel>
  <!-- 返回顶部 -->
  <BackTop></BackTop>
  <!-- 组件 -->
  <new-arrival :newData="new_arrival"></new-arrival>
  <home-footer></home-footer>
</div>
</template>

<script>
  import router from '@/router'
  import HomeHello from '@/pages/home/components/HelloWorld'
  import NewArrival from '@/pages/home/components/NewArrival'
  import HomeFooter from '@/pages/home/components/Footer'
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
    name: "Home",
    components: {
      HomeHello,
      NewArrival,
      HomeFooter
    },    
    data() {
      return {
        activeIndex: '1',
        activeIndex2: '1',
        id:'',
        times:'',
        list:[],
        new_arrival:[],//最新上架商家的数据
        imagesList:[
        {
          id: 10001,
          url: './././static/10001.jpg'
        },
        {
          id: 10002,
          url: './././static/10002.jpg'
        },
        {
          id: 10003,
          url: './././static/10003.jpg'
        },
        {
          id: 10004,
          url: './././static/10004.jpg'
        },
        {
          id: 10005,
          url: './././static/10005.jpg'
        },

        ]
      }
    },
    methods: {
        handleSelect(key, keyPath) {
          console.log(key, keyPath);
        },
        getHomeInfoSucc(res){
          console.log(res)
          this.tempData = res.data.data.list;
          if(res.data.cscode==0){
                      for(let i=0; i<this.tempData.length; i++){ //循环数组长度
            var times = timestampToTime(this.tempData[i].create_time);  //拿到时间，解析时间戳timestampToTime()方法
            this.tempData[i].create_time = times;  //将解析后的时间赋值给creat_time
            this.new_arrival.push(this.tempData[i])  //将最后数据存到arr数组
          }
          }
          else{
            let msg = res.data.msg
            this.open(msg)
          }

        },
        //消息提示,当axios获取不到数据的时候弹出提示
        open(msg) {
          this.$alert(msg, '警告', {
            confirmButtonText: '确定',
            callback: action => {
              this.$message({
                type: 'info',
                message: `action: ${ action }`
              })
            }
          })
        }
      },
      mounted(){
        this.$axios.post("/api/v1/AppHomepage/businesslist",{
          'pagenum': 12,   //每页多少条数据
          'start': 1     //页码
        }).then(this.getHomeInfoSucc).catch((error)=>{
          this.open(error)
        })   //接收数据
      }
 }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
/*轮播图*/
.el-carousel__item h3 {
    color: #475669;
    font-size: 14px;
    opacity: 0.75;
    line-height: 200px;
    margin: 0;
  }
  
  .el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
  }
  
  .el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
  }
</style>
