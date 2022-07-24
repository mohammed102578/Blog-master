import Vue from 'vue/dist/vue';
import  VueRouter from 'vue-router'; 
import home from './component/pages/home';
import login from './admin/pages/login';
import tag from './admin/pages/tag';
import category from './admin/pages/category';
import role from './admin/pages/role';
import assignRole from './admin/pages/assignRole';
import adminusers from './admin/pages/adminusers'


Vue.use(VueRouter);

const routes = [
//home page
   {
    path:"/",
    component : home,
    name : 'home'
    },


// login

{
    path:"/login",
    component : login,
    name : 'login'
    },

    {
        path:"/role",
        component : role,
        name : 'role'
        },
    
    
    // login
    
    {
        path:"/assignRole",
        component : assignRole,
        name : 'assignRole'
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
    name : 'tag'
    },


    //category page

{
    path:"/category",
    component : category,
    name : 'category'
    },

];

export default new VueRouter({

    mode:'history',
    routes,
    
})