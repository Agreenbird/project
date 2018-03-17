<template>
  <div>
    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item :to="{ path: '/admin/home' }">首页</el-breadcrumb-item>
      <el-breadcrumb-item :to="{path:'/admin/home/house_audit'}">房源审核</el-breadcrumb-item>
      <el-breadcrumb-item>房源详情</el-breadcrumb-item>
    </el-breadcrumb>

    <el-row>
      <el-row >
        <div v-for="item in house_data.photo">
        <el-col :span="8"><div><img :src="item" alt="" style="width: 100%;height: 180px;"></div></el-col>
        </div>
      </el-row>


      <el-col :span="24">
        <el-col :span="24">
          <h5>基本信息</h5>
        </el-col>
        <el-col :span="8">
          <div>国家/地区</div>
          <div>省/州</div>
          <div>街道</div>
          <div>门牌</div>
        </el-col>
        <el-col :span="8">
          <div>房屋类型</div>
          <div>房屋类型</div>
          <div>房屋类型</div>
        </el-col>
        <el-col :span="8">
          <div>卧室数量</div>
          <div>卧室数量</div>
          <div>卧室数量</div>
        </el-col>
      </el-col>

      <el-col :span="24">
        <el-col :span="24">
          <h5>基本信息</h5>
        </el-col>
        <el-col :span="8">
          <div>国家/地区</div>
          <div>省/州</div>
          <div>街道</div>
          <div>门牌</div>
        </el-col>
        <el-col :span="8">
          <div>房屋类型</div>
          <div>房屋类型</div>
          <div>房屋类型</div>
        </el-col>
        <el-col :span="8">
          <div>卧室数量</div>
          <div>卧室数量</div>
          <div>卧室数量</div>
        </el-col>
      </el-col>


      <el-col :span="24">
        <el-col :span="24">
          <h5>基本信息</h5>
        </el-col>
        <el-col :span="8">
          <div>国家/地区</div>
          <div>省/州</div>
          <div>街道</div>
          <div>门牌</div>
        </el-col>
        <el-col :span="8">
          <div>房屋类型</div>
          <div>房屋类型</div>
          <div>房屋类型</div>
        </el-col>
        <el-col :span="8">
          <div>卧室数量</div>
          <div>卧室数量</div>
          <div>卧室数量</div>
        </el-col>
      </el-col>




    </el-row>
    <div style="text-align: right">
      <el-button type="primary" @click="pass">通过</el-button>
      <el-button type="danger">拒绝</el-button>

    </div>
  </div>
</template>


<script>
  import Sender from '../../Sender/sender'
  import cfg from '../../../.cfg'

  export default ({
    data() {
      return {
        house_data: {},
      }
    },
    props: ['id'],
    mounted: function () {
    },
    created: function () {
      let me = this;
      Sender.post(`${cfg.api}/api/house/read_id?id=${this.id}`)
        .then(function (data) {
          me.house_data = data[0];
        })
    },
    methods: {
      pass:function () {
        let me =this;
        this.house_data.audit_state=1;
        Sender.post(cfg.api+'/api/house/update_house',this.house_data)
          .then(function (data) {
            if (data.success){
              me.$router.push({path:'/admin/home/house_audit'})
            }
          })
      }

    }
  })

</script>
