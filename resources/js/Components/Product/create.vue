<template>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <notifications />
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-secondary">Create New Product</h5>
                            <router-link to="/products" class="btn btn-primary">Product List</router-link>
                        </div>
                        <div v-if="success" class="alert alert-warning alert-dismissible fade show" role="alert">{{ success }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div class="card-body">
                            <form @submit.prevent="submit" enctype="multipart/form-data">
                                <div class="row mb-3">
                                    <label for="name" class="col-md-3">Product Name</label>
                                    <div class="col-md-9">
                                        <input type="text" id="name" v-model="form.name" name="name" class="form-control" placeholder="Enter Name">
                                        <div v-for="error in errors.name">
                                            <span class="text-danger">{{ error }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="price" class="col-md-3">Product Price</label>
                                    <div class="col-md-9">
                                        <input type="text" id="price" v-model="form.price" name="price" class="form-control" placeholder="Enter Price">
                                        <div v-for="error in errors.price">
                                            <span class="text-danger">{{ error }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="image" class="col-md-3">Product Image</label>
                                    <div class="col-md-9">
                                        <input type="file" id="image" @change="onChange" name="image" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="description" class="col-md-3">Description</label>
                                    <div class="col-md-9">
                                        <textarea name="description" v-model="form.description" id="description" cols="30" rows="5" class="form-control" placeholder="Enter Description"></textarea>
                                        <div v-for="error in errors.description">
                                            <span class="text-danger">{{ error}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-9 offset-3">
                                      <button type="submit" class="btn btn-outline-success">CREATE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "product.create",

        data(){
            return {
                form:{
                    name: null,
                    price: null,
                    image: null,
                    description: null,
                },
                errors:{},
                success:null,
            }
        },
        methods:{
            submit(){
                this.create();
            },
            onChange(e){
                const file = e.target.files[0];
                this.form.image = file;
                console.log(this.form);
            },
            create(){
                const config = {
                    headers:{
                        'content-type' : 'multipart/form-data'
                    }
                }
                axios.post('/api/product',this.form,config).then(res=>{
                    this.success = res.data.message;
                    this.$notify({
                        title: 'SUCCESS',
                        text: this.success,
                        duration: 10000,
                        closeOnClick:true,
                        type: 'success',
                    });
                    this.form.name  = null;
                    this.form.price = null;
                    this.form.image = '';
                    this.form.description = null;
                }).catch(error=>{
                    this.errors = error.response.data.errors;
                })
            }
        }


    }
</script>

<style scoped>

</style>
