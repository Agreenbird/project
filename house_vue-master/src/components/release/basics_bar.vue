<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 title">
        <router-link to="/" class="a_text">
        <span class="logo">
          爱彼迎
        </span>

        </router-link>


      </div>
      <div class="col-md-9 title">{{msg_title}}</div>
    </div>
  </div>
</template>

<script>
  export default ({
    name: 'basics_bar',
    props: ['msg_title']
  })


</script>


<style lang="scss" scoped>
  .title {
    margin: 15px 0;
  }

  .logo {
  margin-left: 30px;
    color: #409EFF;
    text-decoration: none;
  }
  a{
    text-decoration: none;
  }
</style>
