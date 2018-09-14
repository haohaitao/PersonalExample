<template>
  <div id="app">
    <todolist></todolist>
  </div>
</template>

<script>
import todolist from './components/totolist.vue'

export default {
  name: 'App',
  components: {
    todolist
  }
}
</script>

<style>
* {
    margin: 0;
    padding: 0;
}
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>
