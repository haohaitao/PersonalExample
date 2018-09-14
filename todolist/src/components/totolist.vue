<template>
  <div id="app">
      <h1>计划表</h1>
      <div>
        待办事项:<input type="text" v-model="newPerson.name"/>
        <button  @click="createPerson">新增</button>
      </div>
    <div id="n">
      <table>
        <thead>
        <tr>
          <th width="25%">ID</th>
          <th width="30%">待办事项</th>
          <th width="15%">操作</th>
        </tr>
        </thead>
        <tbody id="t">
        <tr v-for="(person,index) in people">
          <td :class="'content'">{{ index+1 }}</td>
          <td :class="'content'">{{ person.name }}</td>
          <td :class="'content'"><button @click="deletePerson(index)">完成</button></td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script type="text/ecmascript-6">
export default {
  name: 'todolist',
  data () {
    return {
      newPerson: {
        name: '22.30吃夜宵'
      },
      people: []
    }
  },
  methods: {
    createPerson: function () {
      if (this.newPerson.name.length === 0) {
        this.$message.error('错了哦，你还没有输入文字~')
        return false
      }
      else {
        this.people.push(this.newPerson)
      }
      // console.log(this.newPerson.name.length) content长度
      // 添加完newPerson对象后，重置newPerson对象
      this.newPerson = {name: ''}
      var a = document.getElementById('n')
      a.style.display = 'block'
    },
    deletePerson: function (index) {
      // 删一个数组元素
      this.people.splice(index, 1)
      console.log('删除的ID：' + index)
      var tdnode = document.getElementById('t').childNodes
      if (tdnode.length === 1) {
        var a = document.getElementById('n')
        a.style.display = 'none'
      }
      // console.log("tr长度："+tdnode.length) tbody中tr的长度
    }
  }
}
</script>
<style scoped>
h1{
  color: white;
  background-color: #3d85c6;
}
  table,
  td,
  th {
    border-collapse: collapse;
    border-spacing: 0
  }
  #n{
    display: none;
  }
  table {
    margin: 0 auto;
    width: 50%;
  }

  td,
  th {
    border: 1px solid #bcbcbc;
    padding: 5px 10px
  }

  th {
    background: #3d85c6;
    font-size: 1.2rem;
    font-weight: 400;
    color: #fff;
    cursor: pointer
  }

  tr:nth-of-type(odd) {
    background: #fff
  }

  tr:nth-of-type(even) {
    background: #eee
  }

  input {
    outline: none
  }

  input[type=text] {
    margin: 6px;
    border: 1px solid #ccc;
    padding: .5rem .3rem;
  }

  input[type=text]:focus {
    border-color: #42b983;
  }

  button {
    outline: none;
    padding: 5px 8px;
    color: #fff;
    border: 1px solid #BCBCBC;
    border-radius: 3px;
    background-color: #3d85c6;
    cursor: pointer;
  }
  button:hover{
    opacity: 0.8;
  }
</style>
