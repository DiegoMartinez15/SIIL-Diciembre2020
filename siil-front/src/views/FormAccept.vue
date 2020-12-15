<template>
<v-app  class="img">
  <div>
   <v-card width="440" class="mx-auto  mt-14  pl-5 pr-5 ">
        <v-card-title class="justify-center pt-12 "  id="title">Proceso de Aceptacion</v-card-title>
        <v-spacer></v-spacer>
        <v-card-text>
         <h4 class=" dark--text text-center ">Acceptas El proceso de Intermedacion Laboral</h4>
        </v-card-text>
        <v-card-actions class="pt-6 pb-6">
            <v-row align="center"
            justify="space-around">
                <div>
                    <v-btn
                    @click="FormLoad()"
                     color="info"> <v-icon left>
                    mdi mdi-checkbox-multiple-marked-circle
                  </v-icon>SI</v-btn>
                </div>
                <div >
                    <v-btn
                    @click="no = true"
                     color="error">
                    <v-icon left>
                    mdi mdi-close
                    </v-icon>No</v-btn>
                </div>
            </v-row>
        </v-card-actions>
        <v-card-actions class="mt " v-if="no == true">
            <v-container fluid>
                <h3><v-icon left>
                    mdi mdi-emoticon-sad
                    </v-icon>&nbsp;&nbsp;Por que no?</h3>
                <v-row align="center"
                    class="pl-10"
                    justify="space-around">
                    
              
          
                  <v-col
                      cols="12"
                      sm="6"
                      md="6"
                    >
                  <v-radio-group v-model="radioGroup">
                    <v-radio
                    @click="Campo = false"
                    label="Trabajare"
                    value="Trabajare"
                    ></v-radio>
                     <v-radio
                     @click="Campo = false"
                     checked
                    label="Seguire estudiando"
                    value="Seguire estudiando"
                      ></v-radio>
                  </v-radio-group>
                  </v-col>
                  <v-col
                      cols="12"
                      sm="6"
                      md="6">
                <v-radio-group v-model="radioGroup">
                   
                    <v-radio
                     @click="Campo = false"
                    label="Emigrare"
                    value="Emigrare"
                    
                    
                    ></v-radio>
                     <v-radio
                     @click="Campo = true"
                      label="Otro"
                      value="Otro"
                    ></v-radio>
                   
                </v-radio-group>
                </v-col>
                
               </v-row>
                <v-row >
                  <v-col
                  cols="12"
                  >
                  <div v-show="Campo == true">
                 <v-textarea
                  v-model="form.porque"
                  label="Otras situaccion"
                  
                  auto-grow
                  outlined
                  rows="1"
                  row-height="15"
                ></v-textarea>
                  </div>
                </v-col>
                 
                </v-row>
               
               <v-btn
                   
                    @click="formNotAccept()"
                     color="success"
                     >
                    <v-icon Rigth>
                    mdi mdi-near-me
                    </v-icon>Enviar</v-btn>
            </v-container>
        </v-card-actions>
      </v-card>
  </div>
  <!--Modal de acceptacion-->
  <template>
  <v-row justify="center">
    <v-dialog
     persistent
      v-model="dialog"
      width="600px"
    >
      <v-card>
        <v-card-title>
          <span class="headline">Intermedacion Laboral</span>
        </v-card-title>
        <v-card-text>
        Intermedacion Laboral es proceso que Itcha proporcia a sus Estudiantes durante un año,
        ayudando abridar ofertas de empleo en el sector publico y privado.
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="accent darken-3"
            text
            @click="formAccept()">
            Accepto
          </v-btn>
          <v-btn
            color="accent darken-3"
            text
            @click="dialog = false"
          >
            Cerrar
          </v-btn>        
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
  </template>
  <!--Fin del Modal de acceptacion-->
</v-app>
</template>
<script>
export default {
    data () {
      return {
        radioGroup: 1,
        no:false,
        dialog: false,
        Campo: false,
        form:{
           acepto: "",
          porque: "",
        },
      };
    },
      methods:{
          FormLoad(){
            let me = this;
             me.dialog = true;
             me.no = false;
          },
          formAccept() {
            let me = this;
             me.form.acepto = "SI";
            me.$http
            .post(`${me.$url}/formfirst`, this.form,{
              headers:{
                Authorization: 'Bearer '+localStorage.getItem('token'),
              }
            } )
            .then(function(response){
               console.log(me.form);
              me.dialog = false;
              me.$swal({
                      title:"Acepto el Seguimiento",
                      text:'Bienvenido',
                      position: 'center',
                      icon: 'success',                     
                      showConfirmButton: false,
                      timer: 2500
                    });
                console.log(response.data);
                    me.$router.push('/ofertas');
            })
            .catch(function(error){
              console.log(error);
            });
          },
          formNotAccept(){
              let me = this;
                  if(me.radioGroup == "Otro"){
                    me.form.acepto = "NO";
                    console.log(me.form);
                  }else{
                    me.form.acepto = "NO";
                    me.form.porque = me.radioGroup;
                  console.log(me.form);
                  }
              me.$http
                .post(`${me.$url}/formfirst`,me.form,{
              headers:{
                Authorization: 'Bearer '+localStorage.getItem('token'),
              }
            } )
                .then(function(response){
                    console.log(response.data);
                     me.logout();  
                })
                .catch(function(error){
                  console.log(error);
            });
           
          },
          logout(){
             let x = localStorage.getItem('token');
            let me = this,
            header = {
              headers: {
                "Authorization": "Bearer "+ x,
              },
            };
             me.$http.get(`${me.$url}/logout`,header)
            .then(function(response){ 
               if(response.status==200){ 
                  localStorage.clear();           
                  me.$swal({
                    title:"No acepto el proceso de Intermedacion Laboral",
                    icon: 'info',
                    timer: 10500,
                    showConfirmButton: false,
                    footer: 'Para mayor informacion comunicarse con el encargado'                     
                    });
                  me.$router.push('/login');
               }                        
            })
            .catch(function(error){              
              console.log(error);
            });
          }
    },
    mounted(){
       let x =localStorage.getItem('token')
      if(x != null){
        console.log("Si tienes acceso");
      }else{
         
         this.$router.push('/login')
      }
       

    },
};
</script>
<style scoped>

.img{
    background-image: url('/itcha/accept1.jpg');
    background-repeat: no-repeat;
    background-size: 100% 100%;
    
}

</style>
