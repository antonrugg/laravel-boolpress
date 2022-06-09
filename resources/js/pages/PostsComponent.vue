<template>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                Posts
            </div>
            <div v-if="posts.length>0">
                <PostCardListComponent :posts="posts" />
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
import PostCardListComponent from '../components/PostCardListComponent.vue';

export default {
    name: 'PostsComponent',
    components:{
        PostCardListComponent,
    },
    data(){
        return{
            posts: []
        }
    },
    mounted(){
        window.axios.get('http://127.0.0.1:8000/api/posts')
        .then(({status, data}) => {
        console.log(data);
        if(status === 200 && data.success){
            this.posts = data.results;
        }
        }).catch(e => {
            console.log(e);
        })



    }
}
</script>

<style lang="scss" scoped>

</style>
