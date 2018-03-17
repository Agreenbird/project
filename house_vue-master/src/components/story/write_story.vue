<template>
  <div>
    <nav_></nav_>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h5 class="add_">添加标题</h5>
          <span class="text__">(必须)</span>
          <el-input v-model="title"
                    placeholder='添加一个标题'>
          </el-input>
        </div>

        <div class="col-md-12">
          <h5 class="add_">
            添加封面图
          </h5>
          <span class="text__">
            (必须)
          </span>
          <el-upload
            class="upload-demo"
            :action="serverUrl"
            :on-preview="handlePreview"
            :on-remove="handleRemove"
            :file-list="fileList2"
            :data="token"
            :on-success="head_photo"
            list-type="picture">
            <el-button size="small" type="primary">点击上传</el-button>
            <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
          </el-upload>
        </div>


        <div class="col-md-12">

          <el-upload
            class="avatar-uploader"
            :action="serverUrl"
            :data="token"
            :show-file-list="false"
            :on-success="uploadSuccess"
            :on-error="uploadError"
            :before-upload="beforeUpload"
          >
          </el-upload>
          <quill-editor
            v-model="detailContent"
            ref="myQuillEditor"
            :options="editorOption"
          >
          </quill-editor>
        </div>


        <div class="col-md-12 btn_grup">
          <el-button
            @click="sub_save"
          >保存
          </el-button>
          <el-button @click="sub_publish">
            发表
          </el-button>
        </div>
      </div>


    </div>


  </div>
</template>
<script>

  import Sender from '../../Sender/sender'
  import cfg from '../../../.cfg'
  import nav_ from '../nav'

  const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['blockquote', 'code-block'],

    [{'header': 1}, {'header': 2}],               // custom button values
    [{'list': 'ordered'}, {'list': 'bullet'}],
    [{'script': 'sub'}, {'script': 'super'}],      // superscript/subscript
    [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent
    [{'direction': 'rtl'}],                         // text direction

    [{'size': ['small', false, 'large', 'huge']}],  // custom dropdown
    [{'header': [1, 2, 3, 4, 5, 6, false]}],

    [{'color': []}, {'background': []}],          // dropdown with defaults from theme
    [{'font': []}],
    [{'align': []}],
    ['link', 'image', 'video'],
    ['clean']                                         // remove formatting button
  ]
  export default {
    data() {
      let me = this;
      return {
        token: {
          token: '',
        },
        i: 0,
        fileList2: [],
        title: '',
        show_: 0,
        cover_photo: '',
        quillUpdateImg: false, // 根据图片上传状态来确定是否显示loading动画，刚开始是false,不显示
        serverUrl: 'http://up-z2.qiniup.com',  // 这里写你要上传的图片服务器地址
        detailContent: '', // 富文本内容
        editorOption: {
          placeholder: '',
          theme: 'snow',  // or 'bubble'
          modules: {
            toolbar: {
              container: toolbarOptions,  // 工具栏
              handlers: {
                'image': function (value) {
                  if (value) {
                    // 触发input框选择图片文件
                    document.querySelector('.avatar-uploader input').click()
                  } else {
                    this.quill.format('image', false);
                  }
                }
              }
            }
          }
        }
      }
    },
    components: {
      nav_: nav_
    },
    methods: {
      open3() {
        this.$notify({
          title: '成功',
          message: '发表成功',
          type: 'success'
        });
      },
      handleRemove(file, fileList) {
        console.log(file, fileList);
      },
      handlePreview(file) {
        console.log(file);
      },
      head_photo(file) {
        if (file.hash) {
          this.cover_photo = 'http://ovygmwfnp.bkt.clouddn.com/' + file.hash;
        }
      },


      // 上传图片前
      beforeUpload(res, file) {
      },
      // 上传图片成功
      uploadSuccess(res, file) {
        let img_path = 'http://ovygmwfnp.bkt.clouddn.com/' + res.hash;
        let el_img = `<img src="${img_path}">`;
        this.detailContent += el_img;
      },
      // 上传图片失败
      uploadError(res, file) {
      },
      sub_save: function () {
        Sender.post(cfg.api + '/api/story/add', this.story)
          .then(function (data) {
            console.log("data", data);
          })
      },
      sub_publish: function () {
        let me =this;
        this.show_ = 1;
        Sender.post(cfg.api + '/api/story/add', this.story)
          .then(function (data) {
            if (data.success){
              me.open3();
              me.$router.push({path:'story_all'})
            }
          })
      }
    },
    created: function () {
      this.$store.dispatch('is_login');
      let me = this;
      Sender.post(cfg.api + '/api/house/qiniu')
        .then(function (data) {
          me.token.token = data;
        })
    },
    watch: {
      detailContent: function () {
        this.i++;
        if (Number.isInteger(this.i / 100)) {
          console.log("保存一次");
          Sender.post(cfg.api + '/api/story/add', this.story)
            .then(function (data) {
              console.log("data", data);
            })
        }


        //  获取当前时间,在界面渲染,最后一次的保存时间
      }
    },
    computed: {
      user_id: function () {
        return this.$store.getters['get_user'].id;
      },
      story: function () {
        let story = {};
        story.user_id = this.user_id;
        story.title = this.title;
        story.content = this.detailContent;
        story.detection = this.detection;
        story.publish = this.show_;
        story.cover_photo = this.cover_photo;
        return story;
      },
      detection: function () {
        return parseInt(new Date().getTime() + '1' + (Math.floor((Math.random() * 10) + 1)))

      }
    },
    //生命周期,实例化完以后运行的钩子
    mounted: function () {
    }
  }
</script>

<style lang="scss" scoped>
  .btn_grup{
    text-align: right;
    margin-top: 20px;
  }
  .text__{
    display: block;
    font-size: 13px;
    color: #999;
    margin: 10px 0;
  }
  .add_{
    margin: 20px 0 10px 0;
  }
</style>
