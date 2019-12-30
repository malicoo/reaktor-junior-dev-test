/**
 * @author  Malico
 * @email <hi@malico.me>
 */

import Vue from 'vue';
import VueRouter from 'vue-router';
import InfiniteLoading from 'vue-infinite-loading';

Vue.use(VueRouter);
Vue.use(InfiniteLoading, { /* options */ });

const mixins = {
    computed: {
        config() { return window.config; }
    }
};

Vue.mixin(mixins);

const router = new VueRouter(

    {
        mode: 'history',

        routes: [

            {
                path: '/',
                component: require('./views/App.vue').default,
                children: [

                    {
                        path: '',
                        name: 'home',
                        component: require('./views/Home.vue').default
                    },

                    {
                        path: ':p',
                        name: 'package',
                        component: require('./views/Package.vue').default
                    }
                ]
            }

        ]
    });

new Vue(

    {
        router,
        el: '#app',

    }
)