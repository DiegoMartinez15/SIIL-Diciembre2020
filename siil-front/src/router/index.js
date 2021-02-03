import Vue from 'vue'
import store from '../store'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import MainPage from '../views/MainPage.vue'
import Areas from '../components/Areas.vue'
import Usuarios from '../components/Usuarios.vue'
import Empresas from '../components/Empresas.vue'
import Login from '../components/Login.vue'
import Oferta from '../components/HelloWorld.vue'
import AddBussiness from '../components/AddBussiness.vue'
import FormAccept from '../components/FormAccept.vue'
import FormPerfil from '../components/FormularioPerfil.vue'
import FormSeguimiento from '../components/FormularioSeguimiento.vue'
import listaAplicados from '../components/listaAplicados.vue'

Vue.use(VueRouter)


const routes = [{
        path: '/',
        name: 'Home',
        component: Home,
        children: [{
                path: '/usuarios',
                name: 'usuarios',
                component: Usuarios,
                meta: { requiresAuth: true }
            },
            {
                path: '/empresas',
                name: 'empresas',
                component: Empresas,
                meta: { requiresAuth: true }
            },
            {
                path: '/areas',
                name: 'areas',
                component: Areas,
                meta: { requiresAuth: true }
            },
            {
                path: '/ofertas',
                name: 'ofertas',
                component: Oferta,

            },
            {
                path: '/addofertas',
                name: 'add',
                component: AddBussiness,
                meta: { requiresAuth: true }

            },
            {
                path: '/formulario_perfil',
                name: 'formulario',
                component: FormPerfil,
            },
            {
                path: '/formulario_seguimiento',
                name: 'formulario-seguimiento',
                component: FormSeguimiento,
            },
            {
                path: '/aplicados',
                name: 'listaAplicados',
                component: listaAplicados,
                meta: { requiresAuth: true }
            },

        ]
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/MainPage',
        name: 'mainpage',
        component: MainPage
      },
    {
        path: '/about',
        name: 'About',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () =>
            import ( /* webpackChunkName: "about" */ '../views/About.vue')
    },
    {
        path: '/accept',
        name: 'FormAccept',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: FormAccept,
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(route => route.meta.requiresAuth)) {

        if (sessionStorage.getItem('tokenS') != null && localStorage.getItem('token') != null){
            if(store.state.role != 2 ){
                next()
            }else{
                 next('/ofertas')
            }
            
        }else{
             next('/login')

        }




        if (store.state.role != 2 && sessionStorage.getItem('tokenS') != null) {
            next()
        } else {
            next('/ofertas')
        }
    } else {
        next()
    }
});



export default router