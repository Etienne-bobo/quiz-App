require('./bootstrap');

require('moment');

import Vue from 'vue';

import { InertiaApp } from '@inertiajs/inertia-vue';
import { InertiaForm } from 'laravel-jetstream';
import PortalVue from 'portal-vue';
import vuetify from './Plugins/vuetify'
import 'vuetify/dist/vuetify.min.css';
Vue.mixin({ methods: { route } });
Vue.use(InertiaApp);
Vue.use(InertiaForm);
Vue.use(PortalVue);
const app = document.getElementById('app');

new Vue({
    vuetify,
    render: (h) =>
    h(InertiaApp, {
     props: {
      initialPage: JSON.parse(app.dataset.page),
       resolveComponent: (name) => require(`./Pages/${name}`).default,
      },
    }),
   }).$mount(app);