<template>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Categories</h2>
            </div>

            <div v-if="categories.length>0">
                <ul>
                    <li v-for="category in categories" :key="category.id">
                        <router-link :to="{ name: 'post-per-category', params: { id: category.id } }">{{ category.name }}</router-link>
                    </li>
                </ul>


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
    name: 'CategoriesComponent',
    data(){
        return{
            categories: []
        }
    },
    mounted(){

        this.loadPage('http://127.0.0.1:8000/api/categories');

    },
    methods:{
        loadPage(url){
            window.axios.get(url)
            .then(({status, data}) => {
            console.log(data);
            if(status === 200 && data.success){
                this.categories = data.results;
        }
        }).catch(e => {
            console.log(e);
        })
        },
    }
}
</script>

<style lang="scss" scoped>

</style>
