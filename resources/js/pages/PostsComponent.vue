<template>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                Posts
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PostsComponent',
    mounted(){
        window.axios.get('http://127.0.0.1:8000/api/posts')
        .then(results => {
        console.log(results);
        }).catch(e => {
            console.log(e);
        })



    }
}
</script>

<style lang="scss" scoped>

</style>
