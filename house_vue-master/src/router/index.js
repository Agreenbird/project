import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import food from '@/components/food'
import amap from '@/components/amap'
import house_add from '@/components/house_add'
import more_house from '@/components/more_house'
import house_material from '@/components/house_details'
import nav_title from '@/components/nav'
import basics1 from '../components/release/basics1'
import room from '../components/release/room'
import basics2 from '../components/release/basics2'
import basics3 from '../components/release/basics3'
import admin_home from '../components/admin/admin_home'
import user_details from '@/components/user_details'
import user_home_page from '@/components/user_home_page'
import house_audit from '../components/admin/house_audit'
import house_details from '../components/admin/house_details'
import conter_panel from '@/components/landlord/conter_panel'
import story_all from '@/components/story/story_all'
import ery_story from '@/components/story/ery_story'
import write_story from '@/components/story/write_story'


Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/write_story',
      component: write_story
    },
    {
      path: '/amap',
      props: true,
      component: amap
    }
    ,
    {
      path: '/food',
      component: food
    },
    {
      path: '/ery_story/:id',
      props: true,
      component: ery_story
    },
    {
      path: '/story_all',
      name:'story_all',
      component: story_all,
    }
    ,
    {
      path: '/conter_panel',
      component: conter_panel,
    }
    ,
    {
      path: '/more_house',
      name: more_house,
      component: more_house
    },
    {
      path: '/house_material/:id',
      props: true,
      component: house_material
    },
    {
      path: '/admin/home',
      name: admin_home,
      component: admin_home,
      children: [
        {
          path: 'house_audit',
          component: house_audit,
        },
        {
          path: 'house_details/:id',
          props: true,
          component: house_details
        }
      ]
    },
    {
      path: '/user_details',
      name: user_details,
      component: user_details,
    },
    {
      path: '/user_home_page',
      name: user_home_page,
      component: user_home_page

    },
    {
      path: '/basics3',
      name: basics3,
      component: basics3
    },
    {
      path: '/basics1',
      name: basics1,
      component: basics1
    },
    {
      path: '/basics2',
      name: basics2,
      component: basics2
    },
    {
      path: '/',
      name: 'HelloWorld',
      component: HelloWorld
    },
    {
      path: '/house_add',
      name: 'house_add',
      component: house_add
    },
    {
      path: '/nav',
      name: 'nav',
      component: nav_title
    },

    {
      path: '/room',
      name: 'room',
      component: room
    },


  ]
})
