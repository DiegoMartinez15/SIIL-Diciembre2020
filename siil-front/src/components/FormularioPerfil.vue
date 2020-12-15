<template>
  <v-form v-model="valid" ref="formPerfil" :lazy-validation="true">
    <thead style="font-size:40px;align:center;">Registro de Perfil Ocupacional de Graduado</thead>
    <v-divider class="black"></v-divider>
    <thead style="font-size:25px">I.Datos Personales</thead>
    <v-divider class="black"></v-divider>
    <v-container>
      <!--v-row parte 1-->
      <v-row>
         <!--nombre-->
        <v-col cols="12" md="3">
          <v-text-field
            :label="arrayAspirante.nombres"
            disabled
          ></v-text-field>
        </v-col>
        <!--Apellido-->
        <v-col cols="12" md="3">
          <v-text-field
            :label="arrayAspirante.apellidos"
            disabled
          ></v-text-field>
        </v-col>
        <!--datepicker de nacimiento-->
        <v-col cols="12" md="2">
          <v-text-field
            :label="arrayAlumno.fecha_nac"
            disabled
          ></v-text-field>
        </v-col>
      <!--lugar de nacimiento-->
      <v-col cols="12" md="4">
          <v-text-field
            v-model="formulario.lugar_nac"
            :rules="campo"
            label="Lugar de nacimiento"
            required
          ></v-text-field>
        </v-col>
        <!--Direccion-->
      <v-col cols="12" md="6">
          <v-text-field
            :label="arrayAlumno.direccion"
            disabled
          ></v-text-field>
        </v-col>
        <!--estado civil-->
      <v-col cols="12" md="2">
           <v-select
           v-model="formulario.estado_civil"
          :items="estados"
          label="Estado Civil"
          required
          :rules="campo"
        ></v-select>
        </v-col>
        <!--Numero de telefono-->
      <v-col cols="12" md="2" style=" display:flex;">
          <v-text-field
           :label="arrayAlumno.celular"
           disabled
          ></v-text-field>
           <v-tooltip bottom >
              <template v-slot:activator="{ on, attrs }" >
                <v-icon
                  style="margin-left:20px;"
                  color="primary"
                  dark
                  v-bind="attrs"
                  v-on="on"
                >
                  info
                </v-icon>
              </template>
              <span>El número que puedes ver a la izquierda es tu número de
                 telefono que tenemos para contactarte, si has cambiado de número telefonico.
                  Por favor ingresa tu nuevo número en el recuadro de <strong>Nuevo número</strong> (si no has cambiado debes dejarlo en blanco). Gracias!!!</span>
            </v-tooltip>
        </v-col>
        <v-col cols="12" md="2">
          <v-text-field
            v-model="formulario.celular2"
            :rules="phoneRules"
            label="Nuevo número"
          ></v-text-field>
        </v-col>
        <!--DUI-->
        <v-col cols="12" md="3">
          <v-text-field
            :label="arrayAlumno.dui"
            disabled
          ></v-text-field>
        </v-col>
        <!--NIT-->
        <v-col cols="12" md="2">
          <v-text-field
            v-model="formulario.nit"
            :rules="campo"
            label="Nit"
            required
          ></v-text-field>
        </v-col>
          <!--Pasaporte-->
        <v-col cols="12" md="2" style=" display:flex;">
          <v-text-field
            v-model="formulario.pasaporte"
            label="Pasaporte"
          ></v-text-field>
           <v-tooltip bottom >
              <template v-slot:activator="{ on, attrs }" >
                <v-icon
                  style="margin-left:20px;"
                  color="primary"
                  dark
                  v-bind="attrs"
                  v-on="on"
                >
                  info
                </v-icon>
              </template>
              <span>Si tienes <strong>Pasaporte</strong> debes escribir el número de referencia</span>
              </v-tooltip>
        </v-col>
         <v-col cols="12" md="3" style=" display:flex;">
          <v-text-field
            v-model="formulario.licencia_conducir"
            label="Licencia de conducir"
          ></v-text-field>
           <v-tooltip bottom >
              <template v-slot:activator="{ on, attrs }" >
                <v-icon
                  style="margin-left:20px;"
                  color="primary"
                  dark
                  v-bind="attrs"
                  v-on="on"
                >
                  info
                </v-icon>
              </template>
              <span>Si tienes <strong>Licencia de conducir</strong> debes escribir el número de referencia</span>
              </v-tooltip>
        </v-col>
         <!--NUP-->
        <v-col cols="12" md="2" style=" display:flex;">
          <v-text-field
            v-model="formulario.nup"
            label="Nup"
          ></v-text-field>
          <v-tooltip bottom >
              <template v-slot:activator="{ on, attrs }" >
                <v-icon
                  style="margin-left:20px;"
                  color="primary"
                  dark
                  v-bind="attrs"
                  v-on="on"
                >
                  info
                </v-icon>
              </template>
              <span>¿Qué es el NUP? Es el Número Único Previsional que identifica a cada afiliado
                 y es asignado por la Superintendencia del Sistema Financiero. Puede encontrarse 
                 fácilmente en tu Carné de afiliado a CONFIA y aunque te traslades a otra AFP,
                  tu NUP seguirá siendo el mismo</span> 
              <span>. Si tienes <strong>Número único previsional</strong> debes escribir el número de referencia</span>
              </v-tooltip>
        </v-col>
         <!--Nacionalidadd-->
        <v-col cols="12" md="4">
          <v-text-field
            v-model="formulario.nacionalidad"
            :rules="campo"
            label="Nacionalidad"
            required
          ></v-text-field>
        </v-col>
        <!--2 Idioma-->
        <v-col cols="12" md="4">
          <v-autocomplete
            v-model="formulario.idsegundo_idioma"
            :items = "arrayIdioma"
            label="Segundo idioma"
            item-text="nombre"
            item-value="id"
            clearable
            :menu-props="{ closeOnClick: true }"
            required
            :rules="campo"
          ></v-autocomplete>
        </v-col>
        <!--nivel de Idioma-->
        <v-col class="d-flex" cols="12" md="4">
        <v-select
          v-model="formulario.nivel_idioma"
          :items="items"
          label="Nivel de segundo idioma"
          required
          :rules="campo"
        ></v-select>
        </v-col>
      </v-row>
      <v-divider class="black"></v-divider>
      <thead style="font-size:25px">II.Estado De Salud</thead>
      <v-divider class="black"></v-divider>
      <!--v-row parte 2-->
      <v-row>
      <!--Enfermemdad Cronica-->
        <v-col cols="12" md="6">
          <v-select
            v-model="formulario.enfermadad_mencion"
            :items="yesno"
            label="Padece alguna Enfermedad Cronica?"
             required
            :rules="campo"
          ></v-select>
        </v-col>
         <!--si?Enfermemdad Cronica-->
        <v-col cols="12" md="6">
          <v-text-field
           :disabled="formulario.enfermadad_mencion==='No'"
            v-model="formulario.enfermedad_cronica"
            label="Si? Mencionar"
          ></v-text-field>
        </v-col>
        <!--Medicamentos-->
        <v-col cols="12" md="6">
          <v-select
            v-model="formulario.medicamento_perma"
           :items="yesno"
            label="Necesita medicamentos permanentes?"
            required
            :rules="campo"
          ></v-select>
        </v-col>
         <!--Si?Medicamentos-->
        <v-col cols="12" md="6">
          <v-text-field
          :disabled="formulario.medicamento_perma==='No'"
            v-model="formulario.medicamento_mencion"
            label="Si? Mencionar"
          ></v-text-field>
        </v-col>
        <!--Discapacidad-->
        <v-col cols="12" md="12">
          <v-select
            v-model="formulario.discapacidad"
            :items="yesno"
            label="Posee algún tipo de discapacidad?"
            required
            :rules="campo"
          ></v-select>
        </v-col>
      </v-row>
      <v-divider class="black"></v-divider>
      <thead style="font-size:25px">III.Informacion Académica</thead>
      <v-divider class="black"></v-divider>
      <!--v-row parte 3-->
      <v-row>
        <!--nivel academico-->
        <v-col cols="12" md="3">
          <v-select
            v-model="formulario.nivel_academico"
            :items="nivel"
            label="Nivel académico"
            required
            :rules="campo"
          ></v-select>
        </v-col>
        
           <!--Practica Pro-->
        <v-col cols="12" md="4">
        <v-select
          v-model="formulario.id_carrera"
          :items="arrayCarrera"
          label="Especialidad"
          item-text="nombre"
          item-value="id"
          clearable
          :menu-props="{ closeOnClick: true }"
        ></v-select>
        </v-col>
         <!--institucion-->
        <v-col cols="12" md="3">
          <v-text-field
            v-model="formulario.institucion_formadora"
            label="Institucion Formadora"
            required
            :rules="campo"
          ></v-text-field>
        </v-col>
        <!--Graduacion-->
        <v-col cols="12" md="2">
          <v-select
            v-model="formulario.id_anio_graduacion"
            :items = "arrayAnios"
            item-text="anio"
            item-value="id"
            clearable
            :menu-props="{ closeOnClick: true }"
            label="Año de graduación?"
          ></v-select>
        </v-col>
        <!--Cursos-->
        <v-col cols="12" md="12" class="d-flex">
        <v-textarea
          v-model="formulario.cursos_informacion"
          name="txaCurso"
          label="Cursos de formacion"
          value=""
          hint="Escriba los cursos"
          ></v-textarea>
          <v-tooltip bottom >
              <template v-slot:activator="{ on, attrs }" >
                <v-icon
                  
                  color="primary"
                  dark
                  v-bind="attrs"
                  v-on="on"
                >
                  info
                </v-icon>
              </template>
              <span>Un ejemplo de <strong>Cursos de formacion</strong> puede ser: <strong>Cursos de Excel, Word, PowerPoint, Marketing</strong></span>
              </v-tooltip>
          </v-col>
           
          <!--Oficios-->
          <v-col cols="12" md="12" class="d-flex">
          <v-textarea
            v-model="formulario.oficios_realizar"
            name="txaOficio"
            label="Oficios que puede pealizar"
            value=""
            hint="Escriba sus oficios"
          ></v-textarea>
           <v-tooltip bottom >
              <template v-slot:activator="{ on, attrs }" >
                <v-icon
                  
                  color="primary"
                  dark
                  v-bind="attrs"
                  v-on="on"
                >
                  info
                </v-icon>
              </template>
              <span>Un ejemplo de <strong>Oficios</strong> puede ser: <strong>Cocinero, Mecánico, Repartidor, etc.</strong></span>
              </v-tooltip>
          </v-col>
          
          <!--Formacion empre-->
          <v-col class="d-flex" cols="12" md="4 ">
          <v-select
            v-model="formulario.formacion_emprende"
            :items="yesno"
            label="Formacion de emprendimiento?"
          ></v-select>
          </v-col>
          <!--institucion emprende-->
          <v-col cols="12" md="4">
            <v-text-field
            :disabled="formulario.formacion_emprende==='No'"
              v-model="formulario.instituto_formador_emprede"
              label="Institucion formadora de emprendimiento"
            ></v-text-field>
          </v-col>
          <!--anio de formacion-->
          <v-col cols="12" md="2">
            <v-text-field
              :disabled="formulario.formacion_emprende==='No'"
              v-model="formulario.anio_formacion"
              label="Año de formacion"
            ></v-text-field>
          </v-col>
           <!--Idea Negogio-->
          <v-col class="d-flex" cols="12" md="2">
          <v-select
            v-model="formulario.idea_negocio"
            :items="yesno"
            label="Idea de negocio?"
          ></v-select>
          </v-col>
        </v-row>
         <v-divider class="black"></v-divider>
          <thead style="font-size:25px">IV.Experiencia Laboral</thead>
        <v-divider class="black"></v-divider>
      <!--v-row parte 4-->
        <v-row>
          <!--Experiencia laboral-->
          <v-col class="d-flex" cols="12" md="4">
          <v-select
            v-model="formulario.experecia_laboral"
            :items="yesno"
            label="Posee experiencia laboral?"
          ></v-select>
          </v-col>
          <!--periodo empleo-->
          <v-col cols="12" md="4" class="d-flex">
            <v-text-field
              :disabled="formulario.experecia_laboral==='No'"
              v-model="formulario.ultimo_periodo_trabajo"
              label="Periodo de último empleo"
            ></v-text-field>
             <v-tooltip bottom >
              <template v-slot:activator="{ on, attrs }" >
                <v-icon
                  style="margin-left:20px;"
                  color="primary"
                  dark
                  v-bind="attrs"
                  v-on="on"
                >
                  info
                </v-icon>
              </template>
              <span>Un ejemplo de <strong>Periodo de empleo</strong> puede ser: <strong>Enero de 2017 hasta Agosto de 2020</strong></span>
              </v-tooltip>
          </v-col>
          <!--cargo-->
          <v-col cols="12" md="4">
            <v-text-field
            :disabled="formulario.experecia_laboral==='No'"
              v-model="formulario.cargo_desempenado"
              label="Cargo desempeñado"
            ></v-text-field>
          </v-col>
           <!--habilidades-->
          <v-col cols="12" md="12">
          <v-textarea
            v-model="formulario.habilidades_personales"
            name="txaHabilidades"
            label="Habilidades, caracteristicas o actividades personales en que se destaca o hace bien"
            value=""
            hint="Escriba sus habilidades, caracteristicas o actividades"
          ></v-textarea>
          </v-col>
           <!--dificultades-->
          <v-col cols="12" md="12">
          <v-textarea
            v-model="formulario.dificultades_personales"
            name="txaDificultades"
            label="Dificultades, caracteristicas o actividades personal que debe mejorar o aprender"
            value=""
            hint="Escriba sus dificultades, caracteristicas o actividades"
          ></v-textarea>
          </v-col>
      <!-- <thead style="font-size:20px;" >Habitos Laborales:</thead>
           <v-divider vertical ></v-divider>
           
          <v-col class="d-flex" cols="12" md="3">
          <v-select
            v-model="formulario.asistencia"
            :items="yesno"
            label="Asistencia"
          ></v-select>
          </v-col>
          
          <v-col class="d-flex" cols="12" md="3">
          <v-select
            v-model="formulario.puntualidad"
            :items="yesno"
            label="Puntualidad"
          ></v-select>
          </v-col>
         
          <v-col class="d-flex" cols="12" md="3">
          <v-select
            v-model="formulario.responsabilidad"
            :items="yesno"
            label="Responsabilidad"
          ></v-select>
          </v-col> -->  
           <!--disponabilidad empleo-->
          <v-col class="d-flex" cols="12" md="6">
          <v-select
            v-model="formulario.disponibilidad_horaria"
            :items="time"
            label="Disponibilidad horaria para empleo"
          ></v-select>
          </v-col>
           <!--disponabilidad empleo--> 
          <v-col class="d-flex" cols="12" md="6">
            <!--Traslado-->
          <v-select
            :items="yesno"
            label="Disponibilidad para trasladarse fuera de Chalatenango"
          ></v-select>
          </v-col>
          <!--otras observaciones-->
          <v-col cols="12" md="12">
          <v-textarea
            v-model="formulario.otra_observacion"
            name="txaOtras"
            label="Otras observaciones"
            value=""
            hint="Escriba sus observaciones"
          ></v-textarea>
          </v-col>
        </v-row>
        <span class="pie_info" >Antes de enviar tu información revisa que todo este correcto, ya que una vez inviada no podras cambiarla</span>
    </v-container>
    <v-divider class="black"></v-divider>
    <template>
    <v-btn block color="purple" dark  
      
      elevation="8"
      @click="saveForm()"
    >Enviar mi información</v-btn>
    </template>
  </v-form>
  
</template>
<script>
  export default {
    data () {
      return {
      arrayAspirante:[],
      arrayAlumno:[],
      arrayIdioma:[], 
      arrayAnios:[],
      arrayCarrera:[],
      valid: true,

      formulario:{
        id: "",
        id_aspirante: "",
        id_egresado: "",
        id_carrera:"",
        lugar_nac:"",
        celular2:"",
        estado_civil:"",
        nit:"",
        pasaporte:"",
        licencia_conducir:"",
        nup:"",
        idsegundo_idioma:"",
        nivel_idioma:"",
        nacionalidad:"",
        enfermedad_cronica:"",
        enfermadad_mencion:"",
        medicamento_perma:"",
        medicamento_mencion:"",
        discapacidad:"",
        nivel_academico:"",
        institucion_formadora:"",
        id_anio_graduacion:"",
        cursos_informacion:"",
        oficios_realizar:"",
        formacion_emprende:"",
        idea_negocio:"",
        instituto_formador_emprede:"",
        anio_formacion:"",
        experecia_laboral:"",
        ultimo_periodo_trabajo:"",
        cargo_desempenado:"",
        habilidades_personales:"",
        dificultades_personales:"",
        disponibilidad_horaria:"",
        recomendacion_derivacion:"",
        otra_observacion:"",
        created_at:"",
      },

      items: ['Basico', 'Intermedio', 'Avanzado'],
      yesno: ['Si', 'No'],
      time: ['Tiempo Completo', 'Medio Tiempo', 'Por Horas'],
      estados:['Soltero','Casado','Viudo'],
      nivel:['Técnico','Licenciado','Ingeniero'],
     
      phoneRules: [
        v => /^([0-9])*$/.test(v) || 'Formato no valido',
      ],
     
       campo: [
        v => !!v || 'Este campo es requerido',
      ],
     
    };
  },
    computed: {
      
    },
    
    methods: {
      fetchAspirantes() {    
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            }; 
        me.formulario.id_aspirante = me.$store.state.idaspirante;
        me.$http.get(`${me.$url}/aspirante/` +   me.formulario.id_aspirante,header)
        .then(function(response){
          console.log(response.data)
          me.arrayAspirante = response.data;
        })
        .catch(function(error){
          console.log(error);
        });
      },
       fetchEgresado() {  
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };          
        me.formulario.id_aspirante = me.$store.state.idaspirante;
        me.$http.get(`${me.$url}/egresado/` + me.formulario.id_aspirante,header)
        .then(function(response){
            console.log(response.data)
          me.arrayAlumno = response.data;
        })
        .catch(function(error){
          console.log(error);
        });
      },
       fetchIdiomas() {    
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };          
        me.$http.get(`${me.$url}/idioma`,header)
        .then(function(response){
            console.log(response.data)
          me.arrayIdioma = response.data;
        })
        .catch(function(error){
          console.log(error);
        });
      },
      fetchAnio() {   
         let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };         
        me.$http.get(`${me.$url}/anio_graduacion`,header)
        .then(function(response){
            console.log(response.data)
          me.arrayAnios = response.data;
        })
        .catch(function(error){
          console.log(error);
        });
      },
      fetcCarrera() {   
         let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };         
        me.$http.get(`${me.$url}/carreras`,header)
        .then(function(response){
            console.log(response.data)
          me.arrayCarrera = response.data;
        })
        .catch(function(error){
          console.log(error);
        });
      },
      saveForm(){
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };
         
          if (me.$refs.formPerfil.validate()) {
            let accion ="add";
            if(accion=="add"){
               me.formulario.id_aspirante = me.arrayAspirante.id;
               me.formulario.id_egresado = me.arrayAlumno.id;
              me.$http.post(`${me.$url}/perfil`, me.formulario, header)
                .then(function(response) {
                me.verificarDatos(response.data, response.status, accion);
               
              })
              .catch(function(error) {
                console.log(error);
                me.$swal("Error", "Ocurrio Un Error Intente Nuevamente", "error");
              });
            }
          }     
      },
      verificarDatos(formulario, statusCode, accion){
        let me = this;
        const Toast = me.$swal.mixin({
          toast: true,    
          
        });

        switch (accion) {
          case "add":
            Toast.fire({
              width:'90%',
              padding:'1rem',
              backdrop:true,
              title: 'A dónde vas tan rápido Vaquero?',
              text: "Revisa muy bien tu información antes de ser enviada!, una vez enviada no podras cambiar tu información",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Enviar mi información',
              cancelButtonText: 'Cancelar, revisare mi información'
            }).then((result) => {
              if (result.isConfirmed) {
                Toast.fire(
                  'Enviada Correctamente!',
                  'Tu información ha sido enviada con éxito',
                  'success'
                )
              }
            });
            break;
            }
      }

    },
    mounted() {
       
      let x = sessionStorage.getItem('tokenS');
      if(x != null){
        this.fetchAspirantes();
      }else{
         
         this.$router.push('/login')
      }
      let me = this;

      me.fetchAspirantes();
      me.fetchEgresado();
      me.fetchIdiomas();
      me.fetchAnio();
      me.fetcCarrera();
    },
  };
</script>
<style>
.pie_info{
  color: red;
 text-align:center;
 padding-left: 120px;
 font-size: 20px;
}
</style>