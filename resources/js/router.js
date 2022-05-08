
import Vue from 'vue/dist/vue';

import  VueRouter from 'vue-router'; 

import home from './component/pages/home';

import tag from './admin/pages/tag';
import useCom from './vuex/useCom';
import category from './admin/pages/category';


Vue.use(VueRouter);

const routes = [
//home page
   {
    path:"/",
    component : home,
    },



//USEcom page

{
    path:"/testcomponent",
    component : useCom,
    },




//tag page

{
    path:"/tag",
    component : tag,
    },


    //category page

{
    path:"/category",
    component : category,
    },

];

export default new VueRouter({

    mode:'history',
    routes,
    
})