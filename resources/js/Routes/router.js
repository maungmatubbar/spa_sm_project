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
        name : 'category.index'
    },
    {
        path: '/category/create',
        component : CreateCategory,
        name : 'category.create'
    },
    {
        path: '/category/edit/:id',
        component : EditCategory,
        name : 'category.edit',
    },
    {
        path: '/products',
        component : ProductList,
        name : 'product.index'
    },
    {
        path: '/product/create',
        component : CreateProduct,
        name : 'product.create'
    },
    {
        path: '/product/edit/:id',
        component : EditProduct,
        name : 'product.edit',
    },
    //user login
    {
        path: '/login',
        component: Login,
        name: 'login'
    }

];


let router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: 'active',
    routes,
});

export default router;

