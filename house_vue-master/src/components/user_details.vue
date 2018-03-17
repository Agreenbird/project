<template>
  <div>
    <nav_title></nav_title>
    <hr>
    <div class="container">
      <div class="row">
        <div class="col-md-6 user_bar_">
          <div class="user_bar_">
            <div class="user_bar" @click="user_add">编辑个人资料</div>
            <span class="user_bar" @click="photo_add()">照片</span>
            <div class="user_bar">对我的评价(开发中)</div>
            <div class="user_bar">我评论过的(开发中)</div>
            <div class="user_bar">
              <router-link to="/user_home_page" class="a_text">

                <el-button>查看我的主页</el-button>
              </router-link>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div v-if="user_redact==1">
            <el-alert
              v-if="show"
              title="成功提示的文案"
              type="success">
            </el-alert>
            <div class="row">
              <div class="col-md-12">
                <h5>必填</h5>

              </div>
              <div class="col-md-12 ma_10">
                姓氏:
                <el-input v-model="get_user['last-name']"></el-input>
              </div>

              <div class="col-md-12 ma_10">名字:
                <el-input v-model="get_user.name"></el-input>
              </div>
              <div class="col-md-12 ma_10">我是:
                <el-radio v-model="get_user.sex" label="boy">男</el-radio>
                <el-radio v-model="get_user.sex" label="girl">女</el-radio>
              </div>
              <div>
                <div class="col-md-12 block ma_10">
                  <span class="demonstration">生日</span>
                  <el-date-picker
                    v-model="get_user.birthday"
                    type="date"
                    placeholder="选择日期"
                    :picker-options="pickerOptions1"
                    :default-value="new Date('1995/11/17')"
                  >
                  </el-date-picker>
                </div>
              </div>
              <div class="col-md-12 ma_10">
                电子邮箱设置:
                <el-input v-model="get_user.email"></el-input>
              </div>
              <div class="col-md-12 ma_10">
                手机号:
                <el-input v-model="get_user.phone" placeholder="请输入内容">
                  <template slot="prepend">+86</template>
                </el-input>
              </div>
              <div class="col-md-12 ma_10">
                您住过的地方:
                <el-input v-model="get_user.dwell">

                </el-input>
              </div>
              <div class="col-md-12 ma_10">
                自我介绍:
                <el-input
                  type="textarea"
                  :rows="2"
                  placeholder="请输入内容"
                  v-model="get_user.referral"
                >
                </el-input>
              </div>
              <div class="col-md-12 ma_10 btn_ma">
              <el-button @click="submit_details">保存</el-button>
              </div>


            </div>









          </div>
          <div v-if="user_redact==2">
            <div>
              <div class="row">
                <div class="col-md-12">
              <h5>头像</h5>
                </div>

                <div class="col-md-4">
                  <div v-if="get_user.photo"
                  >
                    <img :src="get_user.photo+'?imageView2/1/w/300/h/300'" alt="" style="max-width: 100%;" class="photo_user">
                  </div>
                </div>
                <div class="col-md-8">
                  <span>清晰的正面脸部照片是房东和房客互相认识对方的重要途径。您能想象把自己的房子租给一只猫吗？ 请确保使用能够清楚显示您面部的照片，并确认其中不包含任何您不希望其他房东或房客看到的个人或敏感信息。</span>
                  <el-upload
                    class="upload-demo"
                    action="http://up-z2.qiniup.com"
                    :data="token"
                    :on-success="head_img"
                    :limit="10000000"
                    :show-file-list="su"
                  >
                    <el-button size="small" type="primary">点击上传</el-button>
                    <!--<div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>-->
                  </el-upload>
                </div>
              </div>

              <div class="col-md-12">
                <hr>
                <div class="col-mw-12">
                  <div class="row">
                    <div v-for="key in get_user.life_photo" class="col-md-4 img_fili">
                      <div style="width: 100%;height: 150px;">
                        <i class="el-icon-delete i_icon" @click="rm_img(key)"></i>
                        <img :src="key+'?imageView2/1/w/300/h/300'" @mouseover="img_affair" alt="" style="width: 100%;height: 100%;" class="tt">
                      </div>
                    </div>

                  </div>
                </div>









                <div class="col-md-12" style="text-align: right">
                  <hr>

                  <el-upload
                    action="http://up-z2.qiniup.com"
                    :on-preview="handlePictureCardPreview"
                    :on-remove="handleRemove"
                    :on-success="test"
                    :data="token"
                    :limit="number"
                    :on-exceed="max_img"
                    :show-file-list="su"
                  >
                    <el-button size="small" type="primary">点击上传</el-button>
                    <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
                  </el-upload>
                </div>




              </div>


            </div>

          </div>
        </div>
      </div>
    </div>

<food></food>
  </div>
</template>


<script>
  import nav_title from '@/components/nav'
  import Sender from '../Sender/sender'
  import cfg from '../../.cfg'
  import food from './food'


  export default ({
    name: 'user_details',
    data() {
      return {
        su: false,
        user_redact: 1,
        pickerOptions1: {
          disabledDate(time) {
            return time.getTime() > Date.now();
          }
        },
        dialogImageUrl: '',
        dialogVisible: false,
        token: {
          token: ''
        },
        number: 8,
        img_number: 0,
        show: false,
      }
    },
    components: {
      nav_title: nav_title,
      food:food,
    },
    computed: {
      get_user: function () {
        return this.$store.getters['get_user'];
      }
    },
    watch: {
      values: function () {

      }
    },
    created() {
      this.$store.dispatch('is_login');

      let me = this;
      Sender.post(cfg.api + '/api/house/qiniu')
        .then(function (data) {
          console.log("data",data);
          me.token.token = data;
        })
    },
    methods: {
      // test() {
      //   return new Date();
      // },
      user_add() {
        this.user_redact = 1;
      },
      head_img(name) {
        console.log("name",name);
        this.get_user['photo'] ='http://ovygmwfnp.bkt.clouddn.com/' + name.key;
        this.submit_details();
        this.$store.dispatch('is_login');
      },
      photo_add: function () {
        this.user_redact = 2;
      },
      handleRemove(file, fileList) {
        let me = this;
        let img_path = `http://ovygmwfnp.bkt.clouddn.com/${file.response.key}`;
        this.get_user.life_photo.forEach(function (item, index) {
          if (item == img_path) {
            me.get_user.life_photo.splice(index);
            me.submit_details();
            me.$store.dispatch('is_login');
          }
        })
      },
      rm_img(key) {
        let me = this;
        this.get_user.life_photo.forEach(function (item, index) {
          if (item == key) {
            me.get_user.life_photo.splice(index, 1);
            me.submit_details();
            me.$store.dispatch('is_login');
          }
        })
      },
      img_affair() {
      },
      handlePictureCardPreview(file) {
        this.dialogImageUrl = file.url;
        this.dialogVisible = true;
      },
      test: function (response, file, fileList) {
        let img_path = 'http://ovygmwfnp.bkt.clouddn.com/' + response.key;
        this.get_user['life_photo'].push(img_path);
        this.submit_details();
        this.$store.dispatch('is_login');
      },
      max_img() {
        this.open4();
      },
      open4() {
        this.$notify({
          title: '图片数量超出',
          message: '最多上传8张图片,您不能在上传了',
          type: 'warning'
        });
      },
      submit_details() {
        let me = this;
        Sender.post(cfg.api + '/api/update_user', this.get_user)
          .then(function (data) {
            if (data.success) {
              me.show = true;
              setTimeout(function () {
                me.show = false;
              }, 3000)
            }
          })
      }
    },
  })

</script>


<style lang="scss" scoped>
  .user_bar {
    margin: 10px;
    padding-left: 30px;
    cursor: pointer;
  }

  .user_bar:hover {
    color: #409eff;
  }
  .ma_10{
    margin-top: 10px;
  }
.btn_ma{
  text-align: right;
}
  .photo_user{
    border-radius: 5px;
  }
  .img_fili{
    padding: 10px;
  }
  .tt{
    border-radius: 5px;
  }
  .i_icon{
    position: absolute;
    top: 10px;
    right: 10px;
  }
</style>
