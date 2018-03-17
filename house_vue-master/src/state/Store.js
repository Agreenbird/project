import vue from 'vue'
import vuex from 'vuex'
import Sender from '../Sender/sender'
import cfg from '../../.cfg'

vue.use(vuex)


const store = new vuex.Store({
  state: {
    count: 2,
    location: [],
    user: {},
    new_house: {
      user_id: '',
      genre: '',
      house_genre: '',
      bedroom_genre: '',
      house_number: '',
      people_number: '',
      room_number: "",
      bed_number: '',
      bed_meg: '',
      toilet: '',
      location: {},
      convenience: {},
      facility: {},
      photo: {},
      house_text: '',
      suit: {},
      house_title: '',
      string: '',
      regulation: '',
      inform: '',
      stay_min: '',
      stay_max: '',
      max_price: '',
      min_price: '',
      fixation: '',
      weeks_discount: '',
      mouth_discount: '',
      audit_state: '',
      audit_admin: '',
      audit_time: '',
    },
    location_independent: [],
    new_house: {
      user_id: '',
      genre: '',
      house_genre: '',
      bedroom_genre: '',
      // ****************************************************
      house_number: '',
      people_number: '',
      room_number: "",
      bed_number: '',
      bed_meg: '',
      //房间数量,卧室数量,可以住的人数,床位信息,床位数量
      //********************************************************


      toilet: 1,
      //卫生间数量
      //*********************************************************


      location: {
        country: '中国',
        state: '',
        city: '',
        mail_number: '',
        street: '',
        plot: ''

      },
      //国家和地区
      //**********************************************************
      convenience: [
        {title: '一次性洗漱用品', have: false},
        {title: '床单', have: false},
        {title: '无线网络', have: false},
        {title: '洗发水', have: false},
        {title: '壁橱/抽屉', have: false},
        {title: '电视', have: false},
        {title: '空调', have: false},
        {title: '允许携带宠物', have: false},
        {title: '吹风机', have: false},
        {title: '熨斗', have: false},
        {title: '书桌/工作区', have: false},
        {title: '早餐,咖啡,茶', have: false},
        {title: '烟雾报警器', have: false},
        {title: '一氧化碳灭火器', have: false},
        {title: '急救包', have: false},
        {title: '带锁的卧室', have: false},
        {title: '安全须知卡', have: false},
      ],
      //提供的便利措施
      //**********************************************************


      facility: [
        {title: '游泳池', have: false},
        {title: '厨房', have: false},
        {title: '洗衣机', have: false},
        {title: '健身房', have: false},
        {title: '干衣机', have: false},
        {title: '停车位', have: false},
        {title: '电梯', have: false},
        {title: '按摩浴室', have: false},

      ],
      //可以和游客共享的区域
      //************************************************************
      photo: [],
      //图片
      //************************************************************
      house_text: '',
      suit: [
        {label: "大型团体", model: false},
        {label: "有小孩的家庭", model: false},
        {label: "毛绒绒的伙伴(宠物)", model: false},

      ],
      house_title: '',

      string: [
        {guest_title: '邮箱地址'},
        {guest_title: '已确认的手机号'},
        {landlord_title: '同意您的房屋守则'},
        {mode: false, label: '已向爱彼迎提交身份证明材料'},
        {mode: false, label: '获得其他房东推荐，且没有负面评价'},
      ],
      regulation: [
        {mode: false, label: '适合儿童（2-12岁）'},
        {mode: false, label: '适合婴幼儿（2岁以下'},
        {mode: false, label: '适合携带宠物入住'},
        {mode: false, label: '允许吸烟'},
        {mode: false, label: '允许举办活动或聚会'},
        {mode: false, label_guest: '允许举办活动或聚会'},
        {mode: false, label_guest: '允许举办活动或聚会'},
        {mode: false, label_guest: '允许举办活动或聚会'},
        {mode: false, label_guest: '允许举办活动或聚会'},
        {mode: false, label_guest: '允许举办活动或聚会'},
      ],
      inform: '',
      stay_min: 1,
      stay_max: 0,
      max_price: '',
      min_price: '',
      fixation: '',
      weeks_discount: '',
      mouth_discount: '',
      submit_state: 0,
      save_state: 0,
      audit_state: 0,
      audit_admin: '',
      audit_time: '',
    },


  },
  mutations: {
    inst(state) {
      state.count++;
    },
    location(state, location) {
      state.location = location;
    },
    get_user(state, user) {
      if (user['life_photo'] == null) {
        user['life_photo'] = [];
        state.user = user;
      } else {
        state.user = user;
      }
    },
    valuation_location(state, location) {
      state.location_independent = location;
    },
  },
  actions: {
    get_location(context) {
      Sender.post(cfg.api + '/api/read_location')
        .then(function (data) {
          context.commit("location", data)
        });
    },
    is_login: function (context) {
      Sender.post(cfg.api + '/api/islogin')
        .then(function (data) {
          context.commit('get_user', data.data)
        })
    },
    get_independent: function (context) {
      Sender.post(cfg.api + '/api/read_independent')
        .then(function (data) {
          context.commit('valuation_location', data);
        })
    },
  },
  getters: {
    get_location(state) {
      return state.location;
    },
    get_new_house(state) {
      return state.new_house;
    },
    get_user(state) {
      return state.user;
    },
    get_valuation_location(state) {
      return state.location_independent;
    },
    getState(state) {
      return state.location_independent.filter(item => item.type == 'state');
    },
  }

})


export default store
