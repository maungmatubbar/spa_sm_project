<template>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-5 mx-auto">
                <div class="card rounded-0 shadow-lg">
                    <div class="card-header">
                        <h4 class="card-title text-secondary text-uppercase">Login</h4>
                        <div v-for="error in errors.error">
                            <span class="text-danger">{{ error }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="login">
                            <div class="form-group mb-2">
                                <label for="email">Email:</label>
                                <div class="col-md-12 py-2">
                                    <input type="email" id="email" v-model="form.email" class="form-control rounded-0" placeholder="Enter Email">
                                    <span class="text-danger"  v-for="(error,key) in errors.email" :key="key">
                                       <span v-if="form.email == null">{{ error }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label for="password">Password:</label>
                                <div class="col-md-12 py-2">
                                    <input type="password" id="password" v-model="form.password" class="form-control rounded-0" placeholder="Enter Password">
                                    <span class="text-danger"  v-for="(error,key) in errors.password" :key="key">
                                       <span v-if="form.password == null">{{ error }}</span>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary rounded-0" value="Log In">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "login",
        data(){
            return{
                form:{
                    email: null,
                    password: null
                },
                errors:{}
            }
        },
        methods: {
            login()
            {
                console.log(this.form)
                axios.get('/sanctum/csrf-cookie').then(response => {
                    console.log(response)
                   axios.post('/api/login',this.form).then(res=>{
                      localStorage.setItem('token',res.data.token);
                      localStorage.setItem('user',res.data.data.name);
                       this.$router.push({name: 'dashboard'})
                    }).catch(error=>{
                        this.errors = error.response.data.errors;
                    });
                });
            }
        },
        mounted() {

        }

    }
</script>

<style scoped>

</style>
