<template>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <notifications />
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-secondary">Add New Category</h5>
                            <router-link to="/category" class="btn btn-primary">Category List</router-link>
                        </div>
                        <div v-if="success" class="alert alert-warning alert-dismissible fade show" role="alert">{{ success }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div class="card-body">

                            <form @submit.prevent="submit">
                                <div class="row">
                                    <label for="name" class="col-md-3">Category Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="name" v-model="categoryForm.name" name="name" class="form-control" placeholder="Enter Category Name">
                                        <div v-for="(error, key) in errors.name" class="text-danger" :key="key">
                                            <p v-if="categoryForm.name==null">{{ error }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-outline-success" :disabled="categoryForm.busy">CREATE</button>
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
    import Form from 'vform'
    export default {
        name: "category.create",
       data()
       {
           return {

               categoryForm: new Form({
                   name:null
               }),
               errors: {},
               success: null
           }

       },
        methods: {
            submit(){
                this.create()
            },
             create() {
                axios.post('/api/category',this.categoryForm).then(res => {
                    this.success = res.data.message;
                    this.message = res.data.message;
                    this.$notify({
                        title: 'SUCCESS',
                        text: this.success,
                        duration: 10000,
                        closeOnClick:true,
                        type: 'success',
                    });
                    this.categoryForm.name = null;
                }).catch(error=>{
                    this.errors = error.response.data.errors;
                })

            },

        }
    }
</script>

<style scoped>

</style>
