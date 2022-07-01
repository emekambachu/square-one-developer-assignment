<template>
    <div class="card">
        <div class="card-header">Register</div>

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
            <form v-if="!loading" @submit.prevent="register">
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control"
                               v-model="form.name" required autocomplete="name" autofocus>
                        <span v-if="errors.password" class="invalid-feedback" role="alert">
                            <strong>{{ errors.password.toString() }}</strong>
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                    <div class="col-md-6">
                        <input id="email" type="email"
                               class="form-control"
                               v-model="form.email" required autocomplete="email">

                        <span v-if="errors.email" class="invalid-feedback" role="alert">
                            <strong>{{ errors.email.toString() }}</strong>
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                    <div class="col-md-6">
                        <input id="password" type="password"
                               class="form-control" v-model="form.password"
                               required autocomplete="new-password">
                        <span v-if="errors.password" class="invalid-feedback" role="alert">
                            <strong>{{ errors.password }}</strong>
                        </span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm"
                           class="col-md-4 col-form-label text-md-end">Confirm Password</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password"
                               class="form-control" v-model="form.password_confirmation"
                               required autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
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
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                errors: [],
                successMessage: false,
                errorMessage: false,
                message: '',
                loading: false
            }
        },
        methods: {
            register(){
                this.loading = true;
                if(this.form.password !== this.form.password_confirmation){
                    this.loading = false;
                    this.errorMessage = true;
                    this.successMessage = false;
                    this.message = 'Password and password confirm must be equal';
                }
                console.log(this.form);
                axios.post('/api/register', this.form)
                    .then((response) => {
                        if(response.data.success === true){
                            this.successMessage = true;
                            this.errorMessage = false;
                            this.message = response.data.message;
                            this.errors = [];
                            // Empty all fields
                            let self = this;
                            Object.keys(this.form).forEach(function(key,index) {
                                self.form[key] = '';
                            });
                        }else{
                            this.loading = false;
                            this.errors = response.data.errors;
                            this.errorMessage = true;
                            this.successMessage = false;
                            this.message = response.data.message;
                        }
                        console.log(response.data.errors);
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
