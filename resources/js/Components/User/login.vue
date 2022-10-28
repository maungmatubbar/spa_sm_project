<template>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center text-secondary text-uppercase">Login</h4>
                        <form action="">
                            <div class="row mb-3">
                                <label for="email" class="col-md-3">Email</label>
                                <div class="col-md-9">
                                    <input type="email" id="email" class="form-control rounded-0" placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-md-3">Password</label>
                                <div class="col-md-9">
                                    <input type="password" id="password" class="form-control rounded-0" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-9 offset-3">
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
                }
            }
        },
        methods: {
            login()
            {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    // Login...
                });
            }
        }
    }
</script>

<style scoped>

</style>
