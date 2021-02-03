<template>
  <v-app>
    <div class="content ">
       
        <div class="md-layout-item md-medium-size-100 md-xsmall-sixe-100 md-size-100">
            <v-overlay :value="loader" :z-index="'99999999'">
                <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
            </v-overlay>
            <v-card style="border:1px solid #808B96">
              <v-card-title class="mb-5 " >
                <h3 style="border-bottom:1px solid black;">Listado de usuarios que aplicaron a ofertas</h3>
            <div class="flex-grow-1" ></div>
                  <v-text-field
                  v-model="searchApply"
                  append-icon="search"
                  label="Buscar"
                  single-line
                  hide-details
                  ></v-text-field>
              </v-card-title>
              <v-data-table
                :headers="hTBApply"
                :items="arrayApply"
                :footer-props="{
                'items-per-page-options' :[5,10,15,20,30],
                'items-per-page-text' :'Registros por Página'
                }"
                :items-per-page="5"
                :search="searchApply"
                multi-sort
                class="elevation-3 text--center"
                >
  
              <template v-slot:item.action="{item}">
                <v-tooltip top>
                  <template v-slot:activator="{on}">
                    <v-btn
                      color="success"            
                      elevation="8"
                      small
                      fab
                      dark
                      :disabled="item.id<0"
                      v-on="on"
                      
                    >
                    <v-icon>create</v-icon>
                    </v-btn>
                  </template>
                  <span>Actualizar Datos</span>
                </v-tooltip>
                &nbsp;&nbsp;
                <v-tooltip top>
                  <template v-slot:activator="{on}">
                    <v-btn
                      color="light-grey"            
                      elevation="8"
                      small
                      dark
                      fab
                      :disabled="item.id < 0"
                      v-on="on"
                      @click="showModal(item)"
                    >
                    <v-icon>info</v-icon>
                    </v-btn>
                  </template>
                  <span>Informacion</span>
                </v-tooltip>
              </template>
            <v-snackbar v-model="snackbar">
                {{ msjSnackBar}}
                <v-btn color="red" text @click="snackbar = false">Cerrar</v-btn>
            </v-snackbar>
            </v-data-table>
            </v-card>

            <v-dialog v-model="modalApply"  max-width="500px">
               <v-card
                class="mx-auto"
                color="#26c6da"
                dark
                max-width="500"
              >
                <v-card-title style="background:white;border-bottom:1px solid black">
                   <v-avatar 
                   size="56">
                    <v-img
                      :src="'/itcha/escudo.png'"
                    ></v-img>
                    
                  </v-avatar>
                  <span class="title font-weight-light black--text ml-3">Instituto Tecnologico de Chalatenango</span>
                </v-card-title>

                <v-card-text class="headline font-weight-bold ">
                  <v-card class="mt-5 white " max-width="90%">
                    <v-card-text class="black--text font-weight "><strong id="marcador">Aspirante&nbsp;<v-icon>assignment_ind</v-icon></strong>{{applyoffer.nombres }}&nbsp;{{applyoffer.apellidos}}</v-card-text>
                  </v-card>

                  <v-card class="mt-5 white " max-width="90%">
                    <v-card-text class="black--text font-weight "><strong  id="marcador">Codigo&nbsp;<v-icon>code</v-icon></strong>{{applyoffer.codigo}}</v-card-text>
                  </v-card>

                  <v-card class="mt-5 white " max-width="90%">
                    <v-card-text class="black--text font-weight "><strong  id="marcador">Telefono&nbsp;<v-icon>perm_phone_msg</v-icon></strong>{{applyoffer.telefono}}</v-card-text>
                  </v-card>

                  <v-card class="mt-5 white " max-width="90%">
                    <v-card-text class="black--text font-weight "><strong  id="marcador">Cargo&nbsp;<v-icon>business_center</v-icon></strong>{{applyoffer.cargo}}</v-card-text>
                  </v-card>

                  <v-card class="mt-5 white " max-width="90%">
                    <v-card-text class="black--text font-weight "><strong  id="marcador">Lugar&nbsp;<v-icon>map</v-icon></strong>{{applyoffer.lugardesarrollo}}</v-card-text>
                  </v-card>

                  <v-card class="mt-5 white " max-width="90%">
                    <v-card-text class="black--text font-weight "><strong  id="marcador">Empresa&nbsp;<v-icon>domain</v-icon></strong>{{applyoffer.empresa}}</v-card-text>
                  </v-card>
                </v-card-text>

                <v-card-actions  style="border-top: solid black 1px;background:white">
                  <v-list-item class="grow ">
                    <v-list-item-avatar color="grey darken-3">
                      <v-row justify="space-around">
                      <v-avatar
                        :color="color.color"
                        
                      >
                        <span  class="white--text headline">{{applyoffer.Name}}</span>
                      </v-avatar>
                      </v-row>
                    </v-list-item-avatar>

                    <v-list-item-content>
                      <v-list-item-title class="black--text font-weight-bold text-center" style="border-bottom:1px solid black">{{applyoffer.NameIn}}</v-list-item-title>
                    </v-list-item-content>

                    <v-row
                      align="center"
                      justify="end"
                    >
                      <v-icon class="mr-1">
                        mdi-heart
                      </v-icon>
                      <span class="subheading mr-2">256</span>
                      <span class="mr-1">·</span>
                      <v-icon class="mr-1">
                        mdi-share-variant
                      </v-icon>
                      <span class="subheading">45</span>
                    </v-row>
                  </v-list-item>
                </v-card-actions>
              </v-card>
            </v-dialog>
        </div>
    </div>
  </v-app>
</template>
<script>
export default {
       data () {
      return {
        arrayApply:[],
        hTBApply:[
          {text:"Nombre", value:"nombres" , class:'blue-grey lighten-4 '},
          {text:"Telefono", value:"telefono" , class:'blue-grey lighten-4 '},
          {text:"Oferta", value:"empresa" , class:'blue-grey lighten-4 '},
          {text:"Acciones", value:"action",sortable:false,aling:"center",class:'blue-grey lighten-4'},
        ],
        loader:false,
        searchApply:"",
        applyoffer:{
          id:null,
          estado:'',
          nombres:'',
          apellidos:'',
          codigo:'',
          telefono:'',
          cargo:'',
          empresa:'',
          lugardesarrollo:'',
          Name:'',
          NameIn:'',

        },
        color:'',
        colors:[
          {id:0,color:'indigo'},
          {id:1,color:'red'},
          {id:2,color:'#F39C12'},
          {id:3,color:'#145A32'},
          {id:4,color:'#283747'},
          {id:5,color:'#145A32'}
         
         
        ],
        modalApply: false,
        validForm:true,
        snackbar:false,
        msjSnackBar:"",
        errorsNombre:[],
        editedApply:-1,
      };
    },
    methods: {
       fetchApply() {  
        let token = sessionStorage.getItem('tokenS');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };  
        me.loader = true;
        me.$http.get(`${me.$url}/ApplyOffer`,header)
        .then(function(response){
            console.log(response.data)
          me.arrayApply = response.data;
          
          me.loader = false;
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });
      },

       showModal(apply) {
        let me = this;
        me.editedApply = me.arrayApply.indexOf(apply);
        me.applyoffer = Object.assign({},apply);
        let x = me.applyoffer.nombres.substr(0,1);
        let y = me.applyoffer.apellidos.substr(0,1);
        me.applyoffer['Name'] = x.toUpperCase() + y.toUpperCase();
        let number = Math.floor((Math.random() * (1-5))+5)
        me.color = me.colors.find(colors => colors.id === number);
        console.log(me.color.color);
        let name = me.applyoffer.nombres.split(' ');
        let name2 = me.applyoffer.apellidos.split(' ');
        me.applyoffer.NameIn = name[0].toUpperCase()+" "+name2[0].toUpperCase();
        me.modalApply = true;
      },

    },
    mounted(){
      this.fetchApply();
    }
}
</script>
<style scoped>
#marcador{
  
  padding: 10px;
  border-radius: 3px;
  margin-left: -25px;
  margin-right: 15px;
  color:white;
  
  
  background: rgb(55, 53, 158);
}
</style>
