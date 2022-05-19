<template>
    <!-- Featured blog post-->
    <div class="card mb-4">
        <div class="card-body">
            <div class="small text-muted">Published on: {{ post.publication_date }}</div>
            <h2 class="card-title">{{ post.title }}</h2>
            <p v-html="post.description" class="card-text"></p>
            <div class="small text-muted">Author: {{ post.user ? post.user.name : 'Admin' }}</div>
<!--            <a class="btn btn-primary" href="#!">Read more →</a>-->
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            post: {
                type: Object,
                required: false
            }
        },
        methods: {
            fullDate (value){
                return moment(value).format('MMMM Do YYYY, h:mm:ss a');
            }
        }
    }
</script>

<style scoped>

</style>
