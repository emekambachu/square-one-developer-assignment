<template>
    <!-- Featured blog post-->
    <div v-for="(post, index) in posts" :key="post.id" class="card mb-4">
        <a href="#!">
            <img class="card-img-top"
                 src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
        <div class="card-body">
            <div class="small text-muted">{{ post.publication_date }}</div>
            <h2 class="card-title">{{ post.title }}</h2>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam. Dicta expedita corporis animi vero voluptate voluptatibus possimus, veniam magni quis!</p>
            <a class="btn btn-primary" href="#!">Read more →</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            posts: Object
        }
    }
</script>

<style scoped>

</style>
