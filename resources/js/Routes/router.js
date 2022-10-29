import { createRouter, createWebHistory } from "vue-router";

import Home from "../Components/Home/Home.vue";
import About from "../Components/About/About.vue";
import Category from "../Components/Category/Index.vue";
import CreateCategory from "../Components/Category/Create.vue"
import EditCategory from "../Components/Category/Edit.vue"
import ProductList from "../Components/Product/index.vue";
import CreateProduct from "../Components/Product/create.vue"
import EditProduct from "../Components/Product/edit.vue"
import Login from '../Components/User/login.vue'
import Dashboard from '../Components/Dashboard/dashboard.vue'
const routes = [

    {
        path: '/',
        component : Home,
        name : 'home'
    },
    {
        path: '/about',
        component : About,
        name : 'About'
    },
    {
        path: '/category',
        component : Category,
        name : 'category.index',
        meta:{
            requiresAuth:true
        }
    },
    {
        path: '/category/create',
        component : CreateCategory,
        name : 'category.create',
        meta:{
            requiresAuth:true
        }
    },
    {
        path: '/category/edit/:id',
        component : EditCategory,
        name : 'category.edit',
        meta:{
            requiresAuth:true
        }
    },
    {
        path: '/products',
        component : ProductList,
        name : 'product.index',
        meta:{
            requiresAuth:true
        }
    },
    {
        path: '/product/create',
        component : CreateProduct,
        name : 'product.create',
        meta:{
            requiresAuth:true
        }
    },
    {
        path: '/product/edit/:id',
        component : EditProduct,
        name : 'product.edit',
        meta:{
            requiresAuth:true
        }
    },
    //user login
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta:{
            requiresAuth:false
        }
    },
    {
        path: '/dashboard',
        component: Dashboard,
        name: 'dashboard',
        meta:{
            requiresAuth:true
        }
    }

];


let router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: 'active',
    routes,
});
router.beforeEach((to,from)=>{
   if(to.meta.requiresAuth && !localStorage.getItem('token'))
   {
        return { name: 'login' };
   }
   if(to.meta.requiresAuth == false && localStorage.getItem('token'))
   {
       return { name: 'dashboard' };
   }
});
export default router;

