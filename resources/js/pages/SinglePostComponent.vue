<template>
     <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-2">
                Posts
            </div>
            <div v-if="post" class="col-12 mb-2">
            <h2><span>Title: </span>{{ post.title }}</h2>
            <img v-if="post.cover" :src="'/storage/' + post.cover" :alt="post.title">
            <img v-else src="https://picsum.photos/200/" :alt="post.title">
            <p><span>Contenuto: </span>{{ post.content }}</p>
            <div>
                <h3>Tags:</h3>
                <ul>
                    <li v-for="tag in post.tags" :key="tag.id">
                        {{tag.name}}
                    </li>
                </ul>
            </div>
            <h3>Categoria</h3>
            <p>{{ post.category.name }}</p>
            </div>
            <div v-else class="col-12 text-center pt-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SinglePostComponent',
    data(){
        return{
            post: undefined
        }
    },
    mounted(){
        const slug = this.$route.params.slug;

        window.axios.get('http://127.0.0.1:8000/api/posts/' + slug)
        .then(({status, data}) => {
        console.log(data);
        if(status === 200 && data.success){
            this.post = data.results;
        }
        }).catch(e => {
            console.log(e);
        })
    }
}
</script>

<style lang="scss" scoped>
img{
    width: 200px;
}

</style>
