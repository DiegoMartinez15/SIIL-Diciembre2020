<template >
<div >
  <v-app  
   
  >
    
    <!--<v-app-bar app dark color="blue">
      <v-toolbar-title>ITCHA-AGAPE</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text rounded>Inicio</v-btn>
    </v-app-bar>-->
     
    <v-main id="body1">
      <v-col
          cols="12"
          md="12"
          
        >
      <v-card width="350" class="mx-auto  mt-16  pl-5 pr-5 ">
        <v-card-title class="justify-center pt-12 font-weight-medium  "  id="title">
          Inicia Sesión
        </v-card-title>
        <v-img 
              id="id" :src="'/itcha/escudo.png'"></v-img>
        <v-card-text>
          <v-form  ref="formUsuarios" v-model="validForm" :lazy-validation="true">
          <v-text-field
           required :rules="[v => !!v || 'El codigo es requerido']"
            label="Codigo de Carnet"
            v-model="login.email"
             prepend-icon="mdi-account-circle"/>
          <v-text-field 
          required
          label="Contraseña" 
          :type="showPassword ? 'text' : 'password'"
          v-model="login.password"
          prepend-icon="mdi-lock"
          :rules="[v => !!v || 'La Contraseña es requerida']"
          :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          @click:append="showPassword = !showPassword"/>
          </v-form>
        </v-card-text>

        
        <v-card-actions>
           <v-row align="center">
             <v-col
              cols="12"
              mx="6"
            >
            <div class="text-center">
              <div class="my-2">
                <v-btn block color="info" @click="loginUsuario()" >
                  <v-icon left>
                    mdi mdi-account-key
                  </v-icon>Login
                </v-btn>
              </div>
            </div>
             </v-col>
           </v-row>
        </v-card-actions>
      </v-card>
      </v-col>
      <h3 class=" black--text text-center mt-8">Portal Laboral</h3>
      <p class=" black--text text-center">Instituto Tecnológico de Chalatenango
        <strong> ITCHA-AGAPE •</strong>
        <a class=" orange--text" href="https://www.itcha.edu.sv/" target="_blank">www.itcha.edu.sv</a></p>
    </v-main>
     
    

    <template>
    <v-footer dark color="blue" >
      <span class="py-2 white--text text-center">&copy; {{new Date().getFullYear()}} - Derechos Reservados - ITCHA AGAPE</span>
    </v-footer>
  </template>
  </v-app>
  </div>
</template>
<script>

  export default {
    data () {
      return {
        showPassword: false,
         dialog: false,
         user: {
             name: "",
             email: "",
             password: "",
         },
         validForm:true,
         login:{
             email: "",
             password: "",
         },
      };
    },
    methods: {
      //Metodo registro de usuarios con token listo ya no se hace aqui
        /*fetchUsuarios() {
            let me = this;
            me.$http
            .post(`${me.$url}/users`, me.user )
            .then(function(response){
              me.dialog = false;
              alert("Registrado con exito");
                console.log(response.data);
            })
            .catch(function(error){
              console.log(error);
            });
          },*/
          //Metodo para aunteticar al usuario 
        loginUsuario(){
        let me = this;
        if(me.$refs.formUsuarios.validate()){
            me.$http
            .post(`${me.$url}/login`, me.login)
            .then(function(response){
              if(response.status == 200){
                let msg = response.data.message;
                  switch (msg) {
                    case "Ingresa Las credenciales correctas":
                       me.$swal({
                        title: "Error!",
                        text: "¡Ingresa Las credenciales correctas!",
                        icon: "error"
                      });
                      break;
                   case "Tus credenciales no estan registradas":
                       me.$swal({
                        title: "Error!",
                        text: "¡Este usuario no esta registrado!",
                        icon: "error"
                      });
                      break;
                  }       
                let x = response.data.token;
                sessionStorage.setItem('tokenS',x)
                localStorage.setItem('token',x);
                let user = response.data.user;
                let dataU = response.data.dataUser; 
                let estado = user.estado;

                 switch (estado) {
                    case "A":
                      me.$router.push('/ofertas');
                      me.$store.commit('add',dataU.nombres);
                      me.$store.commit('permission',user.idtipo_usuario);
                      me.$store.commit('setid',user.idaspirante);
                      console.log('este es el id del aspirante'+ user.idaspirante)
                      me.$swal({title:"Bienvenido",position: 'center',
                      icon: 'success',                                      
                      showConfirmButton: false,
                      timer: 2500
                      
                    });
                      break;
                    case "N":
                      me.$router.push('/accept');
                        me.$store.commit('add',dataU.nombres);
                        me.$store.commit('permission',user.idtipo_usuario);
                        me.$store.commit('setid',user.idaspirante);
                        console.log('este es el id del aspirante'+ user.idaspirante)
                        me.$swal({
                          title:"Llena el proceso para continuar",
                          timer: 2500,showConfirmButton: false,                                            
                          })
                          me.$swal.showLoading()
                      break;
                    case "I":                     
                      me.$swal({
                         icon: 'error',
                          title: 'Informacion',
                          text: 'No acepto el seguimiento!',
                          footer: 'Comunicarse con el encargado',
                          backdrop:true
                        })                   
                        me.$router.push('/login');                     
                      break;
                  }
              }
            })
            .catch(function(error){
              console.log(error);
            });
            }
          },
        //metodo de cierre de session 
           logout(){
            //let x = localStorage.getItem('token');
             let y = sessionStorage.getItem('tokenS')
            let me = this,
            header = {
              headers: {
                "Authorization": "Bearer "+ y,
              },
            };
             me.$http.get(`${me.$url}/logout`,header)
            .then(function(response){ 
               if(response.status==200){ 
                  localStorage.clear();           
                  alert("Adios");
                console.log(response.data);
               }                        
            })
            .catch(function(error){              
              console.log(error);
            });
          },
    },  
    mounted(){
    },
  };
</script>
<!--estilo css para solo el login -->
<style >
#body1{
  
  background-image: url('/itcha/11.png');
  background-repeat: no-repeat;
  background-size: 100% 100%;
  
}
#title{
  
  font-family: "Segoe UI";
  font-size: 30px;
  text-align: center;
  
}
#id{
  display:block;
  margin: 0 auto;
  width: 140px;
  height: 180px;
 
}

</style>