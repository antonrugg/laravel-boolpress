<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">BOOLPRESS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item" v-for="(navLink, index) in navLinks" :key="index">
        <router-link class="nav-link" :to="{ name: navLink.linkName}">{{navLink.label}}</router-link>
      </li>
    </ul>
  </div>
</nav>
</template>

<script>
export default {
    name: 'NavbarComponent',
    data(){
        return{
            navLinks: [
                {linkName: 'home', label: 'Home'},
                {linkName: 'posts', label: 'Posts'},
                {linkName: 'contacts', label: 'Contatti'},
                {linkName: 'chi-siamo', label: 'Chi siamo'},
                {linkName: 'categories', label: 'Categorie'}
            ]
        }
    }
}
</script>

<style lang="scss" scoped>

</style>
