<template>
    <div class="card">
        <div class="card-header">Login</div>

        <div v-if="errorMessage" class="card-body text-center bg-danger text-white">
            <p v-for="(error, index) in errors" :key="index">
                {{ error.toString() }}
            </p>
            <p>{{ message }}</p>
        </div>

        <div v-if="successMessage" class="card-body text-center bg-success text-white">
            <p>{{ message }}</p>
        </div>

        <div class="card-body">
            <form v-if="!loading" @submit.prevent="login">
                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                    <div class="col-md-6">
                        <input id="email" type="email"
                               class="form-control"
                               v-model="form.email" required autocomplete="email">
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                    <div class="col-md-6">
                        <input id="password" type="password"
                               class="form-control" v-model="form.password"
                               required autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   v-model="form.remember" value="remember" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Login</button>
                    </div>
                </div>
            </form>

            <div v-else class="text-center">
                <p>Submitting</p>
                <i class="fas fa-spinner fa-spin fa-3x"></i>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                form:{
                    email: '',
                    password: '',
                    remember: null
                },
                errors: [],
                successMessage: false,
                errorMessage: false,
                message: '',
                loading: false
            }
        },

        methods: {
            login(){
                this.loading = true;
                console.log(this.form);
                axios.post('/api/login', this.form)
                    .then((response) => {
                        if(response.data.success === true){
                            this.errorMessage = false;
                            window.location.href = '/user/dashboard'
                        }else{
                            this.errors = response.data.errors;
                            this.errorMessage = true;
                            this.message = response.data.message;
                        }

                        console.log(response.data.message);
                    }).catch((error) => {
                    console.log(error);
                }).finally(() => {
                    this.loading = false;
                });
            },

        }
    }
</script>

<style scoped>

</style>
