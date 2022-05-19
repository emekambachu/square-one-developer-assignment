<template>

    <div class="card">
        <div class="card-header">
            Create post
        </div>
        <div class="card-body">
            <div v-if="errorMessage" class="card-body text-center bg-danger text-white">
                <p v-for="(error, index) in errors" :key="index">
                    {{ error.toString() }}
                </p>
                <p>{{ message }}</p>
            </div>

            <div v-if="successMessage" class="card-body text-center bg-success text-white">
                <p>{{ message }}</p>
            </div>

            <form v-if="!loading" @submit.prevent="submitPost">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-4">
                            <label>Title</label>
                            <input v-model="form.title" class="form-control" required>
                        </div>
                        <div class="form-group mb-4">
                            <label>Description</label>
                            <ckeditor :editor="editor" v-model="form.description"
                                      :config="editorConfig"></ckeditor>
                        </div>
                        <div class="form-group mb-4">
                            <label>Save</label>
                            <select class="form-control" v-model="form.published" required>
                                <option value="" selected>Select</option>
                                <option value="0">Save as draft</option>
                                <option value="1">Publish</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-info" type="submit">Submit</button>
                        </div>

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
    // import CkEditor in current component to work
    import CKEditor from '@ckeditor/ckeditor5-vue';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
    export default {
        components: {
            // Use the <ckeditor> component in this view.
            ckeditor: CKEditor.component
        },
        data(){
            return {
                form: {
                    title: '',
                    description: '',
                    published: ''
                },
                editor: ClassicEditor,
                editorConfig: {
                    // The configuration of the editor.
                },
                errors: {},
                successMessage: false,
                errorMessage: false,
                message: '',
                loading: false
            }
        },
        methods: {
            submitPost(){
                this.loading = true;
                console.log(this.form);
                axios.post('/api/user/post', this.form)
                    .then((response) => {
                        response.data.success === true ? this.postSuccess(response) : [
                            this.errors = response.data.errors,
                            this.errorMessage = true,
                            this.message = response.data.message,
                        ];
                        console.log(response.data.errors);
                    }).catch((error) => {
                    console.log(error);
                }).finally(() => {
                    this.loading = false;
                });
            },
            postSuccess(response){
                this.successMessage = true;
                this.errorMessage = false;
                this.message = response.data.message;
                this.errors = {};

                // Empty all fields
                let self = this;
                Object.keys(this.form).forEach(function(key,index) {
                    self.form[key] = '';
                });
            }
        }
    }
</script>

<style scoped>

</style>
