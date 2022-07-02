<template>

    <!-- Blog entries-->
    <div class="col-lg-8">
        <div v-if="posts" class="card mb-4">
            <div v-for="(post, index) in posts.data" :key="post.id" class="card-body">
                <div class="small text-muted">Published on: {{ post.publication_date }}</div>
                <h2 class="card-title">{{ post.title }}</h2>
                <p v-html="post.description" class="card-text"></p>
                <div class="small text-muted">Author: {{ post.user ? post.user.name : 'Admin' }}</div>
                <!--            <a class="btn btn-primary" href="#!">Read more →</a>-->
            </div>
        </div>

        <div v-else>
            <p class="text-center">You have'nt submitted any post yet</p>
        </div>

        <!--Pagination-->
        <laravel-vue-pagination class="justify-content-center"
                                :limit="2"
                                :data="posts"
                                @pagination-change-page="getPosts"
        >
            <template #prev-nav>
                <span>&lt; Previous</span>
            </template>
            <template #next-nav>
                <span>Next &gt;</span>
            </template>
        </laravel-vue-pagination>

    </div>
</template>

<script>
    import LaravelVuePagination from 'laravel-vue-pagination';
    import {
        ContentLoader,
        FacebookLoader,
        CodeLoader,
        BulletListLoader,
        InstagramLoader,
        ListLoader,
    } from 'vue-content-loader';

    export default {
        components: {
            LaravelVuePagination,
            ContentLoader,
            FacebookLoader,
            CodeLoader,
            BulletListLoader,
            InstagramLoader,
            ListLoader,
        },
        data(){
            return {
                posts:[],
                loading: false,
            }
        },
        methods: {
            getPosts(page = 1){
                this.loading = true;
                axios.get('/api/user/my-posts?page=' + page)
                    .then((response) => {
                        if(response.data.success === true){
                            this.loading = false;
                            this.posts = response.data.posts;
                        }else{
                            this.loading = false;
                        }
                        console.log(response.data.posts);
                        console.log(response.data.message);
                    }).catch((error) => {
                    console.log(error);
                });
            },

            fullDate (value){
                return moment(value).format('MMMM Do YYYY, h:mm:ss a');
            }
        },
        mounted(){
            this.getPosts();
        }
    }
</script>

<style scoped>

</style>
