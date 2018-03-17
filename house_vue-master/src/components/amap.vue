<template>
  <div>

    <el-amap vid="amapDemo" style="height: 300px;" :zoom="zoom" :events="events" :plugin="plugin"
             :center="[longitude,latitude]" :amap-manager="maps">
      <div class="toolbar" v-if="!show_location">
        地理坐标: [{{ lng }}, {{ lat }}] {{ address }}
      </div>
      <div class="toolbar" v-if="show_location">
        地理坐标: [{{ longitude }}, {{ latitude }}]{{ location.state+location.city+location.street+location.plot}}
      </div>
      <el-amap-marker v-if="show" :position="[longitude,latitude]">
      </el-amap-marker>
      <el-amap-marker :position="[lng,lat]">
      </el-amap-marker>
    </el-amap>

  </div>

</template>

<script>
  import {maps} from 'vue-amap';
  import $ from 'jquery'

  export default {
    name: 'amap',
    // props: ['location'],
    data() {
      let self = this;
      return {
        location:{},
        show_location: true,
        show: true,
        maps,
        plugin: ['Geocoder'],
        zoom: 15,
        address: '',
        events: {
          click(e) {
            self.show_location = false
            let {lng, lat} = e.lnglat;
            self.lng = lng;
            self.lat = lat;

            $.get('http://restapi.amap.com/v3/geocode/regeo?key=bf5b356d3ffaab642c974983267b1ce8&location=' + lng + ',' + lat)
              .then(function (data) {
                self.address = data.regeocode.formatted_address
              })
          }
        },
        lng: 0,
        lat: 0,
        longitude: 0,
        latitude: 0,
      };
    },
    props:['state','city','street','plot'],
    watch: {
      lng() {
        this.show = false;
      },
      'location': {
        handler() {
          let me = this;
          $.get('http://restapi.amap.com/v3/geocode/geo?key=bf5b356d3ffaab642c974983267b1ce8&city=' + this.location.city + '&address=' + this.location.street + this.location.plot)
            .then(function (data) {
              let center_ = data.geocodes[0].location;
              let su = center_.split("");
              let longitude = '';
              let latitude = '';
              su.forEach(function (item, index) {
                console.log("item",item);
                if (index < 10) {
                  longitude += item;
                }
                else if (index > 10) {
                  latitude += item;
                }
              })
              me.longitude = parseFloat(longitude);
              me.latitude = parseFloat(latitude);
            })
        },
        deep: true,
      },
    },
    created: function () {
      let me = this;
      this.location.state=this.state;
      this.location.city=this.city;
      this.location.street=this.street;
      this.location.plot=this.plot;
console.log("this.plot",this.plot);
      $.get('http://restapi.amap.com/v3/geocode/geo?key=bf5b356d3ffaab642c974983267b1ce8&city=' + this.location.city + '&address=' + this.location.street + this.location.plot)
        .then(function (data) {
          let center_ = data.geocodes[0].location;
          let su = center_.split("");
          let longitude = '';
          let latitude = '';
          su.forEach(function (item, index) {
            console.log("item",item);
            if (index < 10) {
              longitude += item;
            }
            else if (index > 10) {
              latitude += item;
            }
          })
          me.longitude = parseFloat(longitude);
          me.latitude = parseFloat(latitude);
        })




    },
    computed: {
      // location() {
      //   return location;
      //   let new_house = this.$store.getters['get_new_house']
      //   return new_house.location;
      // }
    }
  };
</script>
