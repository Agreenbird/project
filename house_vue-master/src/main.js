// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import store from './state/Store'
import Vuex from 'Vuex'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import Sender from './Sender/sender'
import '../node_modules/bootstrap/dist/css/bootstrap.css'
import 'font-awesome/css/font-awesome.css'

//Vue的富文编辑器

import vueQuillEditor from 'vue-quill-editor'
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'
import VueAwesomeSwiper from 'vue-awesome-swiper'

// require styles
import 'swiper/dist/css/swiper.css'

Vue.use(VueAwesomeSwiper, /* { default global options } */)








Vue.use(Vuex)
Vue.use(ElementUI)
Vue.use(vueQuillEditor)
Vue.config.productionTip = false
import VueAMap from 'vue-amap';

Vue.use(VueAMap);
VueAMap.initAMapApiLoader({
  key: 'bf5b356d3ffaab642c974983267b1ce8',
  plugin: ['Geocoder', 'MapType']
});

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  created: function () {
    this.$store.dispatch('get_location')
  },
  components: {App},
  template: '<App/>'
})



