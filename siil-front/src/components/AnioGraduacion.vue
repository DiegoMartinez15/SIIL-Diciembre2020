<template>

<div class="content">
  
  
  <div class="md-layout-item md-medium-size-100 md-xsmall-sixe-100 md-size-100">
    
    <v-overlay :value="loader" :z-index="'99999999'">
        <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
    </v-overlay>
    <v-card>
      <v-card-title>
        Año de Graduacion
       <div class="flex-grow-1"></div>
      </v-card-title>
      <v-data-table
        
        :headers="hTBAnio"
        :items="arrayAnios"
        :footer-props="{
          'items-per-page-options' :[1],
          'items-per-page-text' :'Registros por Página'
        }"
        :items-per-page="1"
        multi-sort
        class="elevation-3 text--center ml-80 pl-10 pr-10"
      >
      <!-- Templeate para form modal para agregar o actualizar categorias-->
    <template v-slot:top>
      <v-toolbar flat color="white">
        
        <div class="flex-grow-1"></div>
        <v-dialog v-model="modalAnios" persistent max-width="400px">
          <v-card>
            <v-card-title class="headline light-blue lighten-5" primary-titles>
              <span class="headline">Actualizarcion de año de Graduacion</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-form ref="formAnio" v-model="validForm" :lazy-validation="true">
                 <v-text-field
                  v-model="anios.anio"
                  @keyup="errorsNombre = []"
                  label="Año de Graduacion"
                  :error-messages="errorsNombre"
                  ></v-text-field>
                </v-form>
              </v-container>
            </v-card-text>
            <v-divider></v-divider>           
              <v-card-actions>
                <div class="flex-grow-1"></div>
                <v-btn color="red darken-1" text @click="cerrarModal">Cerrar</v-btn>
                <v-btn
                  color="info darken-1"
                  :disabled="!validForm"
                  @click="updateAnio()"
                  text
                  
                >Actualizar año de Graduacion</v-btn>
              </v-card-actions>          
          </v-card>
        </v-dialog>
      </v-toolbar>
</template>
      <!--Template para la columna de acciones -->
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
              @click="showModalEditar(item)"
            >
            <v-icon>create</v-icon>
            </v-btn>
          </template>
          <span>Actualizar Datos</span>
        </v-tooltip>     
      </template>
      <v-snackbar v-model="snackbar">
          {{ msjSnackBar}}
          <v-btn color="red" text @click="snackbar = false">Cerrar</v-btn>
      </v-snackbar>
      </v-data-table>
    </v-card>
  </div>
</div>
  
</template>
<script>
  export default {
    data () {
      return {
        arrayAnios:[],
        hTBAnio:[
          {text:"Año", value:"anio" , class:'blue-grey lighten-4 '},
          {text:"Accion", value:"action",sortable:false,aling:"center",class:'blue-grey lighten-4'},
        ],
        loader:false,
        modalAnios:false,
        anios:{
          id:"",
          anio:"",
        },
        validForm:true,
        snackbar:false,
        msjSnackBar:"",
        errorsNombre:[],
        editedAnio:-1,
      };
    },
    computed: {
    
    },
    
    methods: {
      fetchAnio() {  
        let token = sessionStorage.getItem('tokenS');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };
               
        me.loader = true;
        me.$http.get(`${me.$url}/anio_graduacion`,header)
        .then(function(response){
            console.log(response.data)
          me.arrayAnios = response.data;
          me.loader = false;
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });
      },
      cerrarModal(){
        let me = this;
        me.modalAnios = false;
        setTimeout(() => {
          me.anios={
            id:null,
            anio:"",
          };
          me.resetValidation();
        }, 300);
      },
      resetValidation() {
        let me = this;
        me.errorsNombre = [];
        me.$refs.formAnio.resetValidation();
      },
      showModalEditar(anios) {
        let me = this;
        me.editedAnio = me.arrayAnios.indexOf(anios);
        me.anios = Object.assign({},anios);
        me.modalAnios = true;
      },
      updateAnio() {

     let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };

      let Toast = me.$swal.mixin({
          toast: true,
          position: "bottom-end",
          showConfirmButton: true,
          timer: 3000
        });

      if (me.$refs.formAnio.validate()){
        me.$http.put(`${me.$url}/anio_graduacion/update`,me.anios, header)
            .then(function(response) {
              console.log(response.data);
              console.log(response.status);
              me.verificarAccionDato(response.data, response.status, "upd");
               me.cerrarModal();
            })
          .catch(function(error) {
            console.log(error);
             Toast.fire({
              icon:"error",
              title: "Ups Ocurrió un error, Intenta nuevamente"
            });
            me.loader = false;
          });
      }
    },
     verificarAccionDato(anios, statusCode, accion) {
        let me = this;

        const Toast = me.$swal.mixin({
          toast: true,
          position: "bottom-end",
          showConfirmButton: true,
          timer: 3000
        });

        switch (accion) {
          case "upd":
            this.fetchAnio(); 
            Toast.fire({
              icon:"success",
              title: "Año de Graduacion Actualizado"
            });
            me.loader = false;
            break;
        }
      },
      setMessageToSnackBar(msj, estado) {
        let me = this;
        me.snackbar = estado;
        me.msjSnackBar = msj;
      },
      
    },
    mounted() {
       let me = this;
       me.fetchAnio();
      let x = sessionStorage.getItem('tokenS');
      if(x != null){
        me.fetchAnio();
      }else{
         
         this.$router.push('/login')
      }
       
    },
  };
</script>