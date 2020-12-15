<template>
  <v-app id="inspire"  >
    <!--:src="'/img/login.jpg'"   Esta es la imagen del sidebar   -->
    <v-navigation-drawer
      v-model="drawer"
      :clipped="$vuetify.breakpoint.lgAndUp"
       permanent
        expand-on-hover
      app
    >
    <div class="background blue-grey darken-3 ">

     <v-list>
          <v-list-item class="px-2">
        <v-list-item-avatar
        size="45">
          <v-img :src="'/itcha/escudo.png'" ></v-img>
        </v-list-item-avatar>
        <v-list-item-title class="tittle white--text">{{$store.state.name}}</v-list-item-title>
      </v-list-item>
        </v-list>
        <v-divider></v-divider>
    </div>
  
      <v-list dense >
      <template>
          <v-list-item class="mt-2 mb-2" link :to="{path:'/ofertas'}">
              <v-list-item-action>
                <v-icon>home</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Inicio</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
      </template>
      <v-divider></v-divider>
      <!-- Menu desplegable  v-show="admin == true" -->
      <v-list-group v-show="egresado == true">
        <template  slot="activator">
          
              <v-list-item-action>
                <v-icon>mdi mdi-account</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Menu Egresado</v-list-item-title>
              </v-list-item-content>
          
        </template>
        <!--Menu de categoria-->

        <v-list-item link :to="{path:'/ofertas'}">
              <v-list-item-action>
                <v-icon>mdi mdi-worker</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Ofertas de Empleo</v-list-item-title>
              </v-list-item-content>
         </v-list-item>  
            <!--MENU DE MARCAS-->
                 
            <!--Menu de Producto--> 
            <v-list-item link :to="{path: '#'}">
              <v-list-item-action>
                <v-icon>mdi mdi-file-pdf</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Descargar Formularios</v-list-item-title>
              </v-list-item-content>
            </v-list-item> 
        </v-list-group> 
             

        <v-list-group v-show="show == true"  >
        <template slot="activator" >
          
              <v-list-item-action>
                <v-icon>admin_panel_settings</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Menu administrador</v-list-item-title>
              </v-list-item-content>
          
        </template>
        <!--Menu de administrador-->
      
        <v-list-item link :to="{path:'/addofertas'}">
              <v-list-item-action>
                <v-icon>mdi mdi-bookmark-plus</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Añadir Ofertas</v-list-item-title>
              </v-list-item-content>
         </v-list-item>  
            <!--MENU DE MARCAS-->
            <v-list-item link :to="{path:'/empresas'}"><!--ESTA FORMA FUNCIONA BIEN ASI SE DECLARAN LAS RUTAS-->
              <v-list-item-action>
                <v-icon>apartment</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Empresas</v-list-item-title>
              </v-list-item-content>
            </v-list-item>      
            <!--Menu de Producto--> 
            <v-list-item link :to="{path:'/formulario_perfil'}">
              <v-list-item-action>
                <v-icon>school</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Formulario Registro Perfil</v-list-item-title>
              </v-list-item-content>
            </v-list-item> 

              <v-list-item link :to="{path:'/areas'}">
              <v-list-item-action>
                <v-icon>category</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Areas</v-list-item-title>
              </v-list-item-content>
            </v-list-item> 

            <v-list-item link :to="{path:'/#'}">
              <v-list-item-action>
                <v-icon>file_copy</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Reportes</v-list-item-title>
              </v-list-item-content>
            </v-list-item> 
            


      </v-list-group>


        <!--menu para seguridad-->
        <v-list-group v-show="show == true">
          <template slot="activator">
                <v-list-item-action>
                    <v-icon>supervised_user_circle</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                  <v-list-item-title>Gestion de Usuarios</v-list-item-title>
                </v-list-item-content>
          </template>
            <v-list-item link :to="{path:'/usuarios'}">
              <v-list-item-action>
                <v-icon>verified_user</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>administradores</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
        </v-list-group>
        
        <!--Menu de Repostes-->
        <v-list-group v-show ="egresado == true"> <!--menu desplegable para reporte-->
          <template slot="activator">
                <v-list-item-action>
                    <v-icon>library_books</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                  <v-list-item-title>Formularios</v-list-item-title>
                </v-list-item-content>
          </template>
          <v-list-item link :to="{path:'/formulario_perfil'}" ><!--menu de roles-->
            <v-list-item-action>
              <v-icon>picture_as_pdf</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Formulario Perfil Ocupacional</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item link :to="{path:'/formulario_seguimiento'}"> 
            <v-list-item-action>
              <v-icon>picture_as_pdf</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Formularios Seguimiento a Graduado</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item link> <!-- MENU DE pedido anuilados-->
            <v-list-item-action>
              <v-icon>picture_as_pdf</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Formularios 3</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-group>

        <v-list-group v-show="show == true">
        <template slot="activator">
          
              <v-list-item-action>
                <v-icon>leaderboard</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Estadisticas</v-list-item-title>
              </v-list-item-content>
          
        </template>
        <!--Menu de categoria-->

        <v-list-item link :to="{path:'#'}">
              <v-list-item-action>
                <v-icon>multiline_chart</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Estadistica 1</v-list-item-title>
              </v-list-item-content>
         </v-list-item>  
            <!--MENU DE MARCAS-->
            <v-list-item link :to="{path:'#'}"><!--ESTA FORMA FUNCIONA BIEN ASI SE DECLARAN LAS RUTAS-->
              <v-list-item-action>
                <v-icon>trending_up</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Estadistica 2</v-list-item-title>
              </v-list-item-content>
            </v-list-item>      
            <!--Menu de Producto--> 
            <v-list-item link :to="{path: '#'}">
              <v-list-item-action>
                <v-icon>bubble_chart</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Estadistica 3</v-list-item-title>
              </v-list-item-content>
            </v-list-item> 
        </v-list-group>

<v-divider></v-divider>
        <template>
          <v-list-item class="mt-2 mb-2">
              <v-list-item-action>
                <v-icon>exit_to_app</v-icon>
              </v-list-item-action>
              <v-list-item-content style="margin-left:-20px">
                <v-list-item-title><v-btn style="border:2px solid grey" @click="logout()">
                 Cerrar Session</v-btn></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          <!--<v-list-item class="mt-2 mb-2">
              <v-list-item-action>
                <v-list-item-content>
                
                <v-btn @click="logout()">
                  
                 <v-icon>exit_to_app</v-icon>&nbsp;Cerrar Session</v-btn>
                  
              </v-list-item-content>
                
              </v-list-item-action>
             
            </v-list-item>-->
      </template>
      </v-list>
    </v-navigation-drawer>
      <v-app-bar
        :clipped-left="$vuetify.breakpoint.lgAndUp"
        app
        color="blue darken-3"
        dark
      >
      <v-toolbar-title
        
        class="ml-0"
      >
        <h4 class="text-right" style="font-size:16px">Sistema de Intermediacion Laboral</h4>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <!--<v-btn @click="logout()" icon>
        <v-icon
        >mdi mdi-logout</v-icon>
      </v-btn>-->
    </v-app-bar>
    <v-main>
      <v-container
        class="fill-height"
        fluid
      >
        <v-layout>
          <v-flex>
             <!-- Carga de Componentes aqui-->
              <router-view/>
              <!--Termina la Carga de componenetes-->
          </v-flex>
        </v-layout>       
      </v-container>
    </v-main>
    <v-footer color="blue darken-3"
      dark app>
      <span class="white--text">&copy; {{new Date().getFullYear()}} - Derechos Reservados - ITCHA AGAPE</span>
    </v-footer>
  </v-app>
</template>

<script>

import { mapState } from "vuex";


export default {
  props: {
      source: String,
    },
  name: 'Home',
 

  components: {
  },

  data: () => ({
    drawer: null,
    admin: false,
     show: false,
     egresado: false,
  

  }),
  methods:{
        
     logout(){
             let x = sessionStorage.getItem('tokenS');
            let me = this,
            header = {
              headers: {
                "Authorization": "Bearer "+ x,
              },
            };
            console.log(x)
             me.$http.get(`${me.$url}/logout`,header)
            .then(function(response){ 
               if(response.status==200){ 
                  localStorage.clear(); 
                  sessionStorage.clear();
                  me.$swal({
                          position: 'center',
                          title: 'Session Cerrada',
                          showConfirmButton: false,
                          timer: 3000,
                          imageUrl: '/itcha/logout.png',
                          imageWidth: 30,
                          imageHeight: 30,
                          imageAlt: 'Custom image'  
                        });
                    me.$router.push('/login'),
                    console.log(response.data)
               }                        
            })
            .catch(function(error){              
              console.log(error);
            });
          },

  },
  computed:{
    count(){
      return this.$store.state.role;
    },
      ...mapState(['name'])
    },
  mounted(){
   
    
  
  this.admin = this.$store.state.role;
  if(this.admin != 2 ){
    this.show = true;
    this.egresado = false;
  }else{
    this.show = false;
    this.egresado = true;
  }
  
    let x =sessionStorage.getItem('tokenS')
      if(x != null){
        console.log("Si tienes acceso");
      }else{
         
         this.$router.push('/login')
      }
       

  },
};
</script>
<style scoped>

</style>