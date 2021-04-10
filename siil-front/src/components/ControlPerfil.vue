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
        Lista de Egresados con Perfil Ocupacional Completado
       <div class="flex-grow-1"></div>
          <v-text-field
            v-model="searchEgresado"
            append-icon="search"
            label="Buscar egresado o dato en especifico"
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
              <span class="headline">Detalles de Perfil Ocupacional</span>
            </v-card-title>
            <v-card-text>
              <v-container>
              <v-form>
            <thead style="font-size:25px" color="#20202f">I.Datos Personales</thead>
            <v-divider class="black"></v-divider>
              <!--v-row parte 1-->
              <v-row>
                 <!--nombre-->
                <v-col cols="12" md="3">
                  <v-text-field
                    label="Nombres"
                    v-model="formulario.nombres"
                    
                  ></v-text-field>
                </v-col>
                <!--Apellido-->
                <v-col cols="12" md="3">
                  <v-text-field
                    v-model="formulario.apellidos"
                    
                    label="Apellidos"
                  ></v-text-field>
                </v-col>
                <!--datepicker de nacimiento-->
                <v-col cols="12" md="2">
                  <v-text-field
                    v-model="formulario.fecha_nac"
                    label="fecha de nacimiento"
                    
                  ></v-text-field>
                </v-col>
              <!--lugar de nacimiento-->
              <v-col cols="12" md="4">
                  <v-text-field
                    
                    v-model="formulario.lugar_nac"
                    label="Lugar de nacimiento"
                  ></v-text-field>
                </v-col>
                <!--Direccion-->
              <v-col cols="12" md="6">
                  <v-text-field
                    v-model="formulario.direccion"
                    
                    label="Dirección"
                  ></v-text-field>
                </v-col>
                <!--estado civil-->
              <v-col cols="12" md="2">
                   <v-text-field
                   
                   v-model="formulario.estado_civil"
                  label="Estado Civil"
                ></v-text-field>
                </v-col>
                <!--Numero de telefono-->
              <v-col  v-show="formulario.celular2 === null" cols="12" md="3" style=" display:flex;">
                  <v-text-field 
                   v-model="formulario.celular"
                   label="Número de teléfono"
                  ></v-text-field>
                  
                </v-col>
                <v-col v-show="formulario.celular2 != null" cols="12" md="3">
                  <v-text-field
                    v-model="formulario.celular2"
                    label="Número de teléfono"
                  ></v-text-field>
                </v-col>
                <!--DUI-->
                <v-col cols="12" md="3">
                  <v-text-field
                  
                    v-model="formulario.dui"
                    label="DUI"
                  ></v-text-field>
                </v-col>
                <!--NIT-->
                <v-col cols="12" md="2">
                  <v-text-field
                    
                    v-model="formulario.nit"
                    label="Nit"
                  ></v-text-field>
                </v-col>
                  <!--Pasaporte-->
                <v-col cols="12" md="2" style=" display:flex;">
                  <v-text-field
                    
                    v-model="formulario.pasaporte"
                    label="Pasaporte"
                  ></v-text-field>
                  
                </v-col>
                 <v-col cols="12" md="3" style=" display:flex;">
                  <v-text-field
                    
                    v-model="formulario.licencia_conducir"
                    label="Licencia de conducir"
                  ></v-text-field>
                  
                      
                </v-col>
                 <!--NUP-->
                <v-col cols="12" md="2" style=" display:flex;">
                  <v-text-field
                   
                    v-model="formulario.nup"
                    label="Nup"
                  ></v-text-field>
                  
                </v-col>
                 <!--Nacionalidadd-->
                <v-col cols="12" md="4">
                  <v-text-field
                    v-model="formulario.nacionalidad"
                    label="Nacionalidad"
                    
                  ></v-text-field>
                </v-col>
                <!--2 Idioma-->
                <v-col cols="12" md="4">
                  <v-text-field
                  
                    v-model="formulario.segundo_idioma"
                    label="Segundo idioma"
                    
                  ></v-text-field>
                </v-col>
                <!--nivel de Idioma-->
                <v-col class="d-flex" cols="12" md="4">
                <v-text-field
                  
                  v-model="formulario.nivel_idioma"
                  label="Nivel de segundo idioma"
                ></v-text-field>
                </v-col>
              </v-row>
              <v-divider class="black"></v-divider>
              <thead style="font-size:25px" color="#20202f">II.Estado De Salud</thead>
              <v-divider class="black"></v-divider>
              <!--v-row parte 2-->
              <v-row>
              <!--Enfermemdad Cronica-->
                <v-col cols="12" md="6">
                  <v-text-field
                  
                    v-model="formulario.enfermedad_mencion"
                    label="Enfermedad Crónica"
                     
                  ></v-text-field>
                </v-col>
                 <!--si?Enfermemdad Cronica-->
                <v-col cols="12" md="6">
                  <v-text-field
                    
                    v-model="formulario.enfermedad_cronica"
                    label="Enfermedades crónicas"
                  ></v-text-field>
                </v-col>
                <!--Medicamentos-->
                <v-col cols="12" md="6">
                  <v-text-field
                    
                    v-model="formulario.medicamento_perma"
                    label="Medicamentos permanente"
                  ></v-text-field>
                </v-col>
                 <!--Si?Medicamentos-->
                <v-col cols="12" md="6">
                  <v-text-field
                 
                    v-model="formulario.medicamento_mencion"
                    label="Medicamento en uso"
                    hint="Ningún medicamento en uso"
                  ></v-text-field>
                </v-col>
                <!--Discapacidad-->
                <v-col cols="12" md="12">
                  <v-text-field
                   
                    v-model="formulario.discapacidad"
                    
                    label="Discapacidad"
                    
                  ></v-text-field>
                </v-col>
              </v-row>
              <v-divider class="black"></v-divider>
              <thead style="font-size:25px" color="##20202f">III.Informacion Académica</thead>
              <v-divider class="black"></v-divider>
              <!--v-row parte 3-->
              <v-row>
                <!--nivel academico-->
                <v-col cols="12" md="3">
                  <v-text-field
                  
                    v-model="formulario.nivel_academico"
                    label="Nivel académico"
                    
                  ></v-text-field>
                </v-col>
                
                   <!--Practica Pro-->
                <v-col cols="12" md="4">
                <v-text-field
                  
                  v-model="formulario.carrera"
                  label="Especialidad"
                ></v-text-field>
                </v-col>
                 <!--institucion-->
                <v-col cols="12" md="3">
                  <v-text-field
                    
                    v-model="formulario.institucion_formadora"
                    label="Institucion Formadora"
                  ></v-text-field>
                </v-col>
                <!--Graduacion-->
                <v-col cols="12" md="2">
                  <v-text-field 
                                 
                    v-model="formulario.anio"
                    label="Año de graduación"
                  ></v-text-field>
                </v-col>
                <!--Cursos-->
                <v-col cols="12" md="12" class="d-flex">
                <v-textarea
                 
                  v-model="formulario.cursos_informacion"
                  label="Cursos de formacion"
                  ></v-textarea>
                  </v-col>
                   
                  <!--Oficios-->
                  <v-col cols="12" md="12" class="d-flex">
                  <v-textarea
                    
                    v-model="formulario.oficios_realizar"
                    label="Oficios que puede realizar"
                  ></v-textarea>
                  
                  </v-col>
                  
                  <!--Formacion empre-->
                  <v-col class="d-flex" cols="12" md="4 ">
                  <v-text-field
                  
                    v-model="formulario.formacion_emprede"
                    
                    label="Formacion de emprendimiento"
                  ></v-text-field>
                  </v-col>
                  <!--institucion emprende-->
                  <v-col cols="12" md="4">
                    <v-text-field
                    
                    
                      v-model="formulario.instituto_formador_emprede"
                      label="Institucion formadora de emprendimiento"
                    ></v-text-field>
                  </v-col>
                  <!--anio de formacion-->
                  <v-col cols="12" md="2">
                    <v-text-field
                      
                      v-model="formulario.anio_formacion"
                      label="Año de formacion"
                    ></v-text-field>
                  </v-col>
                   <!--Idea Negogio-->
                  <v-col class="d-flex" cols="12" md="2">
                  <v-text-field
                  
                    v-model="formulario.idea_negocio"
                    
                    label="Idea de negocio"
                  ></v-text-field>
                  </v-col>
                </v-row>
                 <v-divider class="black"></v-divider>
                  <thead style="font-size:25px" color="##20202f">IV.Experiencia Laboral</thead>
                <v-divider class="black"></v-divider>
              <!--v-row parte 4-->
                <v-row>
                  <!--Experiencia laboral-->
                  <v-col class="d-flex" cols="12" md="4">
                  <v-text-field
                  
                    v-model="formulario.experiencia_laboral"
                    
                    label="Experiencia laboral"
                  ></v-text-field>
                  </v-col>
                  <!--periodo empleo-->
                  <v-col cols="12" md="4" class="d-flex">
                    <v-text-field
                      
                      v-model="formulario.ultimo_periodo_trabajo"
                      label="Periodo de último empleo"
                    ></v-text-field>
                  </v-col>
                  <!--cargo-->
                  <v-col cols="12" md="4">
                    <v-text-field
                    
                      v-model="formulario.cargo_desempenado"
                      label="Cargo desempeñado"
                    ></v-text-field>
                  </v-col>
                   <!--habilidades-->
                  <v-col cols="12" md="12">
                  <v-textarea
                    v-model="formulario.habilidades_personales"
                    
                    label="Habilidades, caracteristicas o actividades personales"
                    hint="Habilidades, caracteristicas o actividades sin datos"
                  ></v-textarea>
                  </v-col>
                   <!--dificultades-->
                  <v-col cols="12" md="12">
                  <v-textarea
                  
                    v-model="formulario.dificultades_personales"
                    label="Dificultades, caracteristicas o actividades personal"
                    hint="Dificultades, caracteristicas o actividades sin datos"
                  ></v-textarea>
                  </v-col>
             
                   <!--disponabilidad empleo-->
                  <v-col class="d-flex" cols="12" md="6">
                  <v-text-field
                                   
                    v-model="formulario.disponibilidad_horaria"
                    label="Disponibilidad horaria para empleo"
                  ></v-text-field>
                  </v-col>
                   <!--disponabilidad empleo--> 
                  <v-col class="d-flex" cols="12" md="6">
                    <!--Traslado-->
                  <v-text-field
                  
                   v-model="formulario.traslado_fuera"
                    label="Disponibilidad para trasladarse fuera de Chalatenango"
                  ></v-text-field>
                  </v-col>
                  <!--otras observaciones-->
                  <v-col cols="12" md="12">
                  <v-textarea
                    
                    v-model="formulario.otra_observacion"
                    label="Otras observaciones"
                    hint="Observaciones"
                  ></v-textarea>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-text-field
                    
                      v-model="formulario.fecha_creacion"
                      label="Fecha de ingreso de datos"
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12" md="6">
                    <v-textarea
                      v-model="formulario.recomendacion_derivacion"
                      label="Recomendación de derivación"
                    ></v-textarea>
                  </v-col>
                </v-row>
            <v-divider class="black"></v-divider>
          </v-form>
              </v-container>
            </v-card-text>
            <v-divider></v-divider>           
              <v-card-actions>
                <div class="flex-grow-1"></div>
                <v-btn color="red darken-1" text @click="cerrarModal">Cerrar</v-btn>
                <v-btn
                  color="info darken-1"
                  @click="recomendacioDerivacion()"
                  text
                  
                >Guardar recomendacion</v-btn>
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
            <v-icon>details</v-icon>
            </v-btn>
          </template>
          <span>Detalle de Egresado</span>
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
          {text:"Carrera", value:'carrera', class:'blue-grey lighten-4 '},
          {text:"Año de Graduación", value:'anio', class:'blue-grey lighten-4 '},
          {text:"Accion", value:"action",sortable:false,aling:"center",class:'blue-grey lighten-4'},
        ],
        loader:false,
        modalF1:false,
        datos:{
           id:"",
          recomendacion_derivacion:"",
        },
        formulario:{
          
        },
        searchEgresado:"",

        validForm:true,
        editedF:-1,
      };
    },
    computed: {
    
    },
    methods: {

      recomendacioDerivacion(){
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
        me.datos.id = me.formulario.id;
        me.datos.recomendacion_derivacion = me.formulario.recomendacion_derivacion;
        console.log(me.formulario)
        me.$http.put(`${me.$url}/derivacion/update/`+me.datos.id,me.datos,header)
        .then(function(response){
           if (response.status == 200) {
            Toast.fire({
              icon:"success",
              title: "Recomendación de derivación actualizada"
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
        me.$http.get(`${me.$url}/formulario/all`,header)
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