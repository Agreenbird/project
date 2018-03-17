<template>
  <div>
    <el-container>
      <el-header>
        <nav_title></nav_title>


      </el-header>
      <el-container>
        <el-aside width="200px">

          <el-menu
            default-active="1"
            class="el-menu-vertical-demo"
          >


            <el-submenu index="1">
              <template slot="title">
                <i class="el-icon-location"></i>
                <span>房源管理</span>
              </template>
              <el-menu-item-group>
                <router-link to="/admin/home/house_audit" class="a_text">
                  <el-menu-item index="1-1">房源审核</el-menu-item>
                </router-link>
                <el-menu-item index="1-2">预定信息</el-menu-item>
              </el-menu-item-group>
              <el-menu-item index="1-3">房源管理</el-menu-item>
            </el-submenu>


            <el-submenu index="2">
              <template slot="title">
                <i class="el-icon-menu"></i>
                <span>用户管理</span>
              </template>
              <el-menu-item-group>
                <el-menu-item index="1-1">查看用户</el-menu-item>
                <el-menu-item index="1-2">更改权限</el-menu-item>
                <el-menu-item index="1-3">封号和警告</el-menu-item>
              </el-menu-item-group>
            </el-submenu>


            <el-submenu index="3">
              <template slot="title">
                <i class="el-icon-setting"></i>
                <span>网站信息管理</span>
              </template>
              <el-menu-item-group>
                <el-menu-item index="1-1">网站留言</el-menu-item>
                <el-menu-item index="1-2">房东留言</el-menu-item>
              </el-menu-item-group>
            </el-submenu>
          </el-menu>
        </el-aside>
        <el-main>
          <router-view>
          </router-view>
        </el-main>
      </el-container>
    </el-container>


  </div>
</template>


<script>
  import nav_title from '../nav'

  export default ({
    name: 'admin_home',
    data() {
      return {}
    },
    components: {
      nav_title: nav_title,
    }
  })

</script>


<style>


</style>
