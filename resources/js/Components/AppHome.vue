<template>
   <div>
       <main class="flex-shrink-0">
           <!-- Navigation-->
           <app-menu></app-menu>
          <router-view></router-view>
       </main>
       <!-- Footer-->
        <app-footer></app-footer>
       <!-- Bootstrap core JS-->
   </div>
</template>
<script>
    import AppMenu from './Includes/AppMenu.vue'
    import AppFooter from './Includes/AppFooter.vue'
    export default {
            name:'AppHome',
            components: { AppMenu,AppFooter },
        }

</script>
