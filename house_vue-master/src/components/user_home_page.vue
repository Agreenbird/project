<template>
  <div>
    <nav_title></nav_title>
    <hr>

    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <div v-bind:class="{gu:searchBarFixed}">
            <div class="col-md-12 img_photo">
              <img :src="user_msg.photo+'?imageView2/1/w/200/h/200'" alt="" class="img_">
            </div>

            <div class="aol-md-12 img_photo">
          <span v-if="user_msg.phone">
            {{user_msg.phone}}
          </span>
              <br>
              <span v-if="user_msg.email">
           {{user_msg.email}}
          </span>
            </div>
          </div>

        </div>
        <div class="col-md-8">


          <div class="col-md-12 text_msg">
            <h4>您好,我是 {{user_msg.username}}</h4>
          </div>
          <div class="co-md-12 text_msg">
            <h4>
              个人简介
            </h4>
            <span>
              {{user_msg.referral}}
            </span>
          </div>
          <div class="col-md-12">
            <h5 class="text_title">生活照</h5>
            <div class="row">
              <div class="col-md-3" v-for="item in user_msg.life_photo">

                <img :src="item+'?imageView2/1/w/400/h/400'" alt="" class="life_photo">
              </div>
            </div>
          </div>


          <div class="col-md-12">
            <h5 class="text_title">故事</h5>
            <div class="row">

              <div class="col-md-3 story" v-for="item in story">
                <router-link to="/ery_story/'+item.id" class="a_text">
                  <img :src="item['cover_photo']+'?imageView2/1/w/400/h/400'" alt="" class="life_photo">
                  {{item.title}}
                </router-link>

              </div>

            </div>
          </div>
          <div class="col-md-12">
            <h5 class="text_title">房源</h5>
            <div class="row">
              <div class="col-md-3 story" v-for="item in house">
                <router-link :to="'/house_material/'+item.id" class="a_text">
                <img :src="item['photo'][0]+'?imageView2/1/w/400/h/400'" alt="" class="life_photo">
                {{item.house_title}}
                </router-link>
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

  import nav_title from './nav'
  import food from './food'
  import Sender from '../Sender/sender'
  import cfg from '../../.cfg'

  export default ({
    name: 'user_home_page',
    data() {
      return {
        house: [],
        story: [],
        offsetTop:121,
        searchBarFixed:false,
      }
    },
    components: {
      nav_title: nav_title,
      food:food,
    },
    created: function () {
      this.$store.dispatch('is_login');
    },
    computed: {
      user_msg: function () {
        return this.$store.getters['get_user'];
      },
    },
    methods: {
      test: function () {
        console.log("this", this.user_msg);
      },
      handleScroll () {
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop
        if (scrollTop > this.offsetTop) {
          this.searchBarFixed = true
        } else {
          this.searchBarFixed = false
        }
      },
    },
    watch: {
      user_msg: function () {
        let me = this;
        Sender.post(cfg.api + '/api/house/read_user_house?user_id=' + me.user_msg['id'])
          .then(function (data) {
            me.house = data;
          })

        Sender.post(cfg.api + '/api/story/read_story_user?user_id=' + me.user_msg['id'])
          .then(function (data) {
            me.story = data;
          })
      },

    },
    mounted: function () {
      window.addEventListener('scroll', this.handleScroll);
    },
    destroyed () {
      window.removeEventListener('scroll', this.handleScroll)
    },

  })
</script>


<style lang="scss" scoped>
  .img_photo {
    padding: 10px;
    /*text-align: center;*/
  }

  .img_ {
    border-radius: 5px;
  }

  .text_msg {
    padding: 10px;
  }

  .life_photo {
    width: 100%;
    border-radius: 5px;
  }

  .story {
    margin: 5px 0;
  }

  .text_title {
    margin: 15px 0;
  }

  .gu {
    position: fixed;
    top: 0px;
  }
  a{
    text-decoration: none;
  }
</style>
