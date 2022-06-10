<template>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                Posts
            </div>

            <div v-if="posts.length>0">
                <PostCardListComponent :posts="posts" />
                <button  @click="goFirstPage()">First Page</button>
                <button v-if="previousPageLink" @click="goPreviousPage()">Prev</button>
                <button v-if="nextPageLink" @click="goNextPage()">Next</button>
                <button  @click="goLastPage()">Last Page</button>
                <div>{{currentPage}} / {{lastPage}}</div>

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
            posts: [],
            currentPage: 1,
            lastPage: 1,
            previousPageLink: '',
            nextPageLink: '',
            lastPageLink: '',
            firstPageLink: ''
        }
    },
    mounted(){

        this.loadPage('http://127.0.0.1:8000/api/posts');

    },
    methods:{
        loadPage(url){
            window.axios.get(url)
            .then(({status, data}) => {
            console.log(data);
            if(status === 200 && data.success){
                this.posts = data.results.data;
                this.currentPage = data.results.current_page;
                this.lastPage = data.results.last_page;
                this.previousPageLink = data.results.prev_page_url;
                this.nextPageLink = data.results.next_page_url;
                this.lastPageLink = data.results.last_page_url;
                this.firstPageLink = data.results.first_page_url;
        }
        }).catch(e => {
            console.log(e);
        })
        },
        goNextPage(){
            this.loadPage(this.nextPageLink);
        },

        goPreviousPage(){
            this.loadPage(this.previousPageLink);
        },
        goFirstPage(){
            this.loadPage(this.firstPageLink);
        },
        goLastPage(){
            this.loadPage(this.lastPageLink);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
