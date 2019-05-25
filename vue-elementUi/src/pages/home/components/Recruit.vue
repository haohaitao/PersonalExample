<template>
  <div>
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
            <h1>我要招人页面</h1>
  <el-table
    :data="arr"
    border
    style="width: 43%;margin: 0 auto;"
    v-loading="loading"
    element-loading-text="拼命加载中"
    element-loading-spinner="el-icon-loading"
    element-loading-background="rgba(0, 0, 0, 0.8)"
    >
    <el-table-column fixed label="用户" width="100" prop="thum">
    <template slot-scope="scope">
        <img :src="scope.row.photo" class="head_pic"/>
    </template>
    </el-table-column>
    <el-table-column
      prop="name"
      label="发布者"
      width="150">
    </el-table-column>
    <el-table-column
      prop="create_time"
      label="日期"
      width="150">
    </el-table-column>
    <el-table-column
      prop="address"
      label="工作地点"
      width="300">
    </el-table-column>
    <el-table-column
      fixed="right"
      label="操作"
      width="100%">
      <template slot-scope="scope">
        <el-button type="text" @click="tableVisible(scope.row,scope.$index)" size="small">详情</el-button>
        <el-button type="text" size="small">编辑</el-button>
      </template>
    </el-table-column>
      <!-- -------------------------------点击查看打开表格 ------------------------ -->
      <el-dialog ref="test" title="用户信息" :visible.sync="dialogTableVisible" :append-to-body="true">  <!-- 添加append-to-body才会显示弹框 -->
          <el-table :data="dialogData">
            <el-table-column fixed label="用户" width="100" prop="thum">
                <template slot-scope="scope">
               <img :src="scope.row.photo" class="head_pic"/>
                </template>
           </el-table-column>
          <el-table-column property="create_time" label="日期" width="150">
            
          </el-table-column>
          <el-table-column property="phone" label="电话">
            
          </el-table-column>
          <el-table-column property="price" label="期望薪资">
            
          </el-table-column>
          </el-table>

          <div slot="footer" class="dialog-footer">
            <el-button @click="dialogTableVisible = false">取 消</el-button>
            <el-button type="primary" @click="dialogTableVisible = false">确 定</el-button>
          </div>
        </el-dialog>
</el-table>

        <!-- 分页 -->
        <el-pagination
        background
        layout="total,sizes,  prev, pager, next, jumper"
        :current-page="cur_page"
        :page-size="pageSize"
        :total="totalCount"
        @current-change="current_change"
        >
      </el-pagination>
     <sells-footer></sells-footer> 
  </div>
</template>

<script>
  import 'iview/dist/styles/iview.css'    // 使用 CSS
  import 'element-ui/lib/theme-chalk/index.css';
  import SellsFooter from '@/pages/home/components/Footer'
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
    name: "Recruit",
    components: {
      SellsFooter
    }, 
    data() {
      return {
        activeIndex: '1', //导航菜单
        activeIndex2: '1',//导航菜单
        pageNum:1,  //一共多少页
        totalCount:1, //总条数
        pageSize:10, //每页多少数据
        cur_page:1, //当前第几页
        arr:[],   //将接口返回的数据放在arr
        tableData: [], //用来中转数据，放到arr中
        dialogData:[], // dialog的数据
        dialogTableVisible: false, //默认dialog不显示
        loading: true   //请求的时候加载动画
      }
    },
    methods: {
      //监听导航菜单
      handleSelect(key, keyPath) {
        console.log(key, keyPath);
      },
      //监听分页改变事件
      current_change(currentPage){
        this.cur_page = currentPage;  //把改变后的页码赋值给cur_page
        this.loading = true
        this.getHomeInfo()    //改变页码后请求数据
      },

      //将行数据传过来
      tableVisible(row,index){
        //将拿到的当前行的值赋值给dialogData，判断长度，没有内容则push，有内容则清空再push
        if(this.dialogData.length == 0){
          this.dialogData.push(row)
        }else{
          this.dialogData = []
          this.dialogData.push(row)    
        }
        this.dialogTableVisible = true;  //显示dialog
      },

      handleClick(row) {
        console.log(row);
      },

      getHomeInfo() {
        //请求地址，带上参数 pagnum strt
        this.$axios.post("/api/v1/AppRecruit/select",{
          'pagenum': this.pageSize,   //每页多少条数据
          'start': this.cur_page     //页码
        }).then(this.getHomeInfoSucc).catch((error)=>{
          this.open(error)
        })   //接收数据
      },

      getHomeInfoSucc(res) {    //拿到数据
        if (res.data.cscode==0) {  //为0代表成功
          console.log(res)
          this.totalCount = res.data.count    //把一共多少条的数据赋值给分页的totalCount
          this.loading = false   //停止加载动画
          this.tableData = res.data.data  //赋值给tableDta
          this.arr = []  //清空上次的数据
          for(let i=0; i<this.tableData.length; i++){ //循环数组长度
            var times = timestampToTime(this.tableData[i].create_time);  //拿到时间，解析时间戳timestampToTime()方法
            this.tableData[i].create_time = times;  //将解析后的时间赋值给creat_time
            if(this.tableData[i].city_name == null || this.tableData[i].area_name == null){  //处理特殊情况，澳门，香港之类的只有省级
              this.tableData[i].city_name = '无'
              this.tableData[i].area_name = '无'
            }
            if(this.tableData[i].price == "-999.00") {
              this.tableData[i].price = "面议"
            }
            else{
              this.tableData[i].price += '元'
            }
            this.arr.push(this.tableData[i])  //将最后数据存到arr数组
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
    mounted() {
     this.getHomeInfo()
   }
 }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
html {
  font-size: 10px;
  margin: 0;
  padding: 0;
}
h1,
h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
.hello {
  background: #e4ba6d;
  border: 1px solid #50509a;
  color: #423118;
}
.head_pic{
    width: 3em;
    height: 3em;
}
</style>
