
import Vue from 'vue/dist/vue';

import  VueRouter from 'vue-router'; 

import home from './component/pages/home';
import login from './admin/pages/login';
import tag from './admin/pages/tag';
import category from './admin/pages/category';
import tr from './admin/pages/try';
import adminusers from './admin/pages/adminusers'


Vue.use(VueRouter);

const routes = [
//home page
   {
    path:"/",
    component : home,
    },


// login

{
    path:"/login",
    component : login,
    },

    {
        path:"/try",
        component : tr,
        },
    
    
    // login
    
    {
        path:"/login",
        component : login,
        },
    

//admin user
    {
        path: '/adminusers',
        component: adminusers,
        name: 'adminusers'

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