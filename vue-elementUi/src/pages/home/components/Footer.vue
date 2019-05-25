<template>
  <div class="footer_wrapper">
    {{msg}}
    <p>2019 © <a title="电子邮件" target="_blank">联系方式</a> | <a title="订阅" target="_blank">邮件订阅</a></p>
  </div>
</template>

<script>
export default {
  name: 'Footer',
  data () {
    return {
      msg: '我是页脚'
    }
  }
}
</script>

<style scoped>
.footer_wrapper {
  clear: left;
  background-color: rgb(84, 92, 100);
  padding:1em;
  background-color: rgb(84, 92, 100);
  color: rgb(255, 255, 255);
}
</style>
