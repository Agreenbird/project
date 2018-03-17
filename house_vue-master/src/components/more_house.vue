<template>
  <div>
    <nav_title></nav_title>
    <hr>
    <div class="container">

      <div class="row">
        <div class="col-md-12">
        <h4>热门房屋</h4>
        </div>


        <div class="col-md-12 ma_10">
          <h5>
            我们提供两个类型的房屋
          </h5>
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
          <div class="row">
            <div class="col-md-12 ma_10">
              <h5>所有房源</h5>
            </div>
            <div v-for="item in house_data" class="col-md-3">
            <router-link :to="'/house_material/'+item.id" class="a_text">
              <div class="size_ho">
                <img :src="item.photo[0]+'?imageView2/1/w/300/h/300'" alt="" style="width: 100%;height: 100%;">
                <h5 class="house_title">¥{{item.fixation}}&nbsp; </h5>
                <span> &nbsp;{{item.house_genre}}</span>
                <span>可住{{item.people_number}}人</span>
                <br>
                <span>{{item.house_title}}</span>
              </div>
            </router-link>
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
  import nav_title from './nav'
  import Sender from '../Sender/sender'
  import cfg from '../../.cfg'
  import food from './food'

  export default ({
    name: 'house_more',
    data() {
      return {
        house_data: [],
      }
    },
    components: {
      nav_title: nav_title,
      food:food,
    },
    created: function () {
      let me = this;
      this.$store.dispatch('is_login')
      Sender.post(`${cfg.api}/api/house/read_house`)
        .then(function (data) {
          me.house_data = data;
        })
    }
  })
</script>

<style lang="scss" scoped>
  .size_sh {
    margin: 10px 10px 10px 0;
  }
  .f_span {
    display: block;
  }
  .img_sh {
    width: 100%;
    border-radius: 5px;
  }
  .ma_10{
   margin-top: 20px;
  }
  .size_ho{
    margin-bottom: 20px;
  }
  .house_title {
    display: inline-block;
  }
  a{
    text-decoration: none;
  }
</style>
