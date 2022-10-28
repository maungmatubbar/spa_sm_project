<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-lg-top">
        <div class="container px-5">
            <router-link to="/" class="navbar-brand">LOGO</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><router-link to="/" class="nav-link">Home</router-link></li>
                    <li class="nav-item"><router-link to="/about" class="nav-link">About</router-link></li>
                    <li class="nav-item"><router-link to="/category" class="nav-link">Category</router-link></li>
                    <li class="nav-item"><router-link to="/products" class="nav-link">Products</router-link></li>
                    <li class="nav-item"><router-link to="/login" class="nav-link">Login</router-link></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownBlog" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Blog</a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownBlog">
                            <li><a class="dropdown-item" href="blog-home.html">Blog Home</a></li>
                            <li><a class="dropdown-item" href="blog-post.html">Blog Post</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "AppMenu",

    }
</script>

<style scoped>

</style>
