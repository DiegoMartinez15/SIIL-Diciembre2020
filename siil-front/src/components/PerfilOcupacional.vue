<template>
   <div class="content">
<!--FORMULARIO DE INGRESO DE DATOS-->
  <v-form v-model="valid" ref="formPerfil" :lazy-validation="true">
    
    <v-container>
      <h3 style="font-size:40px;text-align:center;color:#20202f;">Registro de Perfil Ocupacional de Graduado</h3>
    <v-divider class="black"></v-divider>
    <thead style="font-size:25px" color="##20202f">I.Datos Personales</thead>
    <v-divider class="black"></v-divider>
      <!--v-row parte 1-->
      <v-row>
         <!--nombre-->
        <v-col cols="12" md="3">
          <v-text-field
          label="Nombres"
            v-model="arrayAspirante.nombres"
            disabled
          ></v-text-field>
        </v-col>
        <!--Apellido-->
        <v-col cols="12" md="3">
          <v-text-field
          label="Apellidos"
            v-model="arrayAspirante.apellidos"
            disabled
          ></v-text-field>
        </v-col>
        <!--datepicker de nacimiento-->
        <v-col cols="12" md="2">
          <v-text-field
          label="Fecha de nacimiento"
            v-model="arrayAspirante.fecha_nac"
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
            counter
            maxlength="250"
          ></v-text-field>
        </v-col>
        <!--Direccion-->
      <v-col cols="12" md="6">
          <v-text-field
          label="Dirección"
            v-model="arrayAspirante.direccion"
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
          label="Número de teléfono"
           v-model="arrayAspirante.celular"
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
                  Por favor ingresa tu nuevo número en el recuadro de <strong>Nuevo número</strong> (si no has cambiado debes dejarlo en blanco)</span>
            </v-tooltip>
        </v-col>
        <v-col cols="12" md="2">
          <v-text-field
            counter
            maxlength="8"
            v-model="formulario.celular2"
            :rules="phoneRules"
            label="Nuevo número"
          ></v-text-field>
        </v-col>
        <!--DUI-->
        <v-col cols="12" md="3">
          <v-text-field
          label="DUI"
            v-model="arrayAspirante.dui"
            disabled
          ></v-text-field>
        </v-col>
        <!--NIT-->
        <v-col cols="12" md="2">
          <v-text-field
            counter
            maxlength="14"
            v-model="formulario.nit"
            :rules="nit"
            label="NIT"
            required
          ></v-text-field>
        </v-col>
          <!--Pasaporte-->
        <v-col cols="12" md="2" style=" display:flex;">
          <v-text-field
             counter
            maxlength="9"
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
          :rules="phoneRules"
           counter
            maxlength="14"
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
            counter
            maxlength="12"
            v-model="formulario.nup"
            label="NUP"
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
      <thead style="font-size:25px" color="#20202f">II.Estado De Salud</thead>
      <v-divider class="black"></v-divider>
      <!--v-row parte 2-->
      <v-row>
      <!--Enfermemdad Cronica-->
        <v-col cols="12" md="6">
          <v-select
          
            v-model="formulario.enfermedad_mencion"
            :items="yesno"
            label="Padece alguna Enfermedad Cronica?"
             required
            :rules="campo"
          ></v-select>
        </v-col>
         <!--si?Enfermemdad Cronica-->
        <v-col cols="12" md="6">
          <v-text-field
            counter
            maxlength="250"
           :disabled="formulario.enfermedad_mencion==='No'"
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
          counter
          maxlength="250"
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
      <thead style="font-size:25px" color="##20202f">III.Informacion Académica</thead>
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
        <v-autocomplete
         
          v-model="formulario.id_carrera"
          :items="arrayCarrera"
          label="Especialidad"
          item-text="nombre"
          item-value="id"
          clearable
          :menu-props="{ closeOnClick: true }"
        ></v-autocomplete>
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
          counter
          maxlength="250"
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
            counter
            maxlength="250"
            v-model="formulario.oficios_realizar"
            name="txaOficio"
            label="Oficios que puede realizar"
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
          <thead style="font-size:25px" color="##20202f">IV.Experiencia Laboral</thead>
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
              counter
              maxlength="100"
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
            counter
            maxlength="200"
            :disabled="formulario.experecia_laboral==='No'"
              v-model="formulario.cargo_desempenado"
              label="Cargo desempeñado"
            ></v-text-field>
          </v-col>
           <!--habilidades-->
          <v-col cols="12" md="12">
          <v-textarea
            counter
            maxlength="250"
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
            counter
            maxlength="250"
            v-model="formulario.dificultades_personales"
            name="txaDificultades"
            label="Dificultades, caracteristicas o actividades personal que debe mejorar o aprender"
            value=""
            hint="Escriba sus dificultades, caracteristicas o actividades"
          ></v-textarea>
          </v-col>
     
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
           v-model="formulario.traslado_fuera"
            :items="yesno"
            label="Disponibilidad para trasladarse fuera de Chalatenango"
          ></v-select>
          </v-col>
          <!--otras observaciones-->
          <v-col cols="12" md="12">
          <v-textarea 
            counter
            maxlength="250"
            v-model="formulario.otra_observacion"
            name="txaOtras"
            label="Otras observaciones"
            value=""
            hint="Escriba sus observaciones"
          ></v-textarea>
          </v-col>
        </v-row> 
         <v-alert
         class="pie_info"
          dense
          type="error"
          >
         Antes de enviar tu <strong>información</strong> revisa que todo este correcto
        </v-alert>
    </v-container>
    <v-divider class="black"></v-divider>
    <template>
    <v-btn block color="success" dark  
       v-show="arrayAspirante.formulario_perfil==='No'"
      elevation="8"
      @click="saveForm()"
    >Enviar mi información</v-btn>
    </template>
  </v-form>
</div>
</template>
<script>
  export default {
    data () {
      return {
        Encabezado: [
      { text: "Nombres", value: "nombres" },
      { text: "Apellidos", value: "apellidos" },
      { text: "Carrera", value: "id_carrera" },
      { text: "Año de Graduacion", value: "id_anio_graduacion" },
      { text: "Accion", value: "action", sortable: false, aling: "center" }],
      errorsNombre: [],
      modalForm:false,
      arrayAspirante:[],
      arrayIdioma:[], 
      arrayAnios:[],
      arrayCarrera:[],
      loader:false,
      valid: true,
      arrayFormulario:[],
      editedForm:-1,
      aspirante:{
        id:""
      },
      formulario:{
        id: null,
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
        idsegundo_idioma:null,
        nivel_idioma:"",
        nacionalidad:"",
        enfermedad_cronica:"",
        enfermedad_mencion:"",
        medicamento_perma:"",
        medicamento_mencion:"",
        discapacidad:"",
        nivel_academico:"",
        institucion_formadora:"",
        id_anio_graduacion:null,
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
        traslado_fuera:"",
        otra_observacion:"",
        created_at:"",
      },

      items: ['Basico', 'Intermedio', 'Avanzado'],
      yesno: ['Si', 'No'],
      time: ['Tiempo Completo', 'Medio Tiempo', 'Por Horas'],
      estados:['Soltero','Casado','Viudo'],
      nivel:['Técnico','Licenciado','Ingeniero'],
     
      nit: [
        v => !!v || 'Este campo es requerido',
        v => /^([0-9])*$/.test(v) || 'Formato no valido',
        
        ],
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
      cerrarModal() {
     let me = this;
      me.modalForm = false;
      me.$refs.formPerfil.reset();
      setTimeout(() => {
        me.formulario = {
          id: null,
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
        idsegundo_idioma:null,
        nivel_idioma:"",
        nacionalidad:"",
        enfermedad_cronica:"",
        enfermedad_mencion:"",
        medicamento_perma:"",
        medicamento_mencion:"",
        discapacidad:"",
        nivel_academico:"",
        institucion_formadora:"",
        id_anio_graduacion:null,
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
          
        };
        me.resetValidation();
        me.alert = false;
      }, 50);
    },
    resetValidation() {
      let me = this;
      me.errorsNombre = [];
      me.$refs.formPerfil.resetValidation();
    }, 
      fetchAspirantes() {    
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            }; 
            me.loader = true;
        me.formulario.id_aspirante = me.$store.state.idaspirante;
        me.$http.get(`${me.$url}/aspirante/` +   me.formulario.id_aspirante,header)
        .then(function(response){
          console.log(response.data)
          me.arrayAspirante = response.data;
          console.log(me.arrayAspirante.formulario_perfil);
          me.loader = false;
        })
        .catch(function(error){
          console.log(error);
          me.loader = false;
        });
      },
      showEditarForm(formulario) {
      let me = this;
      me.loader = true;
      me.editedForm = me.arrayFormulario.indexOf(formulario);
      
      me.formulario = Object.assign({}, formulario);
      me.modalForm = true;
      me.loader = false;
      console.log(me.formulario);
    },
     

      fetchData(){
          let me = this;
          me.fetchAspirantes();
          me.fetchIdiomas();
          me.fetchAnio();
          me.fetcCarrera();
          
      },
       fetchIdiomas() {    
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };  
            me.loader = true;        
        me.$http.get(`${me.$url}/idioma`,header)
        .then(function(response){
            console.log(response.data)
          me.arrayIdioma = response.data;
          me.loader = false;
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
            me.loader = true;     
        me.$http.get(`${me.$url}/anio_graduacion`,header)
        .then(function(response){
            console.log(response.data)
          me.arrayAnios = response.data;
          me.loader = false;
        })
        .catch(function(error){
          console.log(error);
          me.loader = false;
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
            me.loader = true;         
        me.$http.get(`${me.$url}/carreras`,header)
        .then(function(response){
            console.log(response.data)
          me.arrayCarrera = response.data;
          me.loader = false;
        })
        .catch(function(error){
          console.log(error);
          me.loader = false;
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
             const Toast = me.$swal.mixin({
              timer: 20000,
               timerProgressBar: true,   
          
            });
               Toast.fire({
              width:'200%',
              padding:'2rem',
              backdrop:true,
              title: 'A dónde vas tan rápido Amigo/a?',
              text: "Revisa muy bien tu información antes de ser enviada!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Enviar mi información',
              cancelButtonText: 'Cancelar, revisare mi información'
            }).then((result) => {
              if (result.isConfirmed) {
               me.formulario.id_egresado = me.arrayAspirante.id_egresado;
              console.log(me.formulario.id_egresado);
              console.log(me.formulario);
              
              me.$http.post(`${me.$url}/perfil`, me.formulario, header)
                .then(function(response) { 
                   me.loader = true;
                  console.log(response.data);
                  console.log(response.data.msg);
                   let msg = response.data.msg;
                switch (msg) {
                    case "nit existe":
                     me.loader = false;
                       me.$swal({
                        title: "Alerta!",
                        text: "¡No se puede guardar tu NIT por que  ya esta registrado por otro usuario, Revisa si esta escrito correctamente! :(",
                        icon: "warning"
                      });
                      break;
                   case "nup exite":
                    me.loader = false;
                       me.$swal({
                        title: "Alerta!",
                        text: "¡No se puede guardar tu NUP por que ya esta registrado por otro usuario, Revisa si esta escrito correctamente! :(",
                        icon: "warning"
                      });
                      break;
                    case "pasaporte existe":
                     me.loader = false;
                       me.$swal({
                        title: "Alerta!",
                        text: "¡No se puede guardar tu PASAPORTE por que ya esta registrado por otro usuario, Revisa si esta escrito correctamente! :(",
                        icon: "warning"
                      });
                      break;  
                      case undefined:
                        me.loader = false;
                         me.$swal({
                          title: "Completado Correctamente!",
                          text: "¡Tu información fue enviada correctamente! :(",
                          icon: "success"
                        });
                         me.$router.push('/formulario_perfil');
                      break;             
                  }  
                  /*if (msg === undefined) {
                     me.loader = false;
                       me.$swal({
                        title: "Completado Correctamente!",
                        text: "¡Tu información fue enviada correctamente! :(",
                        icon: "success"
                      });
                       me.$router.push('/formulario_perfil');
                  }*/
              })
              .catch(function(error) {
                console.log(error);
                me.$swal("Error", "Ocurrio Un Error Intente Nuevamente", "error");
              });
               
              }
            });
           
          }     
      },
    },
    mounted() {
       
      let x = sessionStorage.getItem('tokenS');
      if(x != null){
        this.fetchAspirantes();
      }else{
         
         this.$router.push('/login')
      }
       let me = this;
        me.fetchData();
    },
  };
</script>
<style>
.pie_info{
 text-align:center;
 font-size: 20px;
}
</style>