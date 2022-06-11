<template>
   <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div v-if="category">
                    <h2>{{ category.name }}</h2>
                <PostCardListComponent :posts="category.posts" />
                </div>



                <div v-else class="col-12 text-center pt-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PostCardListComponent from '../components/PostCardListComponent.vue';

export default {
    name: 'PostsPerCategoryComponent',
    components: {
        PostCardListComponent
    },
    data(){
        return{
            category: undefined,
            posts: []
        }
    },
    mounted(){
        const id = this.$route.params.id;

        window.axios.get('http://127.0.0.1:8000/api/categories/' + id)
        .then(({status, data}) => {
        console.log(data);
        if(status === 200 && data.success){
            this.category = data.results;
        }
        }).catch(e => {
            console.log(e);
        })
    }
}
</script>

<style lang="scss" scoped>

</style>
