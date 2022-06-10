import Vue from 'vue';
import VueRouter from 'vue-router';

import HomeComponent from './pages/HomeComponent';
import ContactsComponent from './pages/ContactsComponent';
import NotFoundComponent from './pages/NotFoundComponent';
import PostsComponent from './pages/PostsComponent';
import ChiSiamoComponent from './pages/ChiSiamoComponent';
import SinglePostComponent from './pages/SinglePostComponent';


Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeComponent
        },
        {
            path: '/posts',
            name: 'posts',
            component: PostsComponent
        },
        {
            path: '/posts/:id',
            name: 'single-post',
            component: SinglePostComponent
        },
        {
            path: '/contacts',
            name: 'contacts',
            component: ContactsComponent
        },
        {
            path: '/chi-siamo',
            name: 'chi-siamo',
            component: ChiSiamoComponent
        },
        {
            path: '/*',
            name: 'notFound',
            component: NotFoundComponent
        }
    ]
})

export default router;
