<template>
  <div>
    <nav_title></nav_title>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title_test">
            <h1>Airbnb爱彼迎</h1>
            <h3>全球400万民宿任你挑</h3>
          </div>
        </div>
        <div class="col-md-12">
          <div class="size_search">
            <div class="row">
              <div class="col-md-4">
                    <span class="location">
              地点
            </span>
                <input type="text" @click="inp_tr" class="search_inp" v-bind:class="{inp_true:inputte}"
                       placeholder="城市名,目的地,地点">
              </div>
              <div class="col-md-4">
                <div class="block">
                  <span class="demonstration location">时间</span>
                  <el-date-picker
                    v-model="value6"
                    type="daterange"
                    range-separator="-"
                    start-placeholder="开始日期"
                    end-placeholder="结束日期">
                  </el-date-picker>
                </div>


              </div>
              <div class="col-md-4 search">
                <span class="location">
                  房客数量
                </span>
                <el-input-number class="uu" v-model="num1" :min="1" :max="10" label="描述文字"></el-input-number>
                <button class="btn_search">
                  搜索(不可用)
                </button>
              </div>

            </div>

          </div>
        </div>

        <div class="col-md-12 vice_title">
          <h5>探索爱彼迎</h5>
        </div>
        <div class="col-md-12">
          <div class="row ">
            <div class="col-md-3">
              <div class="vice_card">
<router-link to="/more_house" class="a_text">
  <img src="../assets/8b7519ec-2c82-4c09-8233-fd4d2715bbf9.jpg" alt="" class="vice_img">
  <span class="_th">房源</span>
</router-link>

              </div>
            </div>
            <div class="col-md-3">
              <div class="vice_card">
                <router-link to="/story_all" class="a_text">
                  <img src="../assets/cb8b3101-d419-4c17-8e2f-4989b39b98c3.jpg" alt="" class="vice_img">
                  <span class="_th">
                故事
              </span>
                </router-link>

              </div>
            </div>
          </div>

        </div>


      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h5 class="hot_lo">热门目的地</h5>
        </div>
        <div class="col-md-12">
          <div class="city_show">
            <span>北京</span>
          </div>

        </div>

        <div class="col-md-4" v-for="item in house_data" style="height: 327px;">
          <div class="size_house">
            <router-link :to="'/house_material/'+item.id" class="a_text">
              <!--<div class="img_show">-->
              <img :src="item.photo[0]+'?imageView2/1/w/200/h/200'" alt="" class="img_show_">
              <!--</div>-->
              <div class="show_title">
                <br>
                <span class="house_title">¥{{item.fixation}}</span>
                <span>{{item.house_genre}}</span>
                <span>可住{{item.people_number}}人</span>
                <span class="text_title">{{item.house_title}}</span>
              </div>
            </router-link>
          </div>
        </div>


        <div class="col-md-12">
          <router-link to="/more_house">
            <el-button type="primary" class="btn_all">查看更多房源</el-button>
          </router-link>
        </div>


        <div class="col-md-12">
          <h5>
            让您能够充分享受旅程的房源
          </h5>
          <span>
        找到拥有您所需便利设施的高分房源
          </span>
        </div>


        <div class="col-md-6">
          <div class="size_sh">
            <img src="../assets/home1.jpg" alt="" class="img_sh">
            <span class="f_span">
              超过2000个房源
            </span>
            <span>
              寻找适合家庭出游的理想房源，自由畅享私家空间
            </span>
          </div>

        </div>
        <div class="col-md-6">
          <div class="size_sh">
            <img src="../assets/home2.jpg" alt="" class="img_sh">
            <span class="f_span">
              超过2000个房源
            </span>
            <span>
预订提供灵活预订和差旅所需设施的高分房源
            </span>
          </div>

        </div>







        <div class="col-md-12">
          <h5>精选故事</h5>
        </div>

        <div class="col-md-3" v-for="item in all_story" style="height: 327px;">
          <div class="size_house">
            <router-link :to="'/ery_story/'+item.id" class="a_text">

            <!--<div class="img_show">-->
              <img :src="item.cover_photo+'?imageView2/1/w/300/h/300'" alt="" class="img_show_">
              <!--</div>-->
              <div class="show_title">
                <br>
                <span>{{item.title}}</span>
                <br>
                <span class="fa fa-bookmark"> {{item.collect}}</span>
                &nbsp;&nbsp;&nbsp;
                <span class="fa fa-thumbs-up"> {{item.love}}</span>
              </div>
            </router-link>
          </div>
        </div>




   <div class="col-md-12 hint">
   <div class="row">
     <div class="col-md-4 balm">
       <div class="row">
         <div class="col-md-4 ico_">
           <i class="fa fa-phone ico__"></i>
         </div>
         <div class="col-md-8">
               <span>
                24小时中文客服
              </span>
           <br>
           <span>
                +86 10 8783-3463
              </span>
         </div>
       </div>
     </div>
     <div class="col-md-4 balm">
       <div class="row">
         <div class="col-md-4 ico_">
           <i class="fa fa-heart ico__"></i>
         </div>
         <div class="col-md-8">
                  <span>
                    安全支付
              </span>
           <br>
           <span>
                支付宝付款已向中国用户开通
              </span>
         </div>
       </div>
     </div>
     <div class="col-md-4 balm">
       <div class="row">
         <div class="col-md-4 ico_">
           <i class="fa fa-key ico__"></i>
         </div>
         <div class="col-md-8">
                  <span>
                    芝麻信用
              </span>
           <br>
           <span>
                实名认证房东房客信息
              </span>
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
    name: 'helloword',
    data() {
      return {
        house_data: [],
        all_story: [],
        inputte: false,
        num1: 1,
        value6: '',
      }
    },
    components: {
      nav_title: nav_title,
      food:food
    },
    computed: {
      user() {
        return this.$store.getters['get_user']
      },
    },
    methods: {
      inp_tr: function () {
        this.inputte = true;
        console.log("1", 1);
      }
    },

    created: function () {
      let me = this;
      this.$store.dispatch('is_login')
      Sender.post(`${cfg.api}/api/house/read_house`)
        .then(function (data) {
          console.log("data", data);
          me.house_data = data;
        })

      Sender.post(cfg.api + '/api/story/read_state')
        .then(function (data) {
          console.log("data", data);
          me.all_story = data;
        })
    }
  })

</script>


<style lang="scss" scoped>
  .heard {
    width: 100%;
    height: 400px;
  }

  h1 {
    color: #409EFF;
    font-size: 50px;
  }

  h3 {
    font-size: 40px;
  }

  .btn_search {
    font-family: Circular, "PingFang-SC", "Hiragino Sans GB", "微软雅黑", "Microsoft YaHei", "Heiti SC" !important;
    font-size: 12px !important;
    line-height: 15px !important;
    /*letter-spacing: undefined !important;*/
    padding-top: 0px !important;
    padding-bottom: 0px !important;
    color: #ffffff !important;
    padding-left: 18px !important;
    padding-right: 18px !important;
    border-radius: 4px !important;
    border: 0px !important;
    background: #409EFF !important;
    /*margin: 12px !important;*/
    /*margin-left: 16px !important;*/
    height: 48px !important;
    text-align: center !important;
    display: inline-block !important;
    /*float: right !important;*/
    white-space: nowrap !important;
    outline: none;
    float: right !important;
    position: absolute;
    top: 50%;
    left: 80%;
    transform: translate(-50%, -50%);
    cursor: pointer;
  }

  .size_search {
    padding: 20px;
    border: 1px solid #e8e8e8;
    border-radius: 10px;
    box-shadow: 1px 1px 2px #e8e8e8;
  }

  .search_inp {
    border: none;
    width: 80%;
    outline: none;
  }

  .location {
    display: inline-block;
    margin: 10px;
    margin-left: 0;
    width: 50%;
  }

  .title_test {
    padding: 40px;
    padding-left: 0;
  }

  .inp_true {
    border-bottom: 1px solid #409eff;
  }

  .el-input__inner {
    border: none;
  }

  .uu {
    border: none !important;
  }

  .vice_img {
    width: 96px;
    height: 72px;
    border-radius: 5px 0 0 5px;
  }

  ._th {
    font-size: 17px;
    font-weight: 500;
  }

  .vice_title {
    margin: 20px 0 5px 0;
  }

  .vice_card {
    border: 1px solid #e8e8e8;
    box-shadow: 0px 0px 2px #e8e8e8;
    border-radius: 5px;
    cursor: pointer;
  }

  .hot_lo {
    margin: 40px 0 10px 0;
  }

  .city_show {
    border-bottom: 1px solid #e8e8e8;
    padding-bottom: 10px;
    margin-top: 5px;
  }

  .city_show {
    span {
      margin: 0px 15px 0 0;
    }
  }

  .size_house {
    margin: 10px 10px 10px 0;
  }

  .img_show_ {
    position: absolute;
    left: 0;
    right: 0;
    top:22px;
    width: 90%;
    margin: 0 auto;
    height: 80%;
  }

  .show_title {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    width: 90%;
    margin: 0 auto;
    height: 20%;
  }

  .house_title {
    display: inline-block;
  }

  .btn_all {
    margin: 25px 0 15px 0;
  }

  .size_sh {
    margin: 10px 10px 10px 0;
  }

  .img_sh {
    width: 100%;
    border-radius: 5px;
  }

  .f_span {
    display: block;
  }

  h5 {
    margin-top: 25px;
  }

  .ico_ {
    /*text-align: right;*/
    display: flex;
    justify-content: flex-end;
    align-items: center;
  }

  .ico__ {
    font-size: 30px;
  }
  .balm{
    margin: 20px 0 20px 0;
  }
  .text_title{
    display:block;
  }
  .hint{
    margin-top: 30px;
  }
  a{
    text-decoration: none;
  }
</style>
