<template >
     <section>
      <template >
        <v-card style="margin:20px">
        <v-carousel
        show-arrows-on-hover cycle class="mt-6" height="200"  v-model="model">
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
        cols="8"
        sm="4"
      >
        
        <v-select
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
                    
            ></v-select>
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
                          
                        >
                      </v-avatar>
                  
              </div>
            <div >
                <div id="padre"  style="padding-left:6px;">
                  <v-card-title v-bind="items" >
                    <h3 class="font-italic " style="margin-top:40px;border-bottom:2px solid grey;margin-bottom:8px;" ><b>{{item.idempresa}}</b></h3>
                  </v-card-title>
                    <v-card-subtitle >
                      <v-icon>work</v-icon>&nbsp;<b>Vacante:&nbsp;&nbsp;</b>{{item.cargo}}
                    </v-card-subtitle>
                    <v-card-subtitle>
                    <v-icon>business</v-icon> &nbsp;<b> Direccion:&nbsp;&nbsp;</b>{{item.direccion}}
                    </v-card-subtitle>
                    <v-card-subtitle style="border-bottom:2px silver shadow " >
                      <v-icon>call</v-icon>&nbsp;<b>telefono:&nbsp;&nbsp;</b>{{item.telefono}}
                    </v-card-subtitle>
                 
                </div>
           
                <v-card-actions id="cardactions">
                  <v-col class="text-center mt-3 " cols="12" sm="12" >
                      <v-btn @click="LoadModal(item.idrequisito)" id="btncard" elevation="10" color="blue darken-1" dark class="mb-2" >
                      Informacion&nbsp;
                        <v-icon>info</v-icon>
                      </v-btn>
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
             <!--<div id="footercard" >
               <div class="text-center">
                <v-pagination
                  v-model="page"
                  :length="4"
                  circle
                ></v-pagination>
              </div>
            </div>-->
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
          <v-dialog v-model="dialog" persistent  width="600">
            <v-card id="cardform1"  v-for="(item, index) in datamodal" :key="index" >
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

              <v-card  style="margin:0 auto;width:550px;margin-bottom:16px">
                <v-card-subtitle>
                  <v-card-text ><h4><v-icon>verified</v-icon><strong id="backgrounditem">Edad Minima:</strong>&nbsp;&nbsp; {{item.edad}}&nbsp;Años</h4></v-card-text>
                  <v-card-text ><h4><v-icon>school</v-icon><strong id="backgrounditem">Nivel academico:</strong>&nbsp;&nbsp; {{item.nivel_academico}}</h4></v-card-text>
                  <v-card-text ><h4><v-icon>accessibility</v-icon><strong id="backgrounditem">Genero:</strong>&nbsp;&nbsp; {{item.genero}}</h4></v-card-text>
                  <v-card-text ><h4><v-icon>schedule</v-icon><strong id="backgrounditem">Horario:</strong>&nbsp;&nbsp; {{item.horario}}</h4></v-card-text>
                  <v-card-text ><h4><v-icon>recent_actors</v-icon><strong id="backgrounditem">Licencia de Conducir:</strong>&nbsp;&nbsp; {{item.licencia}}</h4></v-card-text>
                  <v-card-text ><h4><v-icon>science</v-icon><strong id="backgrounditem">Experiencia:</strong>&nbsp;&nbsp; {{item.experiencia}}</h4></v-card-text>
                  <v-card-text ><h4><v-icon>cast_for_education</v-icon><strong id="backgrounditem">Conocimientos:</strong>&nbsp;&nbsp; {{item.conocimiento}}</h4></v-card-text>
                </v-card-subtitle>
              </v-card>
               <v-card-subtitle class="mt-1">
                <h3>II.Ofrece</h3>
              </v-card-subtitle>

              <v-card  style="margin:0 auto;width:550px;margin-bottom:16px">
                <v-card-subtitle>
                  <v-card-text ><h4><v-icon>monetization_on</v-icon><strong id="backgrounditem">&nbsp;&nbsp;Salario:$</strong>{{item.salario}}</h4></v-card-text>
                  <v-card-text ><h4><v-icon>self_improvement</v-icon><strong id="backgrounditem"></strong>{{item.ambiente}}</h4></v-card-text>
                  <v-card-text ><h4><v-icon>gavel</v-icon><strong id="backgrounditem"></strong>{{item.prestaciones}}</h4></v-card-text>
                </v-card-subtitle>
              </v-card>

              <v-divider></v-divider>
              <v-card-actions>
                <v-card-text><h5 id="publicado2"><v-icon>date_range</v-icon><strong id="publicadopor">Fecha de Publica:</strong>{{item.updated_at}} </h5></v-card-text >
                  <v-col class="text-right" cols="6" sm="4" >
                  <v-btn @click="dialog = false" color="primary">Atras</v-btn>
                  </v-col>
              </v-card-actions>
            </v-card>
          </v-dialog>
       
      </section>
      </section>
      
</template>

<script>
    export default {
        data() {
            return{
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

    changePage: function(page){
      this.pagination.current_page = page;
      this.fetchOfertas(this.pagination.current_page);
    },

    openmodal(){
      
      this.dialog= true;
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
            console.log(response.data)
          me.arrayAreas = response.data;
          let todas = {nombre:'Todas'};
          me.arrayAreas.push(todas);
          console.log(me.arrayAreas);
          me.loader = false;
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });
      },
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
          
           me.$http.get(`${me.$url}/ofertasr?nombre=`+me.arraybusqueda,header)
          .then(function(response){                        
            me.items = response.data;        
               me.pagination = response.data.pagination;
               if(response.data.pagination == null){
                me.items = response.data;
               }else{                 
                  me.items = response.data.ofertas.data;
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
          me.loader = false;
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });
      },

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
  },

   mounted() {
    this.fetchAreas();
    this.fetchOfertas();
    this.admin = this.$store.state.role;
      if(this.admin == 1 ){
          this.show = true;
          
      }else{
          this.show = false;
          
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
    