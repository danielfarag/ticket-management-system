require('./bootstrap');
require('./fontawesome')

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import Toaster from "@meforma/vue-toaster";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import moment from 'moment'
import { InertiaProgress } from '@inertiajs/progress'
import Select2 from 'vue3-select2-component';
import VueClipboard from 'vue3-clipboard'

import Datepicker from 'vue3-date-time-picker';
import VueSplide from '@splidejs/vue-splide';
import Editor from '@tinymce/tinymce-vue';
import mitt from 'mitt';
const emitter = mitt();

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    const vue = createApp({ render: () => h(App, props) })
      .provide('$api', axios)
      .use(plugin)
      .use(Toaster,{
        position: 'top-right'
      })
      .use( VueSplide )
      .use( VueClipboard, {
        autoSetContainer: true,
        appendToBody: true,
      } )
      .component('Select2', Select2)
      .component('Editor', Editor)
      .component('Datepicker', Datepicker)
      .mixin({
        data:function(){
          return {
            editorApiKey: "6dlcegcz56ncgl8zba1f5v35a6ia3p330am4r3ndaajj6zv2",
            emitter: emitter
          }
        },
        methods:{
          $route:route,
          moment:(value, formate = 'MM/DD/YYYY hh:mm')=>{
            return moment(String(value)).format(formate)
          },
          fromNow:(value)=>{
            return moment(value).fromNow()
          },
          isUndefined:(value, default_value = null)=>{
            return value === undefined ? default_value : value;
          },
          routeIs:(target, current)=>{
            if(typeof target !== 'object' && target.includes('.*')){
              let _target = target.split('.')[0];
              let _current = current.split('.')[0];

              return _target == _current;
            }else{
              let route_name = target;
              let args = {};

              if(typeof target === 'object'){
                route_name = target.route;
                args = target.args
              }else{
                route_name = target;
              }

              try {
                return route(route_name, args) == route(current,args);
              } catch (error) {
                return false;
              }

            }
          }
        }
      })
      .component("font-awesome-icon", FontAwesomeIcon)
      .mount(el)

    return vue;
  },
})


InertiaProgress.init()