<template>
  <div>

    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item :to="{ path: '/admin/home' }">首页</el-breadcrumb-item>
      <el-breadcrumb-item>房源审核</el-breadcrumb-item>
    </el-breadcrumb>
    <el-table
      :data="tableData5"
      style="width: 100%">
      <el-table-column type="expand">

        <template slot-scope="props">
          <el-form label-position="left" inline class="demo-table-expand">
            <el-form-item label="房源名称">
              <span>{{ props.row.house_title }}</span>
            </el-form-item>
            <el-form-item label="附带照片">
              <span v-if=" !! props.row.photo ">携带</span>
              <span v-if="! (!!props.row.photo)">无照片</span>
            </el-form-item>
            <el-form-item label="房源 ID">
              <span>{{ props.row.id }}</span>
            </el-form-item>
            <el-form-item label="房间数量">
              <span>{{ props.row.house_number }}</span>
            </el-form-item>
            `
            <el-form-item label="房源类型">
              <span>{{ props.row.genre }}</span>
            </el-form-item>
            <el-form-item label="卫生间数量">
              <span>{{ props.row.toilet }}</span>
            </el-form-item>
            <el-form-item label="地址信息">
              <span>{{ props.row.location.street }}</span>
            </el-form-item>
          </el-form>
        </template>
      </el-table-column>


      <el-table-column
        label="创建时间"
        prop="created_at"
      >
      </el-table-column>

      <el-table-column
        label="房源名称"
        prop="house_title">
      </el-table-column>


      <el-table-column
        label="房源类型"
        prop="genre">
      </el-table-column>


      <el-table-column
        label="地址"
        prop="location.city">
      </el-table-column>
      <el-table-column
      label="操作"
      >
        <template slot-scope="scope">
          <router-link :to="'/admin/home/house_details/'+scope.row.id" class="a_text">
          <el-button type="text" size="small">查看</el-button>
          </router-link>
        </template>
      </el-table-column>

    </el-table>
  </div>
</template>

<style>
  .demo-table-expand {
    font-size: 0;
  }

  .demo-table-expand label {
    width: 90px;
    color: #99a9bf;
  }

  .demo-table-expand .el-form-item {
    margin-right: 0;
    margin-bottom: 0;
    width: 50%;
  }
</style>

<script>
  import Sender from '../../Sender/sender'
  import cfg from '../../../.cfg'

  export default {
    name: 'home_manag',
    data() {
      return {
        tableData5: [],
        id:1,
      }
    },
    created: function () {
      let me = this;
      Sender.post(`${cfg.api}/api/house/read_wait_audit`)
        .then(function (data) {
          console.log("data", data);
          me.tableData5 = data;
        })
    }

  }
</script>


<style>

</style>
