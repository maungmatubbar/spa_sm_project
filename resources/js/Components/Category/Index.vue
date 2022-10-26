<template>
    <div>
        <section class="py-5">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-secondary">Categories</h5>
                            <router-link to="/category/create" class="btn btn-primary">Create Category</router-link>
                        </div>
                        <div class="card-body">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <p style="display: none">{{ i=1 }}</p>
                                    <tr v-for="(category,index) in categories" :key="category.id">
                                        <td>{{ i ++ }}</td>
                                        <td>{{ category.name }}</td>
                                        <td>{{ category.slug }}</td>
                                        <td>
                                            <span  class="btn-group">
                                                 <router-link :to="{ name:'category.edit',params:{ id: category.id } }" class="btn btn-primary">edit</router-link>
                                                  <button  @click="destory(category.id,index)" class="btn btn-danger">delete</button>
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
        name: "'category.index",
        data(){
            return {
                categories: [],
                success:null
            }
        },
        methods: {
            loadCategories: function () {
                axios.get('api/category').then(res=>{
                    this.categories = res.data.data;
                })
            },
            destory:function (id,index) {
                this.categories.splice(index,1);
                axios.delete(`/api/category/${id}`).then(res=>{
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
                });

            }
        },
        mounted() {
            this.loadCategories();
        }
    }
</script>

<style scoped>

</style>
