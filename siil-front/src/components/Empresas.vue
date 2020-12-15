<template>
  <div class="content">
    <div class="md-layout-item md-medium-size-100 md-xsmall-size-100 md-size-100">
      <v-overlay :value="loader" :z-index="'99999999'">
        <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
      </v-overlay>
      <v-card>
        <v-card-title>
          Listado de Empresas
          <div class="flex-grow-1"></div>
          <v-text-field v-model="searchEmpresa" label="Buscar Empresa" hide-details></v-text-field>
        </v-card-title>
        <v-data-table
          :headers="hTBEmpresas"
          :items="arrayEmpresas"
          :footer-props="{
            'items-per-page-options': [5,10, 20, 30,40],
            'items-per-page-text' : 'Registros Por Página'
          }"
          :items-per-page="5"
          :search="searchEmpresa"
          multi-sort
          class="elevation-1"
        >
          <!-- Template Para Modal de Actualizar y Agregar Area -->

          <template v-slot:top>
            <v-toolbar flat color="white">
              <div class="flex-grow-1"></div>
              <v-dialog v-model="modalEmpresa" persistent max-width="700px">
                <template v-slot:activator="{ on }">
                  <v-btn elevation="10" color="grey darken-3" dark class="mb-2" v-on="on">
                    Agregar&nbsp;
                    <v-icon>mdi-plus-box-multiple-outline</v-icon>
                  </v-btn>
                </template>
                <v-card>
                  <v-card-title class="headline grey lighten-2" primary-titles>
                    <span class="headline" v-text="formTitle"></span>
                  </v-card-title>
                  <v-card-text>
                    <v-container>
                      <v-form ref="formEmpresas" v-model="validForm" :lazy-validation="true">
                        <v-text-field
                          append-icon="mdi-folder-outline"
                          v-model="empresa.nombre"
                          @keyup="errorsNombre = []"
                          :rules="[v => !!v || 'Nombre Es Requerido']"
                          label="Nombre"
                          required
                          :error-messages="errorsNombre"
                        ></v-text-field> 

                        <v-text-field
                          append-icon="mdi-folder-outline"
                          v-model="empresa.direccion"
                          @keyup="errorsNombre = []"
                          :rules="[v => !!v || 'La Direccion Es Requerida']"
                          label="Direccion"
                          required
                          :error-messages="errorsNombre"
                        ></v-text-field> 

                        <v-text-field
                          append-icon="mdi-folder-outline"
                          v-model="empresa.telefono"
                          @keyup="errorsNombre = []"
                          :rules="[v => !!v || 'El Telefono Es Requerido']"
                          label="Telefono"
                          required
                          :error-messages="errorsNombre"
                        ></v-text-field> 

                        <v-text-field
                          append-icon="mdi-folder-outline"
                          v-model="empresa.encargado"
                          @keyup="errorsNombre = []"
                          :rules="[v => !!v || 'El Encargado Es Requerido']"
                          label="Encargado"
                          required
                          :error-messages="errorsNombre"
                        ></v-text-field> 

                        <v-select
                        v-model="empresa.idarea"
                        label="Seleccionar Area"
                         :rules="[v => !!v || 'Este Campor es requerido']"
                        :items="listarea"
                        :item-text="'nombre'"
                        :item-value="'id'"
                    
                      ></v-select>

                      <v-select
                        v-model="empresa.idusuario"
                        label="Seleccionar usuario"
                        :rules="[v => !!v || 'Este Campor es requerido']"
                        :items="listcoordinadores"
                        :item-text="'nombres'"
                        :item-value="'id'"
                    
                      ></v-select>
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
                      @click="saveEmpresa()"
                      text
                      v-text="btnTitle"
                    ></v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-toolbar>
</template>

       
          <!-- Template que va en la tabla en la columna de Acciones (Editar,Desactivar) -->

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
        &nbsp;&nbsp;
          
        <v-tooltip top>
          <template v-slot:activator="{on}">
            <v-btn
              color="info"            
              elevation="8"
              small
              dark
              fab
              :disabled="item.id < 0"
              v-on="on"
              @click="deleteEmpresas(item)"
            >
            <v-icon>delete</v-icon>
            </v-btn>
          </template>
          <span>Eliminar Registro</span>
        </v-tooltip>
      </template>
        </v-data-table>
      </v-card>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      arrayEmpresas: [],
      hTBEmpresas: [
        { text: "Nombre", value: "nombre", class:'blue-grey lighten-4 ' },
        { text: "Direccion", value: "direccion" , class:'blue-grey lighten-4 '},
        { text: "Telefono", value: "telefono", class:'blue-grey lighten-4 ' },
        { text: "Encargado", value: "encargado" , class:'blue-grey lighten-4 '},
        { text: "Area", value: "idarea", class:'blue-grey lighten-4 ' },
        { text: "Acciones", value: "action", sortable: false, align: "center", class:'blue-grey lighten-4 ' }
      ],
      loader: false,
      searchEmpresa: "",
      modalEmpresa: false,
      listcoordinadores:[],
      listarea:[],
      empresa: {
        id: null,
        nombre: "",
        direccion:"",
        telefono:"",
        encargado:"",
        idarea: "",
        idusuario: ""
        
      },
      validForm: true,
      snackbar: false,
      msjSnackBar: "",
      errorsNombre: [],
      editedEmpresa: 0
    };
  },
   computed: {
      formTitle(){
        return this.empresa.id == null
        ? "Agregar Empresa"
        : "Actualizar Empresa";
      },
      btnTitle(){
        return this.empresa.id == null ? "Guardar" : "Actualizar";
      },
    },
    
    methods: {
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
      fetchusuarios() {
      let me = this;
      me.loader = true;
      
       me.$http.get(`${me.$url}/usuarios`)
        .then(function(response) {
          console.log(response.data);
          me.listcoordinadores = response.data;
          me.loader = false;
        })
        .catch(function(error) {
          me.loader = false;
          console.log(error);
        });
    },
     fetchArea() {
      let me = this;
      me.loader = true;
      
       me.$http.get(`${me.$url}/areas`)
        .then(function(response) {
          me.listarea = response.data;
          me.loader = false;
        })
        .catch(function(error) {
          me.loader = false;
          console.log(error);
        });
    },
  
      cerrarModal(){
        let me = this;
        me.modalEmpresa = false;
        setTimeout(() => {
          me.empresa = {
            id:null,
              nombre: "",
                direccion:"",
                telefono:"",
                idarea: "",
                idusuario: ""
          };
          me.resetValidation();
        }, 300);
      },
      resetValidation() {
        let me = this;
        me.errorsNombre = [];
        me.$refs.formEmpresas.resetValidation();
      },
      showModalEditar(empresa) {
        let me = this;
        me.editedEmpresa = me.arrayEmpresas.indexOf(empresa);
        me.empresa = Object.assign({},empresa);
        me.modalEmpresa = true;
      },
      /*saveAreas() {
        let me = this;
       
        if(me.$refs.formAreas.validate()) {
          let accion = me.areas.id == null ? "add" : "upd";
          me.loader = true;
          me.$http
            .post(`${me.$url}/areas`, me.areas)
            .then(function(response) {
              me.verificarAccionDato(response.data, response.status, accion);
              me.cerrarModal();
            })
            .catch(function(error) {
              console.log(error);
              //409 conflicts Error (Proveedor ya existe en la base de datos)
              if(error.response.status == 409) {
                me.setMessageToSnackBar("Areas Ya Existente", true);
                me.errorsNombre = ["Nombre de la Areas ya Existente"];
              }else {
                me.$swal("Error", "Ocurrido Un Error Intente de Nuevovamente", "error");
              }
              me.loader = false;
            });
            }else{
            //para actualizar
            me.$http.put('/areas/'+me.area.id, me.area)
               .then(function(response) {
                   console.log(response.data);
                    me.verificarAccionDato(response.data, response.status, "upd");
                    me.cerrarModal();
            })
          .catch(function(error) {
            console.log(error);
            me.loader = false;
          });
        }
      },*/
      saveEmpresa() {
      let me = this;
      if (me.$refs.formEmpresas.validate()) {
         let accion = me.empresa.id == null ? "add" : "upd";
        me.loader = true;
        if(accion=="add"){
          console.log(me.empresa);
           me.$http.post(`${me.$url}/empresas`, me.empresa)
            .then(function(response) {
            me.verificarAccionDato(response.data, response.status, accion);
            me.cerrarModal();
          })
          .catch(function(error) {
            console.log(error);
            //409 Conflicts Error (Proveedor Ya Existente En la BD)
            if (error.response.status == 409) {
              me.setMessageToSnackBar("Empresa Ya Existe", true);
              me.errorsNombre = ["Nombre De Empresa Existente"];
            } else {
              me.$swal("Error", "Ocurrio Un Error Intente Nuevamente", "error");
            }
            me.loader = false;
          });
        }else{
            //para actualizar
            me.$http.put(`${me.$url}/empresas/`+ me.empresa.id,me.empresa)
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
      setMessageToSnackBar(msj, estado) {
        let me = this;
        me.snackbar = estado;
        me.msjSnackBar = msj;
      },
      deleteEmpresas(empresa) {
        let me = this;
        
        me.editedEmpresa = me.arrayEmpresas.indexOf(empresa);
         const Toast = me.$swal.mixin({
           toast: true,
           position: "bottom-end",
           showConfirmButton: true,
           timer: 3000
         });
         me.$swal({
           title: "Eliminar Empresa?",
           text: "Una vez realizada la accion no se podra revertir ",
           icon: "question",
           showCancelButton: true,
           confirmButtonText: "Si",
           cancelButtonText: "No",
           reverseButtons: true,
           focusConfirm: false,
           focusCancel: true,
           showCloseButton: true
         }).then(result => {
           if (result.value) {
             me.loader = true;
             me.$http
              .delete(`${me.$url}/empresas/`+ empresa.id)
              .then(function(response){
                
                me.verificarAccionDato(response.data, response.status, "del");
                me.loader = false;
              })
              .catch(function(error) {
                if(error.response.status == 510){
                  Toast.fire({
                    icon: "error",
                    title: "No se puede eliminar esta Areas, tiene registrados"
                  });
                }
                me.loader = false;
              });
           }
         });
      },
      verificarAccionDato(areas, statusCode, accion) {
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
            me.arrayEmpresas.unshift(areas);
            this.fetchEmpresa(); 
            Toast.fire({
              icon: "success",
              title: "Areas Registrada con Exito"
            });
            me.loader = false;
            break;

          case "upd":
            //Actualizando al array de categorias el objeto que devuelve el Backend ya con los datos
            //Object.assign(me.arrayAreas[me.editedAreas], areas);
            this.fetchEmpresa(); 
            Toast.fire({
              icon:"success",
              title: "Areas Actualizada con Exito"
            });
            me.loader = false;
            break;
          case "del":
            if (statusCode == 200) {
              try{
                //se elimina del array de categorias activos si todo esta bien en el backend
                me.arrayEmpresas.splice(me.editedEmpresa, 1);
                //se lanza mensaje final
                me.$swal.fire("Eliminado", "Area Eliminada", "success");
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

    },
    mounted() {
       
      let x = sessionStorage.getItem('tokenS');
      if(x != null){
        this.fetchEmpresa();
        this.fetchusuarios();
        this.fetchArea();
      }else{
         
         this.$router.push('/login')
      }
       
    },
  };
</script>