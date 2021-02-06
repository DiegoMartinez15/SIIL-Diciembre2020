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

                    <v-card-subtitle style="font-size: 12px;">
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
                  
                  <v-col class="text-center mt-14 " cols="7" :sm="sm" style="display:flex;margin-left:1px">
                    <v-tooltip top>
                    <template v-slot:activator="{on}">
                      <v-btn @click="LoadModal(item.idrequisito)" 
                      id="btncard" 
                      elevation="10" 
                      color="blue darken-1"
                       dark class="mb-2" 
                        v-on="on">
                        Informacion&nbsp;
                        <v-icon>info</v-icon>
                        </v-btn>
                         </template>
                         <span>Mas Informacion</span>
                    </v-tooltip>

                     </v-col>
                     <v-col cols="5" sm="5"  class="mt-6 d-flex" >
                        <v-tooltip top>
                          <template v-slot:activator="{on}">
                            <v-btn
                            v-show="show"
                                class="mr-1"
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

                         &nbsp;&nbsp;
                         
                        <v-tooltip top>
                          <template v-slot:activator="{on}">
                            <v-btn
                            v-show="show"
                              color="light-blue lighten-3"            
                              elevation="8"
                              small
                              dark
                              fab
                              :disabled="item.id < 0"
                              v-on="on"
                              @click="showModalUpd(item)"
                            >
                              <v-icon>create</v-icon>
                            </v-btn>
                          </template>
                        <span>Actualizar Oferta</span>
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
           <v-dialog v-model="dialog" persistent  width="560" >
           
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
                      <div style="margin-left:10px;font-size:22px;">
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
                  <v-card-text v-show="item.edad"><h4><v-icon>verified</v-icon><strong id="backgrounditem">Edad :</strong>&nbsp;&nbsp; {{item.edad}}&nbsp;Años</h4></v-card-text>
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
                  <v-card-text v-show="item.comicion" ><h4><v-icon>account_balance</v-icon><strong id="backgrounditem"></strong>{{item.comicion}}</h4></v-card-text>
                </v-card-subtitle>
              </v-card>
          
               <v-card-text v-show="item.contacto"> <v-alert
               text
                    dense
                    type="info"
                  >
                 Puedes envia tu informacion al &nbsp;&nbsp;{{item.contacto}}
                </v-alert></v-card-text>
                  <v-card-text><h5 id="publicado2"><v-icon>date_range</v-icon><strong id="publicadopor">Fecha de Publicacion:</strong>{{item.updated_at}} </h5></v-card-text >

              <v-divider></v-divider>
              <v-card-actions>
                <v-row class="row " justify="space-around" dense>
                  <v-col class="text-left " cols="6" sm="4" >
                  <!--<v-btn class="mr-2" @click="showModalUpd = false" color="success">Update</v-btn>-->
                  <v-btn text  large @click="dialog = false" color="red accent-3"><v-icon>undo</v-icon>Atras</v-btn>
                  </v-col>

                <v-col class="text-right " cols="6" sm="4" >
                  <!--<v-btn class="mr-2" @click="showModalUpd = false" color="success">Update</v-btn>-->
    
                  <v-btn @click="applyOffer(item.idoferta)" class="mr-2"  color="primary"><v-icon>touch_app</v-icon>Aplicar</v-btn>

                  </v-col>
                </v-row>
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

        <v-dialog
        v-model="modalUpd"
        transition="dialog-bottom-transition"
        max-width="800"
        >

        <template v-slot:default="dialog">
        <v-card>
          <v-toolbar
           color="primary"
           dark
        ><v-icon class="mr-2">update</v-icon><h3>Actualizar Oferta</h3>
        <v-spacer></v-spacer>
         <v-card-actions class="justify-end">
               <v-btn class="mt-1 mb-1"
                color="red darken-3"
                elevation="4"
                fab
                @click="dialog.value = false"
                
              ><v-icon class="mr-1" color="white">close</v-icon></v-btn>
         <!-- <v-btn
             text
            @click="dialog.value = false"
          >Cerrar<v-icon class="mr-1" color="error">close</v-icon></v-btn>-->
         </v-card-actions>
        </v-toolbar>

    <!--** Modal de Actualizacion**-->
    <v-form ref="formofertaUpd" v-model="validForm" :lazy-validation="true" >
        
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
                v-model="ofertas.vacante"
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
                v-model="ofertas.valueid"          
                label="Empresas"
                :rules="[v => !!v || 'Este Campo es requerido']"
                :items="arrayEmpresas"
                :item-text="'nombre'"
                :item-value="'id'"
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
                <input type="file" @change="ObtenerImagen" id="fichero-tarifas" class="input-file" value=""  accept="image/*"/>
                Subir Imagen...
              </div>
            
            <v-col
              cols="12"
              md="4"
            >

            <!--Marco de carga-->
            <div id="imgborder" >
            <v-img v-show="imgshow == true" width="145" height="155" :src="imagen"></v-img>

            <v-img :v-show="imgshow == false" width="145" height="155" :src="'/ImgOfertas/'+ ofertas.img"></v-img>
            </div>
            <!--Fin Marco de carga-->

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
              md="3"
            >
            <v-autocomplete label="Género"
            v-model="requisitosUpd.genero"
            :rules="[v => !!v || 'Este Campo es requerido']"
            :items="generos"
            :item-text="'genero'"
            :item-value="'genero'"></v-autocomplete>
            </v-col>
          
          <v-row justify="space-around">
            <v-col
              cols="12"
              md="8"
              style=" display:flex;margin: 0 10px;"
              
            >
            <v-checkbox
              
              
                v-model="showEdad"
                label="Rango"
                @click="!showEdad"
              ></v-checkbox>
            

          
            <v-text-field
            class="ml-2"
            v-model="MinEdad"
            required
            :rules="[v => !!v || 'Este Campo es requerido']"
            hide-details
            single-line
            min="14"
            label="Edad Minima "
            width="20"
            type="number"
            />
            

            <v-text-field
            class="ml-4"
            :disabled="showEdad == true"
            v-model="MaxEdad"
            
            hide-details
            single-line
            max="50"
            label="Edad Maxima"
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
              <span>Edad mínima para obtener el empleo o rango de edad</span>
          </v-tooltip>
        </v-col>

          </v-row>
         <v-row  justify="space-around">
              <v-col
                cols="12"
                md="4"
              > 
              
              
              <v-autocomplete label="Nivel Académico"
              v-model="requisitosUpd.nivel_academico"
              :rules="[v => !!v || 'Este Campo es requerido']"
              :items="nivel_academico"
              :item-text="'nivel'"
              :item-value="'nivel'"></v-autocomplete>
               
              </v-col>
       

              
              <v-col
                cols="12"
                md="3"
              >
              <v-autocomplete label="Horario"
              :rules="[v => !!v || 'Este Campo es requerido']"
              v-model="requisitosUpd.horario"
              :items="horarios"
              :item-text="'horario'"
              :item-value="'horario'"></v-autocomplete>
              </v-col>

              <v-col
                cols="12"
                md="3"
              >
              <v-autocomplete label="Licencia de conducir"
              v-model="requisitosUpd.licencia"
              :rules="[v => !!v || 'Este Campo es requerido']"
              :items="licencia"
              :item-text="'estado'"
              :item-value="'estado'"></v-autocomplete>
              </v-col>
            
         </v-row>

            <v-col
              cols="12"
              sm="12"
              class="d-flex mb-4"
              
            > <v-row justify="space-around">
           
              <v-checkbox 
              
                v-model="requisitosUpd.ambiente"
                label="Buen Ambiente Laboral"
                value="Buen Ambiente Laboral"
              ></v-checkbox>
              <v-checkbox 
                v-model="requisitosUpd.prestaciones"
                label="Prestaciones de Ley"
                value="Prestaciones de Ley"
              ></v-checkbox>
              <v-checkbox
                v-model="requisitosUpd.comicion"
                label="Comiciones"
                value="Comiciones"
              ></v-checkbox>
             </v-row>
            </v-col>
        
            
            <v-col 
              cols="12"
              style="display:flex;margin: 0 10px;margin-top:-50px"
              md="12"
            >
            
              <v-textarea
              rows="2"
                @keyup="errorsNombre = []"
                :error-messages="errorsNombre"
                v-model="requisitosUpd.conocimiento"
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


             <v-col 
              cols="12"
              style="display:flex;margin: 0 10px;margin-top:-50px"
              md="12"
            >
               

              <v-textarea
              rows="2"
                @keyup="errorsNombre = []"
                :error-messages="errorsNombre"
                v-model="requisitosUpd.experiencia"
                :rules="[v => !!v || 'Este Campo es requerido']"
                label="Experiencia Laboral"
                hint="Digitar requisitos a cumplir de la oferta"
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
              <span>Experiencia requerida</span>
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
                @click="Updofertas()" >Actualizar Oferta</v-btn>
            </v-col>
      <!--**Fin Modal de Actualizacion**-->
      

        
        </v-card>
      </template>
    </v-dialog>     
  </section>
</section>  
</template>

<script>
    export default {
        data() {
            return{
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
                  
                ],
              imgshow: false,
              modalUpd: false,
              findwork:[],
              editedOferta:-1,
              loader:false,
              sm:7,
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
               
               validForm: false,
               errorsNombre:[],
                files: '',
                 imagenmin: '',
               arrayEmpresas: [],
               select:'',
               imagenUpd:'',
               ofertas:{
                  lugar_trabajo:'',
                  vacante: null,
                  cargo: '',
                  img:null,                                                                               
                  valueid: null,
                  idusuario:null,       
                  salario:'',
                  contacto:'',
                  imagen: '',

                  genero:'',
                  edad:'',
                  nivel_academico:'',
                  horarios:'',   
                  licencia:'',  
                  comicion: '',
                  prestacione:'',
                  ambiente:'',           
                  experiencia:'',
                  conocimiento:'',
                
              },
              requisitosUpd:{
                genero:'',
                img:'',
                  edad:'',
                  nivel_academico:'',
                  horarios:'',   
                  licencia:'',  
                  comicion: '',
                  prestacione:'',
                  ambiente:'',           
                  experiencia:'',
                  conocimiento:'',
              },
              data:{
                idoferta: '',
                idaspirante: '',
              },
              pass: false,
              UploadImages: '',
                showEdad: true,
                MaxEdad: '',
                MinEdad: '',
                datamodal: [],
                requisitosUpd1:[],
                prueba: [],
                id: null,
                modal:0,
                modalAdd: false,
                dialog: false,
                accion: "",
                show: false,
                 model: 0,
                 editedAreas:-1,
                colors: [
                { src:'11.png'},
                {src:'accept.jpg'},
                {src:'accept1.jpg',},
                ],
                offset:3,
                
                }
              },
              
  computed:{
    
      imagen(){
        return this.imagenmin;
      },

    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber: function(){
      if(!this.pagination.to){
        return [];
      }
      var from = this.pagination.current_page - 3;
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

    showModalUpd(oferta){
      let me = this;
      me.imgshow = false;
      me.editedAreas = me.items.indexOf(oferta);
      me.ofertas = Object.assign({},oferta);
      
      me.LoadModalUpd(me.ofertas.idrequisito);           
      me.modalUpd = true;      
    },
    //Metodos de aplicar a oferta
    applyOffer(id){
      /*let hoy = new Date();
      var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
      var fecha = hoy.getDate() + '-' + (meses[ hoy.getMonth()] ) + '-' + hoy.getFullYear();
      console.log("Hola Amigos de youtube: " + fecha);
      let array = [];
      array = JSON.stringify(this.$store.state.usuarioLog);
      console.log("Data User Active: "+ array);*/

       let token = sessionStorage.getItem('tokenS');
       let me = this,
       header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };
        me.$swal({
           title: "Deseas Aplicar a esta oferta?",
           text: "itcha see pondra en contacto con tigo por medio de su numero telefonico o correo",
           icon: "info",
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
             me.data.idaspirante = me.$store.state.usuarioLog.id;
             me.data.idoferta = id;
             me.$http.post(`${me.$url}/ApplyOffer`,me.data,header)
             .then(function(response) {
                console.log(response.data);
                console.log(response.data.var);
                let msg = response.data.msg;
                switch (msg) {
                    case "ya haz aplicado":
                       me.$swal({
                        title: "Ya haz aplicado a esta oferta!",
                        text: "¡No se puede aplicar dos veces en una misma oferta!",
                        icon: "info"
                      });
                      break;
                   case "ya haz aplicado a esta oferta y se te dio respuesta":
                       me.$swal({
                        title: "Ya haz aplicado!",
                        text: "¡Ya aplicastes y se dio una respuesta!",
                        icon: "info"
                      });
                      break;
                    case "No se pudo Aplicar a la oferta requerida":
                       me.$swal({
                        title: "Ocurrio Un error!",
                        text: "¡Ocurrio un error intentando aplicar a esta oferta, Vuelve a intentarlo!",
                        icon: "error"
                      });
                      break;
                    case "Se Aplico correctamente":
                       me.$swal({
                        title: "Completado Exitosamente!",
                        text: "¡Aplicastes Correctamente espera que los encargados se pongan en contacto con tigo!",
                        icon: "success"
                      });
                      break;
                  }       
                me.loader = false;
              })
              .catch(function(error) {
                console.log(error);
                me.loader = false;
              });
           }
         });

    },
    //Fin de Metodos para aplicar a la oferta

    //Metodos para cargar los requisitos para actualizar
    LoadModalUpd(id){
      
      let token = sessionStorage.getItem('tokenS');
      let me = this,
       header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };
      me.id=id;
      if(me.id != null){
        me.$http.get(`${me.$url}/requisitosUpd?id=`+me.id,header)
        .then(function(response) {

          me.requisitosUpd1 = response.data;
          if(me.requisitosUpd1.edad.length > 2){
              let edad=me.requisitosUpd1.edad;
              me.MinEdad = edad.substr(0,2);
               me.MaxEdad = edad.substr(5,7);
               me.showEdad = false;
          }else{
            let edad=me.requisitosUpd1.edad;
            me.MinEdad = edad;
          }  

           me.requisitosUpd = Object.assign({},me.requisitosUpd1);
        }).catch(function(error) {
          console.log(error);
        });
      }
    },
    Updofertas(){
      
       let token = sessionStorage.getItem('tokenS');
      
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };
         if (me.$refs.formofertaUpd.validate()) {
            me.loader = true;
            let edad = "";
            if(me.MaxEdad != ""){
               edad = me.MinEdad+" a "+me.MaxEdad;
            }else{
               edad = me.MinEdad;
            }
              me.ofertas["edad"] = edad;
              me.ofertas["genero"] = me.requisitosUpd.genero;
              me.ofertas["nivel_academico"] = me.requisitosUpd.nivel_academico;
              me.ofertas["horario"] = me.requisitosUpd.horario;
              me.ofertas["licencia"] = me.requisitosUpd.licencia;
              me.ofertas["comicion"] = me.requisitosUpd.comicion;
              me.ofertas["prestaciones"] = me.requisitosUpd.prestaciones;
              me.ofertas["ambiente"] = me.requisitosUpd.ambiente;
              me.ofertas["experiencia"] = me.requisitosUpd.experiencia;
              me.ofertas["conocimiento"] = me.requisitosUpd.conocimiento;
            

            if(me.ofertas.img.length == undefined ){
                const sendGetRequest = async () => {
                  try {
                    let token = sessionStorage.getItem('tokenS');
                    let me = this,
                    header = {  
                            headers: {
                                "Authorization": "Bearer "+ token,
                              },
                            };
                    let formData = new FormData();
                    formData.append('img',me.ofertas.img);
                    const resp = await me.$http.post(`${me.$url}/uploadImages`,formData,header);
                    me.ofertas.img = resp.data;
                  } catch (err) {
                      // Handle Error Here
                      console.error(err);
                  }
              };
              sendGetRequest();         
            }else{ 
               console.log(me.ofertas.img);
            }
             setTimeout(() => {
              me.$http.put(`${me.$url}/ofertasUpd/`+me.ofertas.id,me.ofertas,header)
              .then(function(response){
              if(response.status == 200){
              me.verificarAccionDato(response.data, response.status, "Upd"); 
            }
              me.loader = false;
              me.modalUpd = false;
            })
              .catch(function(error){
              me.loader = false;
              console.log(error);
          });  
         
        }, 1200);
      }else{
         const Toast = me.$swal.mixin({
          toast: true,
          position: "bottom-end",
          showConfirmButton: true,
          timer: 3000
        });
        Toast.fire({
                icon: "info",
                title: "Llena los campos para actualizar"
              });

      }
    },
      //Fin Metodo para actualizar
    

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
    //Metodo que muestra todo y pagina
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
          console.log(me.items);
          me.pagination = response.data.pagination;
          if(me.items.length == 0){
            me.mostar = false;
            me.loader = false;
          }
            me.loader = false;
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });
      },

  //Metodos para cargar los requisitos de cada card
    LoadModal(id){
      let token = sessionStorage.getItem('tokenS');
      let me = this,
       header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };
      me.id=id;
      if(me.id != null){
        me.$http.get(`${me.$url}/requisitos?id=`+me.id,header)
        .then(function(response) {
          me.datamodal = response.data;
          console.log(me.datamodal);
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
         let token = sessionStorage.getItem('tokenS');
      let me = this,
       header = {
              headers: {
                "Authorization": "Bearer "+ token,
              },
            };
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
             me.$http.delete(`${me.$url}/ofertas/`+ id,header)
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
          case "Upd":
            if(statusCode == 200){
               Toast.fire({
                icon: "success",
                title: 'La Informacion Se actualizo existosamente',
              });
              this.fetchOfertas();
            }else{
              Toast.fire({
                icon: "error",
                title: "Ocurrido un Error Intente Nuevamente"
              });
            }
        }
      },
  
     ObtenerImagen(e){
          let file = e.target.files[0];
          console.log(file);
          
          console.log(typeof(file));
          if(file != undefined){
            this.ofertas.img = file;
            this.cargarImagen(file)
          }else{
            console.log("No se seleciono imagen");
          }
       
      },

      cargarImagen(file){
       
          this.imgshow = true;
          let reader = new FileReader();
          reader.onload = (e) =>{
            this.imagenmin = e.target.result;
          }
          reader.readAsDataURL(file);
        
          
      }
     

    },
   
  //aqui esta el mounted si no lo conocce le explico este pedaso de codigo es importante por que aqui se
  //cargaran los metodos que cuando entre a este apartado se cargaran dinamicamente y otras validacones de admin
   mounted() {
      
    this.fetchAreas();
    this.fetchEmpresa();
    this.fetchOfertas();
    this.fetchfindwork();
    this.admin = this.$store.state.role;
      if(this.admin != 2 ){
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
  padding-bottom: 3px;
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
  width: 97%;
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
   margin-left: 4px;
   
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
    