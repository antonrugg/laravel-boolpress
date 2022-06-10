<template>
     <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                Posts
            </div>
            <div v-if="post">
               {{post.title}}
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
        const id = this.$route.params.id;

        window.axios.get('http://127.0.0.1:8000/api/posts/' + id)
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

</style>
