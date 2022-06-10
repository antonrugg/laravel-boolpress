<template>
    <div class="card">
        <img class="card-img-top" :src="'storage/' + post.cover" :alt="post.title">
        <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <p class="card-text">{{ post.content }}</p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PostCardComponent',
    props: ['post'],
}
</script>

<style lang="scss" scoped>
   .card{
       min-height: 300px;
       width: calc((100% / 4) - 2rem);

       
   }

</style>
