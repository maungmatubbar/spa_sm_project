<template>
    <div>
        <section class="py-5">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title text-secondary">Product List</h5>
                        <router-link to="/product/create" class="btn btn-primary">Create New</router-link>
                    </div>
                    <div class="card-body">
                        <table class="table text-center">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <p style="display: none">{{ i=1 }}</p>
                            <tr v-for="(product,index) in products" :key="product.id">
                                <td>{{ i ++ }}</td>
                                <td>{{ product.name }}</td>
                                <td>{{ product.slug }}</td>
                                <td>
                                    <img :src="baseUrl+'/'+product.image" alt="">
                                </td>
                                <td>{{ product.price }}</td>
                                <td>
                                    <span  class="btn-group">
                                         <router-link :to="{ name:'product.edit',params:{ id: product.id } }" class="btn btn-primary">edit</router-link>
                                          <button  @click="destory(product.id,index)" class="btn btn-danger">delete</button>
                                    </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        name: "product.index",
        data(){
            return {
                products: [],
                success:null,
                baseUrl:null
            }
        },
        methods: {
           loadProducts(){
               let loader = this.$loading.show({
                   // Optional parameters
                   container: this.fullPage ? null : this.$refs.formContainer,
                   loader: 'dots',
                   color: '#d35400'

               });
               axios.get('/api/product')
                   .then(res=>{
                   this.products = res.data.data;
                   this.baseUrl = window.location.origin;
               }).catch(error=>{ error.response.data.errors});
               setTimeout(() => {
                   loader.hide()
               }, 2000);
           },
            destory(id,index){
               this.products.splice(index,1)
                axios.delete(`/api/product/${id}`).then(res=>{
                    this.success = res.data.message;
                    this.$swal.fire(
                        {
                            position: 'top-right',
                            icon: 'success',
                            title: this.success,
                            showConfirmButton: false,
                            timer: 1500
                        }
                    );
                }).catch(error=>{console.log(error.response.data.errors)})
            }
        },
        mounted() {
            this.loadProducts();
        }

    }
</script>

<style scoped>
img {
    width: 70px;
    height: 50px;
}
</style>
