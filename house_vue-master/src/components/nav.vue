<template>
  <div id="Hello">
    <div class="nav_show">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <router-link to="/" class="a_text">
              <div class="header">你好,爱彼迎</div>
            </router-link>
          </div>
          <div class="col-md-6">
            <div class="header" style="text-align: right">
              <router-link to="/house_add" class="a_text">
                <el-button type="text" class="header-btn">发布房源</el-button>
              </router-link>
              <el-button type="text" class="header-btn" v-show="! show_login" @click="dialogloginVisible=true">登录
              </el-button>
              <el-button type="text" class="header-btn" v-show="! show_login" @click="dialogsignupVisible = true">注册
              </el-button>
              <router-link to="/story_all" class="a_text">
                <el-button type="text" class="header-btn">故事</el-button>
              </router-link>

              <router-link to="/admin/home" class="a_text">
                <el-button type="text" class="header-btn">管理员面板</el-button>
              </router-link>
              <el-button type="text" class="header-btn" v-show="show_login">
                <el-dropdown>
  <span class="el-dropdown-link header-btn">
    {{user.username}}<i class="el-icon-arrow-down el-icon--right"></i>
  </span>
                  <el-dropdown-menu slot="dropdown">
                    <router-link to="/user_details" class="a_text">
                      <el-dropdown-item>编辑我的资料</el-dropdown-item>
                    </router-link>
                    <router-link to="/user_home_page" class="a_text">
                      <el-dropdown-item>我的主页</el-dropdown-item>
                    </router-link>

                    <el-dropdown-item @click.native="logout()">登出</el-dropdown-item>
                  </el-dropdown-menu>
                </el-dropdown>
              </el-button>
              <el-button type="text" class="header-btn" @click="is_login()">帮助</el-button>
            </div>


          </div>
        </div>

      </div>



    </div>


    <el-dialog title="" :visible.sync="dialogsignupVisible">
      <h1>注册爱彼迎账号</h1>
      <h2>已有账号?
        <el-button type="text" @click="filp_signup()">登录</el-button>
      </h2>
      <el-form :model="form" :rules="rules">
        <el-form-item :label-width="formLabelWidth" prop="phone">
          <el-input v-model.number="form.phone" auto-complete="off" placeholder="手机号"></el-input>
        </el-form-item>
        <el-form-item label="" :label-width="formLabelWidth" prop="email" :rules="[
       { required: true, message: '请输入邮箱地址', trigger: 'blur' },
        { type: 'email', message: '请输入正确的邮箱地址', trigger: 'blur' }
      ]">
          <el-input v-model="form.email" auto-complete="off" placeholder="邮箱"></el-input>
        </el-form-item>

        <el-form-item label="" :label-width="formLabelWidth">
          <el-input v-model="form.username" auto-complete="off" placeholder="用户名"></el-input>
        </el-form-item>

        <el-form-item label="" :label-width="formLabelWidth">
          <el-input v-model="form.password" auto-complete="off" type="password" placeholder="密码"></el-input>
        </el-form-item>

        <el-form-item label="" :label-width="formLabelWidth">
          <el-input type="password" v-model="form.is_password" auto-complete="off" placeholder="确认密码"></el-input>
        </el-form-item>

      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false">取 消</el-button>
        <el-button type="primary" @click="submit">确 定</el-button>
      </div>
    </el-dialog>

    <el-dialog title="" :visible.sync="dialogloginVisible">
      <h1>登录爱彼迎</h1>
      <h2>还没有账号?
        <el-button type="text" @click="filp_login()">注册</el-button>
      </h2>
      <el-form :model="login_form">
        <el-form-item label="" :label-width="formLabelWidth">
          <el-input v-model="login_form.username" auto-complete="off" placeholder="用户名"></el-input>
        </el-form-item>
        <el-form-item label="" :label-width="formLabelWidth">
          <el-input v-model="login_form.password" auto-complete="off" type="password" placeholder="密码"></el-input>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="dialogFormVisible = false">取 消</el-button>
        <el-button type="primary" @click="login_btn(login_form)">确 定</el-button>
      </div>
    </el-dialog>





  </div>
</template>
<script>
  import Sender from '../Sender/sender'
  import cfg from '../../.cfg'

  export default {
    name: 'nav_title',
    data() {
      return {
        show:false,
        dialogsignupVisible: false,
        dialogloginVisible: false,
        form: {
          username: '',
          phone: '',
          email: '',
          password: '',
        },
        login_form: {
          username: 'yinminqian',
          password: 'minqian',
        },
        formLabelWidth: '0px',
        show_login: false,
        user: {},
        rules: {
          phone: [
            {
              required: true,
              validator: this.CheckTel,
              trigger: 'blur'
            }
          ],
        }
      }
    },
    methods: {
      CheckTel: (rule, value, callback) => {
        console.log("rule", rule);
        if (!value) {
          callback(new Error('请输入电话号码'));
        } else if (!Number.isInteger(value)) {
          callback(new Error('电话号码必须是数字'));
        } else if (value.toString().length != 11) {
          callback(new Error('电话号码必须是11位'));
        } else {
          callback();
        }
      },
      filp_login() {
        this.dialogsignupVisible = true
        this.dialogloginVisible = false;
      },
      filp_signup() {
        this.dialogsignupVisible = false
        this.dialogloginVisible = true;
      },
      submit() {
        let me = this;
        Sender.post(cfg.api + '/api/signup', this.form)
          .then(function (data) {
            if (data) {
              me.login_btn({username: me.form['username'], password: me.form['password']})
              me.win();
              me.is_login();
              me.dialogsignupVisible = false
            }
            else{
              me.open6();
            }
          })
      },
      login_btn: function (data) {
        console.log("data", data);
        let me = this;
        Sender.post(cfg.api + '/api/login', data)
          .then(function (item) {
            console.log("登陆返回值", item);
            if (item == 1) {
              console.log("进入true判断");
              me.is_login();
              console.log("登陆成功");
              me.dialogloginVisible = false;
            }else {
              console.log("进入else错误");
            }
          })
      },
      win() {
        this.$message({
          message: '注册成功,已自动登录',
          type: 'success'
        });
      },
      open6() {
        this.$notify.error({
          title: '错误',
          message: '可能是手机号和用户名已经存在,请尝试修改,或者直接点击登陆,输入框有现成的账号密码'
        });
      },



      is_login: function () {
        console.log("运行了我is_login");
        let me = this;
        Sender.post(cfg.api + '/api/islogin')
          .then(function (data) {
              console.log("data12121",data);
            if (data.success) {
              me.user = data.data;
              me.show_login = data.success;
            }else {
              me.dialogloginVisible=true;
            }
            me.show_login = data.success;
            return;
          })
      },
      logout: function () {
        let me = this;
        Sender.post(cfg.api + '/api/logout')
          .then(function (data) {
            if (data.success) {
              me.is_login();
            }
            return data.success;
          })
      }
    },
    created: function () {
      return this.is_login()
    },
    mounted:function () {
      this.is_login();
    }
  }
</script>


<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>


  .header-btn, .header {
    color: black;
    padding: 15px;
    /*margin-left: 20px;*/
  }
  a{
    text-decoration: none;
  }
  a:hover{
    text-decoraction: none;
  }
</style>
