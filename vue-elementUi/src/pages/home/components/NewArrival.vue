<template>
  <div class="new_wrapper">
    <h1>{{ msg }}</h1>
    <!-- 卡片组件 -->
    <div class="card_wraper">
    <el-card class="box-card" v-for="item in newData">
      <div slot="header" class="clearfix">
        <span style="font-weight: bold;">商铺：{{item.shop_name}}</span>
        <el-button style="float: right; padding: 3px 0; background: #fa2020; color: #ffffff; " disabled type="text">最新上架商家</el-button>
      </div>
      <div class="text item">
        <p><img :src="item.thum_logo" class="card_img"></p>
        <span>{{item.create_time}}</span>
        <span><i class="el-icon-location"></i>{{item.province_name}}</span>
      </div>
    </el-card>
  </div>
    <!-- 卡片组件 -->
  </div>
</template>

<script>
export default {
  name: 'NewArrival',
  props:{
    newData: Array
  },
  data () {
    return {
      msg: '最新上架商家'
    }
  }
}
</script>

<style scoped>
/*card组件*/
  .text {
    font-size: 14px;
  }

  .item {
    margin-bottom: 18px;
  }

  .clearfix:before,
  .clearfix:after {
    display: table;
    content: "";
  }
  .clearfix:after {
    clear: both
  }

  .box-card {
    width: 460px;
    margin: 7px;
    float: left;
  }
  .card_wraper {
    margin-top: 2em
  }
  .card_img {
    height: 90%;
    max-height: 259px;
  }
</style>
