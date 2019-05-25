<template>
  <div>
    <h1>我是首页</h1>
    <p>{{msg}}</p>
    <home-hello></home-hello>
    <sell-cars></sell-cars>
  </div>
</template>

<script>
  import HomeHello from '@/pages/home/components/HelloWorld'
  import sellCars from '@/pages/home/components/sellCars'
  export default {
    name: "Home",
    components: {
      HomeHello,
      sellCars
    },    
    data() {
      return {
        id:'',
        times:'',
        list:[],
        msg: "Welcome to Your Vue.js App"
      }
    }
 }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
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
</style>
