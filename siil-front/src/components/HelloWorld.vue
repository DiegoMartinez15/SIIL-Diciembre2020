<template >
     <section>
       <v-overlay :value="loader" :z-index="'99999999'">
        <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
      </v-overlay>
      <template >
        <v-card style="margin:20px">
        <v-carousel
        show-arrows-on-hover cycle interval="20000" class="mt-6" height="200"  v-model="model">
          <v-carousel-item
            v-for="(color, i) in colors"
            :key="i"
            :src="'/itcha/'+ color.src"
          >
          </v-carousel-item>

        </v-carousel>
        </v-card>
      </template>
    <v-container fluid style="position:relative" >
      <div id="titleoferta" >
      
        <h1>Ofertas de Empleo</h1>
        
      </div>

      
  <div id="principalcard">
      <v-col
        class="d-flex"
        cols="12"
        sm="4"
      >
        
        <v-autocomplete
        class="ml-5"
          width="100"
           v-model="arraybusqueda"
            label="Buscar Por"
            :items="arrayAreas"
            :item-text="'nombre'"
            :item-value="'nombre'"
             dense
            solo
            @change="ofertaupd()"
                    
            ></v-autocomplete>
             
        
      

          <v-autocomplete
        class="ml-5"
          width="100"
          
           v-model="arraybusqueda"
            label="Zona de Trabajos"
            :items="findwork"
            :item-text="'lugar_trabajo'"
            :item-value="'lugar_trabajo'"
             dense
            solo
            @change="findworklist()"
                    
            ></v-autocomplete>
          
         </v-col>
         
         <v-progress-linear
          color="blue-grey lighten-1"
          rounded
        ></v-progress-linear>
      

        

      <!-- Default box -->
     
      <v-row class="row align-content-between  mt-5 rounded" dense>
        <!--Comienzo del card
        <v-img  id="cardimg" class="img-circle img-fluid elevation-1" :src="'/ImgOfertas/'+ item.img"   height="160"></v-img>
         -->   
        <v-card id="cardoferta"  v-for="(item, index) in items" :key="index" v-show="mostar == true"   class="mx-auto elevation-6" width="295"  style="margin: 20px" >
              <div class=" text-center" >
                <v-avatar 
                      class="mt-4 "
                      size="140">
                        <img style="border:2px solid grey"
                          :src="'/ImgOfertas/'+ item.img"
                          @click="loadimage(item.img)"
                          
                        >
                      </v-avatar>
                  
              </div>
            <div >
                <div id="padre"  style="padding-left:6px;">
                  <v-card-title v-bind="items" >
                    <h3 class="font-italic " style="margin-top:40px;border-bottom:2px solid grey;margin-bottom:10px" ><b>{{item.idempresa}}</b></h3>
                  </v-card-title>
                    <v-card-subtitle style="font-size: 13px;" >
                      <v-icon>work</v-icon>&nbsp;<b>Vacante:&nbsp;&nbsp;</b>{{item.cargo}}
                    </v-card-subtitle>
                     <v-card-subtitle style="font-size: 13px;">
                    <v-icon>groups</v-icon> &nbsp;<b>Cupos disponibles:&nbsp;&nbsp;</b><strong style="font-size: 15px;margin-rigth:2px">{{item.vacante}}</strong>
                    </v-card-subtitle>

                    <v-card-subtitle style="font-size: 13px;">
                    <v-icon>business</v-icon> &nbsp;<b>Lugar de trabajo:&nbsp;&nbsp;</b>{{item.lugar_trabajo}}
                    </v-card-subtitle>

                   <!-- <v-card-subtitle>
                    <v-icon>business</v-icon> &nbsp;<b> Direccion:&nbsp;&nbsp;</b>{{item.direccion}}
                    </v-card-subtitle>-->
                    <v-card-subtitle style="font-size: 13px;margin-bottom:20px;" >
                      <v-icon>call</v-icon>&nbsp;<b>telefono:&nbsp;&nbsp;</b>{{item.telefono}}
                    </v-card-subtitle>

                </div>
                  
                <v-card-actions id="cardactions" >
                  
                  <v-col class="text-center mt-14 " cols="12" :sm="sm" style="display:flex;margin-left:3%">
                   
                      <v-btn @click="LoadModal(item.idrequisito)" id="btncard" elevation="10" color="blue darken-1" dark class="mb-2" >
                        Informacion&nbsp;
                        <v-icon>info</v-icon>
                        </v-btn>
                     </v-col>
                     <v-col cols="12" sm="4" class="mt-6" v-show="show">
                    <v-tooltip top>
                        <template v-slot:activator="{on}">
                        <v-btn
                          color="blue-grey lighten-3"            
                          elevation="8"
                          small
                          dark
                          fab
                          :disabled="item.id < 0"
                          v-on="on"
                          @click="desactivarOferta(item.id)"
                        >
                        <v-icon>delete</v-icon>
                        </v-btn>
                        </template>
                         <span>Desactivar Oferta</span>
                         </v-tooltip>
                     
                  </v-col>
                
                </v-card-actions>
            </div>
         </v-card>
         
         <v-card style="margin: 0 auto;margin-bottom:20px"  v-show="mostar == false">
            <div >
              <h1>No hay Ofertas Por el momento</h1>
            </div>
         </v-card>
        
            <!--Finaliza el card -->
            </v-row>
      </div>
      <v-progress-linear
          color="blue-grey lighten-1"
          rounded
        ></v-progress-linear>
        <template>
        <div class="text-center mt-4">
          <v-pagination
            v-if="arraybusqueda == 'Todas'"
            v-model="page"
            :length="pagination.last_page"
            circle
            @input="changePage"
          ></v-pagination>
        </div>
      </template>
    </v-container>

    
    
  
        <!-- Modal de Pollo Campero -->
       <section>
          <v-col cols="12" md="4">
           <v-dialog v-model="dialog" persistent  width="540" >
           
            <v-card id="cardform1" v-for="(item, index) in datamodal" :key="index" >
              
              <v-card-title >
                <v-row>
                  
                 <v-card id="cardtittle" class="mt-1" width="100%" >
                   <v-card-title >
                     <div style="margin-left:5px;">
                     <v-avatar 
                      size="55">
                        <img style="border:2px solid grey"
                          :src="'/ImgOfertas/'+ item.img"
                          alt="John"
                        >
                      </v-avatar>
                     </div>
                      <div style="margin-left:10px;font-size:24px;">
                       Oferta de Empleo -&nbsp;{{item.idempresa}}
                      </div>
                   </v-card-title>
                 </v-card>
                </v-row>
              </v-card-title>
              <v-card-subtitle class="mt-1">
                <h3>I.Requisitos del Empleo</h3>
              </v-card-subtitle>
              
              <v-card style="margin-bottom:16px;margin-right:10px;margin-left:10px">
                <v-card-subtitle>
                  <v-card-text v-show="item.edad"><h4><v-icon>verified</v-icon><strong id="backgrounditem">Edad Minima:</strong>&nbsp;&nbsp; {{item.edad}}&nbsp;Años</h4></v-card-text>
                  <v-card-text v-show="item.nivel_academico"><h4><v-icon>school</v-icon><strong id="backgrounditem">Nivel academico:</strong>&nbsp;&nbsp; {{item.nivel_academico}}</h4></v-card-text>
                  <v-card-text v-show="item.genero"><h4><v-icon>accessibility</v-icon><strong id="backgrounditem">Genero:</strong>&nbsp;&nbsp; {{item.genero}}</h4></v-card-text>
                  <v-card-text v-show="item.horario"><h4><v-icon>schedule</v-icon><strong id="backgrounditem">Horario:</strong>&nbsp;&nbsp; {{item.horario}}</h4></v-card-text>
                  <v-card-text v-show="item.licencia"><h4><v-icon>recent_actors</v-icon><strong id="backgrounditem">Licencia de Conducir:</strong>&nbsp;&nbsp; {{item.licencia}}</h4></v-card-text>
                  <v-card-text v-show="item.experiencia"><h4><v-icon>science</v-icon><strong id="backgrounditem">Experiencia:</strong>&nbsp;&nbsp; {{item.experiencia}}</h4></v-card-text>
                  <v-card-text v-show="item.conocimiento" ><h4><v-icon>cast_for_education</v-icon><strong id="backgrounditem">Conocimientos:</strong>&nbsp;&nbsp; {{item.conocimiento}}</h4></v-card-text>
                 
                </v-card-subtitle>
              </v-card>
              
               <v-card-subtitle class="mt-1">
                <h3>II.Ofrece</h3>
              </v-card-subtitle>
          
              <v-card style="margin-bottom:16px;margin-right:10px;margin-left:10px">
                <v-card-subtitle>
                  <v-card-text ><h4><v-icon>monetization_on</v-icon><strong id="backgrounditem">&nbsp;&nbsp;Salario: $</strong>{{item.salario}}</h4></v-card-text>
                  <v-card-text v-show="item.ambiente" ><h4><v-icon>self_improvement</v-icon><strong id="backgrounditem"></strong>{{item.ambiente}}</h4></v-card-text>
                  <v-card-text v-show="item.prestaciones" ><h4><v-icon>gavel</v-icon><strong id="backgrounditem"></strong>{{item.prestaciones}}</h4></v-card-text>
                  <v-card-text v-show="item.comiciones" ><h4><v-icon>account_balance</v-icon><strong id="backgrounditem"></strong>{{item.comiciones}}</h4></v-card-text>
                </v-card-subtitle>
              </v-card>
          
               <v-card-text v-show="item.contacto"> <v-alert
               text
                    dense
                    type="info"
                  >
                 Puedes envia tu informacion al &nbsp;&nbsp;{{item.contacto}}
                </v-alert></v-card-text>

              <v-divider></v-divider>
              <v-card-actions>
                <v-card-text><h5 id="publicado2"><v-icon>date_range</v-icon><strong id="publicadopor">Fecha de Publicacion:</strong>{{item.updated_at}} </h5></v-card-text >
                  <v-col class="text-right" cols="6" sm="4" >
                  <v-btn @click="dialog = false" color="primary">Atras</v-btn>
                  </v-col>
              </v-card-actions>
               
            </v-card>
           
          </v-dialog>
           </v-col>
          
      </section>



      <section>
        <template>
        <div class="text-center ">
          <v-dialog
            v-model="modalImg"
            width="500"
          >
            <v-card>
             
               <v-img width="500" :src="'/ImgOfertas/'+ this.img"></v-img>
              
             
            </v-card>
          </v-dialog>
        </div>
       </template>

    </section>
      </section>
      


      
</template>

<script>
    export default {
        data() {
            return{
              findwork:[],
              editedOferta:-1,
              loader:false,
              sm:8,
              showitem:false,
              img: '',
              modalImg: false,
              mostar: true,
              arraybusqueda:'Todas',
               page: 1,
               arrayAreas:[],
               items:[],
               pagination: {
                'total' :0,
                'current_page':0,
                'per_page':0,
                'last_page':0,
                'from' :0,
                'to' :0
               },
                datamodal: [],
                prueba: [],
                id: null,
                modal:0,
                modalAdd: false,
                dialog: false,
                accion: "",
                show: false,
                 model: 0,
                colors: [
                { src:'11.png'},
                {src:'accept.jpg'},
                {src:'accept1.jpg',},
                ],
                offset:3,
                
                }
              },
  computed:{

    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function(){
      if(!this.pagination.to){
        return [];
      }
      var from = this.pagination.current_page - this.offset;//TODO offset
      if(from < 1 ){
        from = 1;
      }
      var to = from + (this.offset * 2);
      if(to >= this.pagination.last_page){
        to = this.pagination.last_page;
      }

      var pageArray = [];
      while(from <= to){
        pageArray.push(from);
        from++;
      }
      return pageArray;
    }

  },
  methods: {

    loadimage(x){
      let me = this;
      me.img = x;
      me.modalImg = true;
    },

    changePage: function(page){
      this.pagination.current_page = page;
      this.fetchOfertas(this.pagination.current_page);
    },

    openmodal(){
      
      this.dialog= true;
    },

    //metodo que cargan los select xd cumbias con todo xd 
      fetchfindwork(){
        let token = sessionStorage.getItem('tokenS');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };
            me.loader = true;
            me.$http.get(`${me.$url}/ofertasw`,header)
          .then(function(response){
            me.findwork = response.data;
           
            me.loader = false;
          })
          .catch(function(error){
            me.loader = false;
            console.log(error);
          });      
      },
    fetchAreas() {  
        let token = sessionStorage.getItem('tokenS');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };     
        me.loader = true;
        me.$http.get(`${me.$url}/areas`,header,)
        .then(function(response){
          me.arrayAreas = response.data;
          let todas = {nombre:'Todas'};
          me.arrayAreas.push(todas);
          me.loader = false;
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });
      },

      //este metodo es para buscar por area
      ofertaupd(){
        let token = sessionStorage.getItem('tokenS');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };
        me.loader = true;
        
        console.log(me.arraybusqueda);
        if(me.arraybusqueda == 'Todas'){
            me.$http.get(`${me.$url}/ofertas?page=`+me.page,header)
          .then(function(response){
            me.items = response.data.ofertas.data;
            console.log(me.items);
            me.pagination = response.data.pagination;
            me.loader = false;
            me.mostar = true;
          })
          .catch(function(error){
            me.loader = false;
            console.log(error);
          });
       
        }else{
          console.log(me.arraybusqueda);
          
           me.$http.get(`${me.$url}/ofertasr?nombre=`+me.arraybusqueda,header)
          .then(function(response){                        
            me.items = response.data;        
               me.pagination = response.data.pagination;
               if(response.data.pagination == null){
                me.items = response.data;
                console.log(me.items);
               }else{                 
                  me.items = response.data.ofertas.data;
                  console.log(me.items);
               }            
               if(me.items.length > 0){
                me.mostar = true;
                }else{
                  me.mostar = false;
                }
              me.loader = false;  
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });

        }
       
      },

    //metodo para buscar por lugar del trabajo
        findworklist(){
        let token = sessionStorage.getItem('tokenS');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };
        me.loader = true;        
        if(me.arraybusqueda == 'Todas'){
            me.$http.get(`${me.$url}/ofertaswl?page=`+me.page,header)
          .then(function(response){
            me.items = response.data.ofertas.data;
            console.log(me.items);
            me.pagination = response.data.pagination;
            me.loader = false;
            me.mostar = true;
          })
          .catch(function(error){
            me.loader = false;
            console.log(error);
          });
       
        }else{
          
           me.$http.get(`${me.$url}/ofertaswl?nombre=`+me.arraybusqueda,header)
          .then(function(response){                        
            me.items = response.data;        
               me.pagination = response.data.pagination;
               if(response.data.pagination == null){
                me.items = response.data;
                console.log(me.items);
               }else{                 
                  me.items = response.data.ofertas.data;
                  console.log(me.items);
               }            
               if(me.items.length > 0){
                me.mostar = true;
                }else{
                  me.mostar = false;
                }
              me.loader = false;  
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });

        }
       
      },





     


    fetchOfertas(page) {  
        let token = sessionStorage.getItem('tokenS');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };
               
        
        me.loader = true;
        me.$http.get(`${me.$url}/ofertas?page=`+page,header)
        .then(function(response){
          me.items = response.data.ofertas.data;
          me.pagination = response.data.pagination;
          if(me.items.length == 0){
             
            me.mostar = false;
            me.loader = false;
          }
          
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });
      },
  //Metodos para cargar los requisitos de cada card
    LoadModal(id){
      let me = this;
      me.id=id;
      if(me.id != null){
        me.$http.get(`${me.$url}/requisitos?id=`+me.id)
        .then(function(response) {
          me.datamodal = response.data;
            if(me.datamodal != ""){
              me.dialog = true;
            }else{
              me.dialog = false;  
               me.$Swal.fire(
              'Lo Sentimos!!',
              'No hay informacion para mostrar',
              'info'
            )        
         }
        }).catch(function(error) {
          console.log(error);
        });
      }
    },
    //Metodo para desactivar las ofertas xd
    desactivarOferta(item){
        let me = this;
        let id = item;
        me.editedOferta = me.items.indexOf(item);
         me.$swal({
           title: "Desactivar Oferta?",
           text: "Esta accion no eliminara por completo solo desactivara la ofertas",
           icon: "warning",
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
             me.$http.put(`${me.$url}/ofertas/`+ id)
              .then(function(response){
               me.verificarAccionDato(response.data, response.status, "del");
                me.loader = false;
              })
              .catch(function(error) {
                console.log(error);
                me.loader = false;
              });
           }
         });
    },
    //esto es para las alerta sweetalert
    verificarAccionDato(ofertas, statusCode, accion) {
        let me = this;

        const Toast = me.$swal.mixin({
          toast: true,
          position: "bottom-end",
          showConfirmButton: true,
          timer: 3000
        });

        switch (accion) {
          case "del":
            if (statusCode == 200) {
              try{
                //se elimina del array de categorias activos si todo esta bien en el backend
                me.items.splice(me.editedOferta, 1);
                //se lanza mensaje final
                me.$swal.fire("Exitosamente", "Oferta desabilitada", "success");
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
  //aqui esta el mounted si no lo conocce le explico este pedaso de codigo es importante por que aqui se
  //cargaran los metodos que cuando entre a este apartado se cargaran dinamicamente y otras validacones de admin
   mounted() {
    this.fetchAreas();
    this.fetchOfertas();
    this.fetchfindwork();
    this.admin = this.$store.state.role;
      if(this.admin == 1 ){
          this.show = true;
          this.sm = 8;
          
      }else{
          this.show = false;
          this.sm = 12;
          
      }       
    }
  }
</script>
<style>


#cardoferta{
  
  border-radius: 20px;
  font-family: serif;
  width: 95%;
  margin: 0 auto;
  background: #00CED1;
 
}


#cardactions{
  height:145px;
  background: white;
  border-bottom-right-radius: 20px;
  border-bottom-left-radius: 20px;
}



#cardimg{
 
  margin: 0 auto;
  
  border: rgb(156, 165, 173) solid 1px;

}


#btncard{
  
  font-family: system-ui;
  font-size: 12px;
  width: 100%;
   margin-top: -10%;
  bottom:1px;
  
 
    
}
#titleoferta{
  background: whitesmoke;
  
  padding:6px;
  
  border-radius: 2px;
  border-bottom: solid rgb(169, 179, 189)  2px;
  text-align: center;
  font-size: 14px;
  font-family: system-ui;
  
  margin-right: 25%;
  margin-left: 25%;
}


#footercard{
 background: whitesmoke;
  padding:10px;
  border-radius: 2px;
  border-bottom: solid rgb(169, 179, 189)  2px;
  text-align: center;
  font-size: 14px;
  font-family: system-ui;
  margin-right: 40px;
  margin-left: 40px;
}
.scrollup{
    width:40px;
    height:40px;
    opacity:0.3;
    position:fixed;
    bottom:50px;
    right:100px;
    display:none;
    text-indent:-9999px;
    
}
#cardform1{
  
background: #f6f6ff;
}
#backgrounditem{
  font-size:14px;
  margin-right:5px;
  margin-left:8px;
  border-bottom: rgb(80, 94, 138) 1px solid;
       
}
#publicadopor{
   margin-right: 4px;
  font-size: 12px;
  font-family: ui-rounded;
}

#publicado2{
 
  font-size: 11px;
  font-family: serif;
}

#principalcard{
  margin-top: 15px;
  
  border-radius: 10px;
  
}
#padre{
  margin-top: -45px;
  height: 238px;
 background: #ffffff;
  
}

</style>
    