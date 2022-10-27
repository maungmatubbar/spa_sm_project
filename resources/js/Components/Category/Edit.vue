<template>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <notifications />
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-secondary">Edit Category</h5>
                            <router-link to="/category" class="btn btn-primary">Category List</router-link>
                        </div>
                        <div class="card-body">
                            <p v-if="success" class="card-title alert alert-info ">{{ success }}
                            </p>
                            <form @submit.prevent="submit">
                                <div class="row">
                                    <label for="name" class="col-md-3">Category Name</label>
                                    <div class="col-md-6">
                                        <input type="text" id="name" v-model="categoryForm.name" name="name" class="form-control" placeholder="Enter Category Name">
                                        <div v-for="(error, key) in errors.name" class="text-danger" :key="key">
                                            <p>{{ error }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-outline-success" :disabled="categoryForm.busy">UPDATE</button>
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
        name: "category.edit",
        data()
        {
            return {
                categoryForm: new Form({
                    name:null
                }),
                errors: {},
                success: null,

            }

        },
        methods: {
            submit(){
                this.update()
            },
            update() {
               let id = this.$route.params.id
               // let id = props.id
                axios.patch(`/api/category/${id}`,this.categoryForm).then(res => {
                    this.success = res.data.message;
                    this.$swal.fire(
                        {
                            position: 'top-end',
                            icon: 'success',
                            title: this.success,
                            showConfirmButton: false,
                            timer: 1500
                        }
                    );
                    this.$router.push('/category');
                }).catch(error=>{
                    this.errors = error.response.data.errors;
                })

            },
            getCategory() {
                let id = this.$route.params.id//should return id of URL param
                axios.get(`/api/category/${id}/edit`).then(res=>{
                     this.categoryForm.name = res.data.data.name;
                })
            },
        },
        mounted() {
           this.getCategory();
        }
    }
</script>

<style scoped>

</style>
