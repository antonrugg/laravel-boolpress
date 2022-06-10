<template>
    <div class="card">
        <div v-if="post.cover">
            <img class="card-img-top" :src="'storage/' + post.cover" :alt="post.title">
        </div>
        <div v-else>
            <img class="card-img-top" src="https://picsum.photos/200/" :alt="post.title">
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ post.title }}</h5>
            <p class="card-text">{{ post.content }}</p>
        </div>
        <router-link :to="{ name: 'single-post', params: { id } }">Visualizza dettaglio</router-link>
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
    img{
        height: 10rem;
    }

   }

</style>
