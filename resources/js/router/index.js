import Vue from 'vue'
import VueRouter from 'vue-router'

import Login from '../views/Auth/Login.vue'
import Register from '../views/Auth/Register.vue'

import Blog from '../views/Web/Blog.vue'
import Post from '../views/Web/Post.vue'
import Category from '../views/Web/Category.vue'
import Tag from '../views/Web/Tag.vue'

import ProfileForm from '../views/ProfileForm.vue'

import Equipo from '../views/Web/Equipo.vue'
import Material from '../views/Web/Material.vue'
import Obrero from '../views/Web/Obrero.vue'
import Transporte from '../views/Web/Transporte.vue'
import Oferta from '../views/Web/Oferta.vue'

import UserIndex from '../views/Admin/User/Index.vue'
import UserForm from '../views/Admin/User/Form.vue'
import RoleIndex from '../views/Admin/Role/Index.vue'
import PermissionIndex from '../views/Admin/Permission/Index.vue'


import CategoryIndex from '../views/Category/Index.vue'
import CategoryForm from '../views/Category/Form.vue'

import PostIndex from '../views/Post/Index.vue'
import PostShow from '../views/Post/Show.vue'
import PostForm from '../views/Post/Form.vue'

import TagIndex from '../views/Tag/Index.vue'
import TagForm from '../views/Tag/Form.vue'


import GrupoEquipoIndex from '../views/Data/GrupoEquipo/Index.vue'
import GrupoEquipoForm from '../views/Data/GrupoEquipo/Form.vue'
import EquipoIndex from '../views/Data/Equipo/Index.vue'
import EquipoForm from '../views/Data/Equipo/Form.vue'

import GrupoMaterialIndex from '../views/Data/GrupoMaterial/Index.vue'
import GrupoMaterialForm from '../views/Data/GrupoMaterial/Form.vue'
import MaterialIndex from '../views/Data/Material/Index.vue'
import MaterialForm from '../views/Data/Material/Form.vue'

import GrupoObreroIndex from '../views/Data/GrupoObrero/Index.vue'
import GrupoObreroForm from '../views/Data/GrupoObrero/Form.vue'
import ObreroIndex from '../views/Data/Obrero/Index.vue'
import ObreroForm from '../views/Data/Obrero/Form.vue'

import TransporteIndex from '../views/Data/Transporte/Index.vue'
import TransporteForm from '../views/Data/Transporte/Form.vue'

import GrupoPrecioIndex from '../views/GrupoPrecio/Index.vue'
import GrupoPrecioForm from '../views/GrupoPrecio/Form.vue'
import PrecioIndex from '../views/Precio/Index.vue'
import PrecioShow from '../views/Precio/Show.vue'
import PrecioForm from '../views/Precio/Form.vue'

import ProyectoIndex from '../views/Proyecto/Index.vue'
import ProyectoShow from '../views/Proyecto/Show.vue'
import ProyectoForm from '../views/Proyecto/Form.vue'


import OfertaIndex from '../views/Oferta/Index.vue'
import OfertaForm from '../views/Oferta/Form.vue'

import ZonaIndex from '../views/Zona/Index.vue'
import ZonaForm from '../views/Zona/Form.vue'

import NotFound from '../views/NotFound.vue'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [

        { path: '/', component: Blog},
        { path: '/post/:slug', component: Post},
        { path: '/category/:slug', component: Category},
        { path: '/tag/:slug', component: Tag},

        { path: '/equipo', component: Equipo},
        { path: '/material', component: Material},
        { path: '/obrero', component: Obrero},
        { path: '/transporte', component: Transporte},
        { path: '/oferta', component: Oferta},

        { path: '/profile/:id/edit', component: ProfileForm, meta: { mode: 'edit' }},

        { path: '/users', component: UserIndex},
        { path: '/users/create', component: UserForm, meta: { mode: 'create' }},
        { path: '/users/:id/edit', component: UserForm, meta: { mode: 'edit' }},

        { path: '/roles', component: RoleIndex},
        { path: '/permissions', component: PermissionIndex},


        { path: '/categories', component: CategoryIndex},
        { path: '/categories/create', component: CategoryForm, meta: { mode: 'create' }},
        { path: '/categories/:id/edit', component: CategoryForm, meta: { mode: 'edit' }},

        { path: '/posts', component: PostIndex},
        { path: '/posts/create', component: PostForm, meta: { mode: 'create' }},
        { path: '/posts/:id/edit', component: PostForm, meta: { mode: 'edit' }},
        { path: '/posts/:id', component: PostShow },

        { path: '/tags', component: TagIndex},
        { path: '/tags/create', component: TagForm, meta: { mode: 'create' }},
        { path: '/tags/:id/edit', component: TagForm, meta: { mode: 'edit' }},


        { path: '/grupo_equipos', component: GrupoEquipoIndex},
        { path: '/grupo_equipos/create', component: GrupoEquipoForm, meta: { mode: 'create' }},
        { path: '/grupo_equipos/:id/edit', component: GrupoEquipoForm, meta: { mode: 'edit' }},

        { path: '/equipos', component: EquipoIndex},
        { path: '/equipos/create', component: EquipoForm, meta: { mode: 'create' }},
        { path: '/equipos/:id/edit', component: EquipoForm, meta: { mode: 'edit' }},

        { path: '/grupo_materials', component: GrupoMaterialIndex},
        { path: '/grupo_materials/create', component: GrupoMaterialForm, meta: { mode: 'create' }},
        { path: '/grupo_materials/:id/edit', component: GrupoMaterialForm, meta: { mode: 'edit' }},

        { path: '/materials', component: MaterialIndex},
        { path: '/materials/create', component: MaterialForm, meta: { mode: 'create' }},
        { path: '/materials/:id/edit', component: MaterialForm, meta: { mode: 'edit' }},

        { path: '/grupo_obreros', component: GrupoObreroIndex},
        { path: '/grupo_obreros/create', component: GrupoObreroForm, meta: { mode: 'create' }},
        { path: '/grupo_obreros/:id/edit', component:GrupoObreroForm, meta: { mode: 'edit' }},

        { path: '/obreros', component: ObreroIndex},
        { path: '/obreros/create', component: ObreroForm, meta: { mode: 'create' }},
        { path: '/obreros/:id/edit', component: ObreroForm, meta: { mode: 'edit' }},

        { path: '/transportes', component: TransporteIndex},
        { path: '/transportes/create', component: TransporteForm, meta: { mode: 'create' }},
        { path: '/transportes/:id/edit', component: TransporteForm, meta: { mode: 'edit' }},

 
        { path: '/grupo_precios', component: GrupoPrecioIndex},
        { path: '/grupo_precios/create', component: GrupoPrecioForm, meta: { mode: 'create' }},
        { path: '/grupo_precios/:id/edit', component: GrupoPrecioForm, meta: { mode: 'edit' }},

        { path: '/precios', component: PrecioIndex},
        { path: '/precios/create', component: PrecioForm, meta: { mode: 'create' }},
        { path: '/precios/:id/edit', component: PrecioForm, meta: { mode: 'edit' }},
        { path: '/precios/:id', component: PrecioShow},

        { path: '/proyectos', component: ProyectoIndex},
        { path: '/proyectos/create', component: ProyectoForm},
        { path: '/proyectos/:id/edit', component: ProyectoForm, meta: { mode: 'edit' }},
        { path: '/proyectos/:id', component: ProyectoShow},

        { path: '/ofertas', component: OfertaIndex},
        { path: '/ofertas/create', component: OfertaForm, meta: { mode: 'create' }},
        { path: '/ofertas/:id/edit', component: OfertaForm, meta: { mode: 'edit' }},

        { path: '/zonas', component: ZonaIndex},
        { path: '/zonas/create', component: ZonaForm, meta: { mode: 'create' }},
        { path: '/zonas/:id/edit', component: ZonaForm, meta: { mode: 'edit' }},

        { path: '/login', component: Login },
        { path: '/register', component: Register },
        { path: '/not-found', component: NotFound },
        { path: '*', component: NotFound }

    ]
})

export default router