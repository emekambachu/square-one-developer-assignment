<template>
    <div class="card">
        <div class="card-header">Login</div>

        <div class="card-body">
            <form>
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
<!--                        <span v-if="errors.password" class="invalid-feedback" role="alert">-->
<!--                            <strong>{{ errors.password }}</strong>-->
<!--                        </span>-->
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="remember" id="remember">
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
                },
                errors: {},
                successMessage: false,
                errorMessage: false,
                message: '',
                loading: false
            }
        },
    }
</script>

<style scoped>

</style>
