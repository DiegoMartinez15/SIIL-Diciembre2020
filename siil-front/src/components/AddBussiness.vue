<template>
  <div>
     <div class="md-layout-item md-medium-size-100 md-xsmall-sixe-100 md-size-100">
    
    <v-overlay :value="loader" :z-index="'99999999'">
        <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
    </v-overlay>
    
     </div>
     <thead id="title" style="font-size:40px;align:center;">Registro de Ofertas de Empleo</thead>
      
       
  <v-form ref="formOferta" v-model="validForm" :lazy-validation="true" >
    
    <v-container>
      <v-card id="cardform1">
       <v-card-title><h4 style="font-size:25px">I. Datos de las ofertas</h4></v-card-title>
       <v-card-subtitle>
      <v-row>
        <v-col
          cols="12"
          md="4"
          style=" display:flex;margin: 0 10px;"
        >
          <v-text-field 
            v-model="ofertas.cargo"
            :rules="[v => !!v || 'Este Campo es requerido']"
            label="Cargo"
            required
          ></v-text-field>
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon
              
              v-bind="attrs"
              v-on="on"
            >
              info
            </v-icon>
          </template>
          <span>vacante que ofrece la empresa</span>
       </v-tooltip>
          
        </v-col>


      <v-col
          cols="12"
          md="3"
          style=" display:flex;margin: 0 10px;"
        >
          <v-text-field 
            type="number"
            min="1"
            v-model="ofertas.salario"
            :disabled="ofertas.salario == 'Adefinir'"
            :rules="[v => !!v || 'Este Campo es requerido']"
            label="Salario"
            required
          ></v-text-field>
          
           <v-checkbox
           class="ml-5"
           
            v-model="ofertas.salario"
            label="Adefinir"
            value="Adefinir"
          ></v-checkbox>
        </v-col>



        <v-col
          cols="12"
          md="2"
        >
     
        <v-text-field 
            type="number"
            min="1"
            v-model="ofertas.vacantes"
            :rules="[v => !!v || 'Este Campo es requerido']"
            label="Vacantes Cant."
            required
          ></v-text-field>

         
        </v-col>

        <v-col
          cols="12"
          md="3"
        >

           <v-autocomplete
            v-model="ofertas.idempresa"          
            label="Empresas"
            :rules="[v => !!v || 'Este Campo es requerido']"
            :items="arrayEmpresas"
            :item-text="'nombre'"
            :item-value="'id'"
            clearlead
            required
          ></v-autocomplete>
        </v-col>
        <v-col
          cols="12"
          md="3"
          style=" display:flex;margin: 0 10px;"
        >
          <v-text-field 
            v-model="ofertas.contacto"
            :rules="[v => !!v || 'Este Campo es requerido']"
            label="Contacto"
            required
          ></v-text-field>

           <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon              
              v-bind="attrs"
              v-on="on"
            >
              info
            </v-icon>
          </template>
          <span>Contacto para enviar informaci&oacute;n puede ser telefono o E-mail</span>
       </v-tooltip>
        </v-col>

        <v-col
          cols="12"
          sm="6"
          md="3"
        >
         <v-text-field 
         
            v-model="ofertas.lugar_trabajo"
            :rules="[v => !!v || 'Este Campo es requerido']"
            label="zona de la vacante"
            required
          ></v-text-field>
        </v-col>
        <!-- <v-autocomplete label="Usuario de registro"
         :rules="[v => !!v || 'Este Campo es requerido']"
         v-model="ofertas.idusuario"
          :items="arrayUsuarios"
         :item-text="'nombres'"
         :item-value="'id'"></v-autocomplete>-->

         
      
          <div class="custom-input-file col-md-6 col-sm-6 col-xs-6 mb-10">
            <input type="file" @change="ObtenerImagen" id="fichero-tarifas" class="input-file " value="" accept="image/*"/>
            Subir Imagen...
          </div>
        
        <v-col
          cols="12"
          md="4"
        >
        <div id="imgborder" >
        
        <v-img   width="145" height="155" :src="imagen"></v-img>
        </div>
        </v-col>
      </v-row>
      </v-card-subtitle>
      </v-card>
    </v-container>
   <v-container>
    <v-card id="cardform1">
      <v-card-title><h4 style="font-size:25px">II. Datos de requisitos de ofertas</h4></v-card-title>
      <v-card-subtitle>
     <v-row>
         <v-col
          cols="12"
          md="4"
        >
         <v-autocomplete label="Género"
         v-model="ofertas.genero"
         :rules="[v => !!v || 'Este Campo es requerido']"
         :items="generos"
         :item-text="'genero'"
         :item-value="'genero'"></v-autocomplete>
        </v-col>

        <v-col
          cols="12"
          md="2"
          style=" display:flex;margin: 0 10px;"
          
        >
        <v-text-field
        v-model="ofertas.edad"
        :rules="[v => !!v || 'Este Campo es requerido']"
        hide-details
        single-line
        min="14"
        
        label="Edad "
        width="20"
        type="number"
        />
        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon              
              v-bind="attrs"
              v-on="on"
            >
              info
            </v-icon>
          </template>
          <span>Edad mínima para obtener el empleo</span>
       </v-tooltip>
        </v-col>
        <v-col
          cols="12"
          md="4"
        >
         <v-autocomplete label="Nivel Académico"
         v-model="ofertas.nivel_academico"
         :rules="[v => !!v || 'Este Campo es requerido']"
         :items="nivel_academico"
         :item-text="'nivel'"
         :item-value="'nivel'"></v-autocomplete>
        </v-col>

        <v-col
          cols="12"
          md="4"
        >
          <v-text-field
            v-model="ofertas.experiencia"
            :rules="[v => !!v || 'Este Campo es requerido']"
            label="Experiencia Laboral"
            required
          ></v-text-field>
        </v-col>
         <v-col
          cols="12"
          md="2"
        >
         <v-autocomplete label="Horario"
         :rules="[v => !!v || 'Este Campo es requerido']"
         v-model="ofertas.horarios"
         :items="horarios"
         :item-text="'horario'"
         :item-value="'horario'"></v-autocomplete>
        </v-col>

         <v-col
          cols="12"
          md="2"
        >
         <v-autocomplete label="Licencia de conducir"
         v-model="ofertas.licencia"
         :rules="[v => !!v || 'Este Campo es requerido']"
         :items="licencia"
         :item-text="'estado'"
         :item-value="'estado'"></v-autocomplete>
        </v-col>
        <v-col
          cols="12"
          md="3"
        >
          <v-checkbox
            v-model="ofertas.ambiente"
            label="Buen Ambiente Laboral"
            value="Buen Ambiente Laboral"
          ></v-checkbox>
          <v-checkbox
            v-model="ofertas.prestaciones"
            label="Prestaciones de Ley"
            value="Prestaciones de Ley"
          ></v-checkbox>
          <v-checkbox
            v-model="ofertas.comicion"
            label="Comiciones"
            value="Comiciones"
          ></v-checkbox>
        </v-col>
         <v-col 
          cols="12"
          style="display:flex;margin: 0 10px;margin-top:-50px"
          md="8"
        >
           <v-textarea
           rows="2"
            @keyup="errorsNombre = []"
            :error-messages="errorsNombre"
            v-model="ofertas.conocimiento"
            name="txaHabilidades"
            :rules="[v => !!v || 'Este Campo es requerido']"
            label="Conocimientos"
            hint="Digitar breve descripcion del empleo"
          ></v-textarea>
          &nbsp;&nbsp;
          <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-icon              
              v-bind="attrs"
              v-on="on"
            >
              info
            </v-icon>
          </template>
          <span>Conocimientos requeridos</span>
       </v-tooltip>
        </v-col>

      </v-row>
      </v-card-subtitle>
    </v-card>
    </v-container>
  </v-form>
    <v-col
    col="12"
    md="12"
    >
      <v-btn
        id="btnoferta"
        color="success"
        @click="saveoferta()" >Guardar Oferta</v-btn>
    </v-col>
  
     
  </div>
</template>
<script>
 
  export default {
      data () {
      return {
        files: '',
        imagenmin: '',
        errorsNombre:[],
        arrayEmpresas: [],
        arrayUsuarios: [],
        validForm: false,
        loader:false,
        ofertas:{
        comicion: '',
        prestaciones:'',
        ambiente:'',
        cargo: '',
        img:'',
        genero:'',
        nivel_academico:'',
        horarios:'',
        edad:'',
        experiencia:'',
        conocimiento:'',
        contacto:'',
        licencia:'',
        idempresa: null,
        idusuario:null,       
        salario:'',
        lugar_trabajo:'',
       
      },
      ambiente:[
        {id:'1',estado:'SI'},
      ],

      licencia:[
        {id:'1',estado:'Requerida'},
        {id:'2',estado:'No Requerida'},
        
      ],
      
      generos:[
          {id:'1',genero:'Masculinos'},
          {id:'2',genero:'Femenino'},
          {id:'3',genero:'Ambos géneros'},
      ],
      nivel_academico:[
          {id:'1',nivel:'Nivel de Educación Básica'},
          {id:'2',nivel:'Nivel de Educación Media'},
          {id:'3',nivel:'Nivel de Educación Superior'}
      ],
      horarios:[
        {id:'1',horario:'Medio Tiempo'},
        {id:'2',horario:'Tiempo Completo'},
        
      ]
       
      };
    },
    methods:{
        cerrarModal(){
        let me = this;
        setTimeout(() => {
          me.ofertas={
              lugar_trabajo:'',
              Vacantes: null,
              comicion: '',
              prestacione:'',
              ambiente:'',
              cargo: '',
              img:null,
              genero:'',
              nivel_academico:'',
              horarios:'',
              edad:'',
              experiencia:'',
              conocimiento:'',
              licencia:'',
              idempresa: null,
              idusuario:null,       
              salario:'',
              contacto:'',
          };
          me.resetValidation();
        }, 300);
        },
      resetValidation() {
        let me = this;        
        me.$refs.formOferta.resetValidation();
      },
        fetchEmpresa() {  
        let token = sessionStorage.getItem('tokenS');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };
               
        me.loader = true;
        me.$http.get(`${me.$url}/empresas`,header)
        .then(function(response){
            console.log(response.data)
          me.arrayEmpresas = response.data;
          me.loader = false;
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });
      },

       fetchUsuarios() {
        let token = sessionStorage.getItem('tokenS');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };
        me.loader = true;
        me.$http
        .get(`${me.$url}/usuarios`,header)
        .then(function(response){
          me.arrayUsuarios = response.data;
          me.loader = false;
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });
      },
      

      saveoferta() {
        
        let token = sessionStorage.getItem('tokenS');
       let formData = new FormData();
       formData.append('img',this.ofertas.img);
       formData.append('cargo',this.ofertas.cargo);
       formData.append('genero',this.ofertas.genero);
       formData.append('nivel_academico',this.ofertas.nivel_academico);
       formData.append('horario',this.ofertas.horarios);
       formData.append('edad',this.ofertas.edad);
       formData.append('experiencia',this.ofertas.experiencia);
       formData.append('conocimiento',this.ofertas.conocimiento);
       formData.append('licencia',this.ofertas.licencia);
       formData.append('prestaciones',this.ofertas.prestaciones);
       formData.append('comiciones',this.ofertas.comicion);
       formData.append('vacantes',this.ofertas.vacantes);
       formData.append('ambiente',this.ofertas.ambiente);
       formData.append('idempresa',this.ofertas.idempresa);
       formData.append('contacto',this.ofertas.contacto);
       formData.append('lugar_trabajo',this.ofertas.lugar_trabajo);
       let user = this.$store.state.usuarioLog.id;
       formData.append('idusuario',user);
       formData.append('salario',this.ofertas.salario);

      
       let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };
     
      if (me.$refs.formOferta.validate()) {
        let accion = me.ofertas.id == null ? "add" : "upd";
        me.loader = true;
        console.log(me.ofertas);
        if(accion=="add"){
           me.$http.post(`${me.$url}/ofertas`, formData,header)
            .then(function(response) {
              console.log(response.data);
            me.verificarAccionDato(response.data, response.status, accion);
            me.cerrarModal();
          })
          .catch(function(error) {
            console.log(error);
            //409 Conflicts Error (Proveedor Ya Existente En la BD)
            /*if (error.response.status == 409) {
              me.setMessageToSnackBar("oferta Ya Existe", true);
              me.errorsNombre = ["Nombre De oferta Existente"];
            } else {
              me.$swal("Error", "Ocurrio Un Error Intente Nuevamente", "error");
            }
            me.loader = false;*/
          });
        }else{
            //para actualizar
            me.$http.put(`${me.$url}/ofertas/`+ me.ofertas.id,me.ofertas)
            .then(function(response) {
              console.log(response.data);
              console.log(response.status);
              me.verificarAccionDato(response.data, response.status, "upd");
               me.cerrarModal();
            })
          .catch(function(error) {
            console.log(error);
            me.loader = false;
          });
        }
      
      }
    },

    verificarAccionDato(oferta, statusCode, accion) {
        let me = this;

        const Toast = me.$swal.mixin({
          toast: true,
          position: "bottom-end",
          showConfirmButton: true,
          timer: 3000
        });

        switch (accion) {
          case "add":
            //Agrego al array de categorias el objeto que devuelve el backend
            Toast.fire({
              icon: "success",
              title: "Oferta Registrada con Exito"
            });
            me.loader = false;
            break;

          case "upd":
            //Actualizando al array de categorias el objeto que devuelve el Backend ya con los datos
            //Object.assign(me.arrayAreas[me.editedAreas], areas);
            this.fetchAreas(); 
            Toast.fire({
              icon:"success",
              title: "Oferta Actualizada con Exito"
            });
            me.loader = false;
            break;
          case "del":
            if (statusCode == 200) {
              try{
                //se elimina del array de categorias activos si todo esta bien en el backend
                me.arrayAreas.splice(me.editedAreas, 1);
                //se lanza mensaje final
                me.$swal.fire("Eliminado", "Oferta desactivada", "success");
              }catch (error) {
                console.log(error);
              }
            }else {
              Toast.fire({
                icon: "error",
                title: "Ocurrido un Error Intente Nuevamente"
              });
            }
            break;
        }
      },

       ObtenerImagen(e){
          let file = e.target.files[0];
          console.log(file);
          this.ofertas.img = file;
          this.cargarImagen(file)
      },

      cargarImagen(file){
          let reader = new FileReader();
          reader.onload = (e) =>{
            this.imagenmin = e.target.result;
          }
          reader.readAsDataURL(file);
      }
     

    },
    computed:{
      imagen(){
        return this.imagenmin;
      }
    },
    mounted(){
      
      this.fetchEmpresa();
      this.fetchUsuarios();
    }
  
  }
</script>
<style>

#title{
    font-family: 'Open Sans', sans-serif;
}
#btnoferta{
  display: flex;
  margin: 0 auto;
 
}
  
  



.custom-input-file {
  border-radius: 7px;
  background-color: #1565C0;
  
  color: #fff;
  cursor: pointer;
  font-size: 14px;
  font-weight: bold;
  margin: 0 auto ;
  height: 40px;
  overflow: hidden;
  padding: 10px;
  position: relative;
  text-align: center;
  width: 200px;
}

.custom-input-file .input-file {
 border: 10000px solid transparent;
 cursor: pointer;
 font-size: 10000px;
 margin: 0;
 opacity: 0;
 outline: 0 none;
 padding: 0;
 position: absolute;
 right: -1000px;
 top: -1000px;
}
#imgborder{
  
   display: flex;
   margin: 0 auto;
   align-items: center;
    margin-top:-50px;
    margin-right:10px;
   width: 150px;
   height: 160px;
   border: lightslategrey 2px dotted;
}
#cardform1{
background: #f6f6ff;
}
</style>

