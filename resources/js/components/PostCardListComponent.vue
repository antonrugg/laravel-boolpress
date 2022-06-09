<template>
    <section>
        <PostCardComponent :post="post" v-for="(post, index) in posts" :key="index"/>
    </section>
</template>

<script>
import PostCardComponent from './PostCardComponent.vue';

export default {
    name: 'PostCardListComponent',
    props: ['posts'],
    components:{
        PostCardComponent,
    }

}
</script>

<style lang="scss" scoped>
    section{
        display: flex;
        justify-content: flex-start;
        align-items: center;
        align-content: flex-start;
        row-gap: 1.5rem;
        column-gap: 1.5rem;
        flex-wrap: wrap;
        flex-grow: 1;
    }
</style>
