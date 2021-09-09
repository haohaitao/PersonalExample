<!--
 * @Description  : 
 * @Author       : pacino
 * @Date         : 2021-09-08 17:25:08
 * @LastEditTime : 2021-09-09 17:38:22
 * @LastEditors  : pacino
-->
<template>
  <div id="app">
    <router-view />
  </div>
</template>

<script>
export default {
  name: "App"
};
</script>

<style>
@media screen and (max-width: 420px) {
  /* 显示悬浮球 */
  .circle-wrapper {
    display: block !important;
  }
}

@media screen and (min-width: 420px) {
  /* 显示悬浮球 */
  .circle-wrapper {
    display: none !important;
  }
}
</style>
