<template>
  <div>
    <nav_>
    </nav_>
    <hr>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="con_user_">
            <div class="row">
              <div class="ll">
                <img :src="writer.photo+'?imageView2/1/w/300/h/300'" alt="" width="50px" class="user_img">
              </div>
              <div class="ll ll_text">
                {{writer.username}}
                <br>
                <span v-if="time_">
          {{time_}}天之前
        </span>
                <span v-else>
          今天
        </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 ma_30">
          <div class="content">
          </div>
        </div>

        <div class="col-md-12">
          <div class="con_user_">


            <div class="love_coll">

              <span class="fa fa-thumbs-up">
              {{story.love}}
              </span>
              <span class="fa fa-bookmark collect_ico">
              {{story.collect}}
              </span>

            </div>


            <div class="col-md-12 btn_grup">
              <div class="row">

                <div class="col-md-6 love_btn">
                  <button v-if="!love_show" @click="love_btn" class="bnt_live">点赞</button>
                  <button v-if=" love_show" @click="yet_love" class="bnt_live">已赞</button>
                </div>

                <div class="col-md-6">
                  <button v-if="!collect_show" @click="collect_btn" class="bnt_live">收藏</button>
                  <button v-if="collect_show" @click="yet_collect" class="bnt_live">已收藏</button>
                </div>


              </div>


            </div>

            <div class="col-md-12 ma_no">
              <h5>
                评论
              </h5>
            </div>
            <div class="col-md-12 ma_no">
              <el-input v-model="comment.comment">
              </el-input>
            </div>
            <div class="col-md-12 ma_no btn_com">
              <el-button @click="btn_comment">
                发送
              </el-button>
              <hr>
            </div>


            <div class="col-md-12 ma_no">
              <div class="row">


                <div v-for="item in comments" class="col-md-12 item">

                  <div class="row">
                    <div class="col-md-6">
                      <div v-if="item.parent" class="reply">
                        {{item.parent}} 回复
                      </div>
                      <span>
            {{item.username}}
            </span>
                    </div>


                    <div class="col-md-6" style="text-align: right;color: #999;font-size: 13px">
                      {{item.time}}天之前
                    </div>

                  </div>


                  <div class="col-md-12">{{item.comment}}</div>


                  <button v-if="item.reply" @click="item.reply = !item.reply" class="fa fa-reply bnt_reply"> 回复</button>


                  <div class="col-md-12">
                    <el-input v-if="! item.reply" v-model="level2_comment.comment">
                    </el-input>
                  </div>


                  <div class="col-md-12" style="text-align: right;margin-top: 10px">
                    <button v-if="! item.reply" @click="item.reply = !item.reply" class="two_re">取消</button>
                    <button v-if="! item.reply" @click="item.reply = !item.reply;level2_comment_btn(item.id)"
                            class="two_re">
                      发送
                    </button>

                  </div>
                </div>


              </div>
            </div>

          </div>


        </div>
      </div>
    </div>


  </div>
</template>


<script>
  import Sender from '../../Sender/sender'
  import cfg from '../../../.cfg'
  import $ from 'jquery'
  import nav_ from '../nav'

  export default ({
    name: "ery_story",
    data() {
      let me = this;
      return {
        story: {},
        writer: {},
        love_show: '',
        collect_show: '',
        comment: {
          comment: '',
        },
        level2_comment: {
          comment: '',
        },
        comments: [],
      }
    },
    components: {
      nav_: nav_
    },
    props: ['id'],
    created: function () {
      this.$store.dispatch('is_login');

      let me = this;
      //获取故事详情
      Sender.post(`${cfg.api}/api/story/read_id?id=${this.id}`)
        .then(function (data) {
          me.story = data;
          me.read_content(data)
          let user_id = data.user_id;
          Sender.post(`${cfg.api}/api/read_user_id?id=${user_id}`)
            .then(function (data) {
              me.writer = data;
            })
        })

    },
    computed: {
      time_: function () {
        let old_time = (new Date(this.story.created_at)).getTime();
        let new_time = (new Date()).getTime();
        let time = parseInt((new_time - old_time) / 1000 / 60 / 60 / 24);
        return time;
      },
      now_user: function () {
        return this.$store.getters['get_user'];
      },

    },
    watch: {},
    methods: {
      read_content: function (data) {
        let content = document.querySelector('.content');
        content.innerHTML = '';
        let el = document.createElement('div');
        el.innerHTML = `${data.content}`
        el.classList.add('test')
        content.appendChild(el);
        this.read_love();
        this.read_comment();

      },
      collect_btn: function () {
        this.collect_show = !this.collect_show;
        this.story.collect++;
        this.update_story();
        this.update_collect()
      },
      love_btn: function () {
        this.love_show = !this.love_show;
        this.story.love++;
        this.update_story();
        this.update_love();
      },
      yet_love: function () {
        this.love_show = !this.love_show;
        this.story.love--;
        this.update_story();
        this.update_love();
      },
      yet_collect: function () {
        this.collect_show = !this.collect_show;
        this.story.collect--;
        this.update_story();
        this.update_collect()
      },
      update_collect: function () {
        Sender.post(cfg.api + '/api/LoveCollect/add?user_id=' + this.now_user.id + '&article_id=' + this.story.id + '&collect=' + Number(this.collect_show))
          .then(function (data) {
            console.log("data", data);
          })
      },
      update_love: function () {
        Sender.post(cfg.api + '/api/LoveCollect/add?user_id=' + this.now_user.id + '&article_id=' + this.story.id + '&love=' + Number(this.love_show))
          .then(function (data) {
            console.log("data", data);
          })
      },
      read_love: function () {
        let me = this;
        Sender.post(cfg.api + '/api/LoveCollect/read_user_love?user_id=' + this.now_user.id + '&article_id=' + this.story.id)
          .then(function (data) {
            console.log("data", data);
            if (data.data[0].love) {
              me.love_show = true
            } else {
              me.love_show = false;
            }
            console.log("data.data[0].collect", data.data[0].collect);
            if (data.data[0].collect) {
              me.collect_show = true
            } else {
              me.collect_show = false;
            }
          })
      },
      update_story: function () {
        Sender.post(cfg.api + '/api/story/add', this.story).then(function (data) {
          console.log("data", data);
        })
      },
      btn_comment: function () {
        let me = this;
        this.comment.user_id = this.now_user.id;
        this.comment.article_id = this.story.id;
        Sender.post(cfg.api + '/api/Story_comments/add', this.comment)
          .then(function (data) {
            console.log("data", data);
            me.read_comment()
            me.comment = {
              comment: '',
            }
          })
      },
      read_comment: function () {
        let me = this;
        Sender.post(cfg.api + '/api/Story_comments/read_comment?article_id=' + this.story.id)
          .then(function (data) {
            console.log("data", data);
            me.comments = data;
          })
      },


      level2_comment_btn: function (item) {
        let me = this;
        this.level2_comment.user_id = this.now_user.id;
        this.level2_comment.article_id = this.story.id;
        this.level2_comment.parent_id = item;
        Sender.post(cfg.api + '/api/Story_comments/add', this.level2_comment)
          .then(function (data) {
            me.read_comment()
            me.level2_comment =
              {
                comment: '',
              }

          })


      }
    },
    updated: function () {
      $('.test').find('img').css('width', '100%');
    },
    mounted: function () {

    }


  });
</script>
<style lang="scss" scoped>

  .test p {
    color: red;
  }

  html body div#app div div.el-row div.el-col.el-col-24 div.content div.test p {
    color: red;
  }

  .son {
    background-color: aqua;
  }

  .content, .con_user_ {
    width: 60%;
    margin: 0 auto;
  }

  .user_img {
    border-radius: 50%;
  }

  .ll {
    display: inline-block;
    margin-left: 5px;
  }

  .ll_text {
    margin-left: 15px;
  }

  .collect_ico {
    margin-left: 30px;
  }

  .bnt_live {
    border-radius: 50%;
    border: 1px solid #999;
    background: #F8F8F7;
    width: 100px;
    height: 100px;
    outline: none;
  }

  .love_btn {
    text-align: right;
  }

  .btn_grup {
    margin: 20px 0;
  }

  .ma_no {
    margin: 0;
    padding: 0;
  }

  .btn_com {
    margin-top: 10px;
    text-align: right;
  }

  .ma_30 {
    margin-top: 30px;
  }

  .reply {
    display: inline-block;
  }

  .item {
    margin-top: 10px;
  }

  .bnt_reply {
    background: #fff;
    border: none;
    font-size: 13px;
    outline: none;
    cursor: pointer;
  }

  .two_re {
    background: #fff;
    border: none;
    font-size: 13px;
    outline: none;
    cursor: pointer;
  }
</style>
