<template>
  <div>
    <nav_></nav_>
    <hr>

    <div class="container">
      <div class="row">
        <div class="col-md-12">

          <div class="row">
            <div class="col-md-6">
              <h5>故事</h5>
            </div>
            <div class="col-md-6 wi">

              <router-link to="/write_story" class="a_text">
                <i class="el-icon-edit">
                  写故事
                </i>
              </router-link>

            </div>
          </div>

        </div>
        <div class="col-md-12">
          <h5 class="all_title">推荐故事</h5>
          <div class="row">
            <div class="col-md-4">
              <div class="size_se1">
                <span class="te_im">
                  杭州街边的小馆子
                  <br>
                  是老底子的味道
                </span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="size_se2">
                <span class="te_im">
五百米杨梅竹
                  <br>
                  三百年古今时光
                </span>
              </div>
            </div>
            <div class="col-md-4">
              <div class="size_se3">
                <span class="te_im">
精彩挪威
                  <br>
                  家住童话山海间
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 all_title">
          <h5>所有故事</h5>
        </div>
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-3" v-for="item in all_story">
              <div class="size_sre">
                <router-link :to="'/ery_story/'+item.id" class="a_text">
                  <img :src="item.cover_photo+'?imageView2/1/w/300/h/300'" alt="" style="width: 100%;height: 242px;"
                       class="img_sto">
                  {{item.title}}
                  <br>
                  <span class="fa fa-bookmark"> {{item.collect}}</span>
                  &nbsp;&nbsp;&nbsp;
                  <span class="fa fa-thumbs-up"> {{item.love}}</span>
                </router-link>
              </div>
            </div>
          </div>


        </div>

      </div>
    </div>

<food>
</food>
  </div>
</template>


<script>
  import Sender from '../../Sender/sender'
  import cfg from '../../../.cfg'
  import nav_ from '../nav'
  import food from '../food'

  export default ({
    name: 'story_all',
    data() {
      return {
        all_story: [],
      }
    },
    components: {
      nav_: nav_,
      food:food
    },
    created: function () {
      let me = this;
      Sender.post(cfg.api + '/api/story/read_state')
        .then(function (data) {
          me.all_story = data;
          console.log("data", data);
        })
    }

  });


</script>


<style lang="scss" scoped>
  .size_se3 {
    width: 100%;
    height: 164px;
    background: linear-gradient(rgba(57, 90, 71, 0), rgba(57, 90, 71, 0.9)), url('../../assets/shan.jpg');
    background-size: 100%;
    border-radius: 15px;
  }

  .size_se1 {
    width: 100%;
    height: 164px;
    background: linear-gradient(rgba(57, 90, 71, 0), rgba(57, 90, 71, 0.9)), url('../../assets/shi.jpg');
    background-size: 100%;
    border-radius: 15px;

  }

  .size_se2 {
    width: 100%;
    height: 164px;
    background: linear-gradient(rgba(57, 90, 71, 0), rgba(57, 90, 71, 0.9)), url('../../assets/wu.jpg');
    background-size: 100%;
    border-radius: 15px;
  }

  .te_im {
    color: white;
    position: absolute;
    font-weight: 500;
    font-size: 20px;
    padding: 15px;
    bottom: 0;
    left: 20px;
  }

  .size_sre {
    width: 98%;
    margin: 5px auto;
  }

  .img_sto {
    border-radius: 10px;
  }

  .all_title {
    margin-top: 30px;
    margin-bottom: 10px;
    margin-left: 5px;
  }

  .wi {
    text-align: right;
    padding-right: 20px;
  }
  a{
    text-decoration: none;
  }
</style>
