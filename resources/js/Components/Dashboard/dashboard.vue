<template>
    <div class="row py-5">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Dashboard</h4>
                    <button class="btn btn-secondary" @click="logout">Logout</button>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { useRouter } from 'vue-router';
    export default {
        name: "dashboard",
        setup(){
            const router = useRouter();
            function logout(){
                localStorage.removeItem('token');
                localStorage.removeItem('user');
                router.push({ name:'home' });
            }
            return {
                logout,
            }
        }
    }
</script>

<style scoped>

</style>
