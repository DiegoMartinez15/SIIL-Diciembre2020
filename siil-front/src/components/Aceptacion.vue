 <template>

<div class="content">
  <br>
  <br>
  <v-divider class="black"></v-divider>
  <br>
  <br>
  <!--FORMULARIO NUMERO 1-->
<div class="md-layout-item md-medium-size-100 md-xsmall-sixe-100 md-size-100">
    
    <v-overlay :value="loader" :z-index="'99999999'">
        <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
    </v-overlay>
    <v-card>
      <v-card-title>
        Lista de Egresados para aceptacion
       <div class="flex-grow-1"></div>
          <v-text-field
            v-model="searchEgresado"
            append-icon="search"
            label="Buscar egresado"
            single-line
            hide-details
          ></v-text-field>
      </v-card-title>
      <v-data-table

        :headers="hTBEgresado"
        :items="arrayEgresado"
        :footer-props="{
          'items-per-page-options' :[5,10,15,30],
          'items-per-page-text' :'Registros por Página'
        }"
        :items-per-page="10"
        :search="searchEgresado"
        multi-sort
        class="elevation-3 text--center ml-80 pl-10 pr-10"
      >
      <!-- Templeate para form modal para agregar o actualizar categorias-->
    <template v-slot:top>
      <v-toolbar flat color="white">
        
        <div class="flex-grow-1"></div>
        <v-dialog v-model="modalF1" persistent max-width="auto">
          <v-card>
            <v-card-title class="headline light-blue lighten-5" primary-titles>
              <span class="headline">Aceptación por Administrador</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-form ref="formaccept" v-model="validForm" :lazy-validation="true">
                  <v-row>
                    <v-col cols="12" >
                      <v-text-field
                      :rules="[v => !!v || 'Campo requerido']"
                      required
                      v-model="formulario.motivo"
                      label="Motivo"
                      @keyup="errorsNombre = []"
                      :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                  </v-row>
                </v-form>
              </v-container>
            </v-card-text>
            <v-divider></v-divider>           
              <v-card-actions>
                <div class="flex-grow-1"></div>
                <v-btn color="red darken-1" text @click="cerrarModal">Cerrar</v-btn>
                <v-btn
                  color="info darken-1"
                  @click="save()"
                  text
                  
                >Guardar</v-btn>
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
              @click="showModal(item)"
            >
            <v-icon>assignment_ind</v-icon>
            </v-btn>
          </template>
          <span>Formulario de aceptación</span>
        </v-tooltip>     
      </template>
      </v-data-table>
    </v-card>
  </div>
</div>
</template>
<script>
  export default {
    data () {
      return {
        arrayEgresado:[],
        hTBEgresado:[
          {text:"Nombres", value:'nombres',class:'blue-grey lighten-4'},
          {text:"Apellidos", value:'apellidos',class:'blue-grey lighten-4'},
          {text:"Accion", value:"action",sortable:false,aling:"center",class:'blue-grey lighten-4'},
        ],
        loader:false,
        modalF1:false,
        formulario:{
          id_aspirante:"",
          motivo:"",
        },
        searchEgresado:"",
        errorsNombre:[],
        validForm:true,
        editedF:-1,
      };
    },
    computed: {
    
    },
    methods: {

      save(){
      let token = sessionStorage.getItem('tokenS');
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
        me.loader = true;
        console.log(me.formulario)
        me.$http.post(`${me.$url}/aceptacionA/`+me.formulario.id_aspirante,me.formulario,header)
        .then(function(response){
           if (response.status == 200) {
            Toast.fire({
              icon:"success",
              title: "Formulario de aceptacion enviado correctamente"
            });
            me.cerrarModal();
             me.loader = false;
             me.fetchEgresado();
           }
         
        })
        .catch(function(error){
          if (error.status != 200) {
            me.loader = false;
            Toast.fire({
              icon:"error",
              title: "Ups Ocurrio un error, Intenta nuevamente"
            });
             me.cerrarModal();
          }
          
        });        

      },

      fetchEgresado() {  
        let token = sessionStorage.getItem('tokenS');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,  
              },
        };    
        me.loader = true;
        me.$http.get(`${me.$url}/listaccep`,header)
        .then(function(response){
            console.log(response.data)
          me.arrayEgresado = response.data;
          me.loader = false;
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });
      },
      cerrarModal(){
        let me = this;
        me.modalF1 = false;
        setTimeout(() => {
          me.formulario={
          motivo:""
          };
          me.resetValidation();
        }, 300);
      },
       resetValidation() {
        let me = this;
        me.errorsNombre = [];
        me.$refs.formaccept.resetValidation();
      },

      showModal(formulario) {
        let me = this;
        me.editedF = me.arrayEgresado.indexOf(formulario);
        me.formulario = Object.assign({},formulario);
        me.modalF1 = true;
      },
      
      
    },
    mounted() {
       let me = this;
       me.fetchEgresado();
      let x = sessionStorage.getItem('tokenS');
      if(x != null){
        me.fetchEgresado();
      }else{
         
         this.$router.push('/login')
      }
       
    },
  };
</script>