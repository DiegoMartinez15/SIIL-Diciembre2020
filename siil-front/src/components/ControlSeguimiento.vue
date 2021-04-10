 <template>

<div class="content">
  <v-divider></v-divider>
  <!--FORMULARIO NUMERO 1-->
   <v-expansion-panels>
    <v-expansion-panel>
      <v-expansion-panel-header>
       Listado de Egresados con Seguimiento #1 Completado
      </v-expansion-panel-header>
      <v-expansion-panel-content>
      <div class="md-layout-item md-medium-size-100 md-xsmall-sixe-100 md-size-100">
    
          <v-overlay :value="loader" :z-index="'99999999'">
              <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
          </v-overlay>
          <v-card>
            <v-card-title>
              Lista de Egresados con Seguimiento #1 Completado
             <div class="flex-grow-1"></div>
                <v-text-field
                  v-model="searchEgresado1"
                  append-icon="search"
                  label="Buscar egresado"
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
              multi-sort
              :search="searchEgresado1"
              class="elevation-3 text--center ml-80 pl-10 pr-10"
             
            >
            <!-- Templeate para form modal para agregar o actualizar categorias-->
          <template v-slot:top>
            <v-toolbar flat color="white">
              
              <div class="flex-grow-1"></div>
              <v-dialog v-model="modalF1" persistent max-width="auto">
                <v-card>
                  <v-card-title class="headline light-blue lighten-5" primary-titles>
                    <span class="headline">Detalles de Seguimiento a Graduado</span>
                  </v-card-title>
                  <v-card-text>
                    <v-container>
                      <v-form >
                        <v-row>
                          <v-col cols="12" md="2">
                            <v-text-field
                              
                              label="Nombres"
                              v-model="formulario.nombre"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" md="2">
                            <v-text-field
                             
                              label="Apellidos"
                              v-model="formulario.apellido"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" md="2">
                            <v-text-field
                             
                              label="Correo Electronico"
                              v-model="formulario.correo"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" md="2" v-show="formulario.celular2 != null">
                            <v-text-field
                             
                              label="Teléfono Celular"
                              v-model="formulario.celular2"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" md="2" v-show="formulario.celular2 === null">
                            <v-text-field
                             
                              label="Teléfono Celular"
                              v-model="formulario.telefono"
                            ></v-text-field>
                          </v-col>
                           <v-col cols="6" md="4">
                            <v-text-field
                              v-model="formulario.continua_estudiando"
                              label="Continua estudiando"
                            ></v-text-field>
                          </v-col>
                          <v-col>
                            <v-text-field
                              v-model="formulario.empleado"
                              label="Empleado"
                            ></v-text-field>
                          </v-col>
                           <v-col cols="6" md="4">
                            <v-text-field
                              v-model="formulario.empleado_area_trabajo"
                              label="Empleado en su area de estudio"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="6" md="4">
                            <v-text-field
                              v-model="formulario.interes_colocado"
                              label="Le interesa ser colocado"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="6" md="4">
                            <v-text-field 
                              v-model="formulario.tipo_empleo"
                              label="Tipo de empleo"
                            ></v-text-field>
                          </v-col>
                           <v-col cols="6" md="4">
                            <v-text-field
                              v-model="formulario.nombre_empresa"
                              label="Nombre de la Empresa"
                            ></v-text-field>
                          </v-col>
                           <v-col cols="6" md="4">
                            <v-text-field
                              v-model="formulario.contacto_empresa"                     
                              label="Nombre de contacto de la Empresa"
                            ></v-text-field>
                          </v-col>
                            <v-col cols="6" md="4">
                            <v-text-field
                              v-model="formulario.cargo_desempenia"
                              label="Cargo que desempeña"
                            ></v-text-field>
                          </v-col>
                           <v-col cols="6" md="4">
                            <v-text-field
                              v-model="formulario.tel_empresa"
                              label="Telefono de la Empresa"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="6" md="2">
                            <v-text-field
                              v-model="formulario.estatus"
                              label="Estatus"
                            ></v-text-field>
                          </v-col>
                          <v-col cols="6" md="2">
                            <v-text-field
                              v-model="formulario.fecha_monitoreo"
                              label="Fecha de Monitoreo"
                            ></v-text-field>
                          </v-col>
                        </v-row>
                        </v-form>
                    </v-container>
                  </v-card-text>
                  <v-divider></v-divider>           
                    <v-card-actions>
                      <div class="flex-grow-1"></div>
                      <v-btn color="red darken-1" text @click="cerrarModal">Cerrar</v-btn>
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
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
  <!--FORMULARIO NUMERO 2-->
  <v-divider></v-divider>
 <v-expansion-panels>
    <v-expansion-panel>
      <v-expansion-panel-header>
        Listado de Egresados con Seguimiento #2 Completado
      </v-expansion-panel-header>
      <v-expansion-panel-content>
            <div class="md-layout-item md-medium-size-100 md-xsmall-sixe-100 md-size-100">
    
            <v-overlay :value="loader" :z-index="'99999999'">
                <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
            </v-overlay>
            <v-card>
              <v-card-title>
                Lista de Egresados con Seguimiento #2 Completado
               <div class="flex-grow-1"></div>
                  <v-text-field
                    v-model="searchEgresado2"
                    append-icon="search"
                    label="Buscar egresado"
                    single-line
                    hide-details
                  ></v-text-field>
              </v-card-title>
              <v-data-table
                :headers="hTBEgresado"
                :items="arrayEgresado2"
                :footer-props="{
                  'items-per-page-options' :[5,10,15,30],
                  'items-per-page-text' :'Registros por Página'
                }"
                :items-per-page="10"
                multi-sort
                :search="searchEgresado2"
                class="elevation-3 text--center ml-80 pl-10 pr-10"
              >
              <!-- Templeate para form modal para agregar o actualizar categorias-->
            <template v-slot:top>
              <v-toolbar flat color="white">
                
                <div class="flex-grow-1"></div>
                <v-dialog v-model="modalF2" persistent max-width="700px">
                  <v-card>
                    <v-card-title class="headline light-blue lighten-5" primary-titles>
                      <span class="headline">Detalles de Seguimiento a Graduado</span>
                    </v-card-title>
                    <v-card-text>
                      <v-container>
                        <v-form ref="formSeguimiento" v-model="validForm" :lazy-validation="true">
                          <v-row>
                            <v-col cols="12" md="2">
                              <v-text-field
                                
                                label="Nombres"
                                v-model="formulario.nombre"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2">
                              <v-text-field
                               
                                label="Apellidos"
                                v-model="formulario.apellido"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2">
                              <v-text-field
                               
                                label="Correo Electronico"
                                v-model="formulario.correo"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2" v-show="formulario.celular2 != null">
                              <v-text-field
                               
                                label="Teléfono Celular"
                                v-model="formulario.celular2"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2" v-show="formulario.celular2 === null">
                              <v-text-field
                               
                                label="Teléfono Celular"
                                v-model="formulario.telefono"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.continua_estudiando"
                                label="Continua estudiando"
                              ></v-text-field>
                            </v-col>
                            <v-col>
                              <v-text-field
                                v-model="formulario.empleado"
                                label="Empleado"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.empleado_area_trabajo"
                                label="Empleado en su area de estudio"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.interes_colocado"
                                label="Le interesa ser colocado"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6" md="4">
                              <v-text-field 
                                v-model="formulario.tipo_empleo"
                                label="Tipo de empleo"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.nombre_empresa"
                                label="Nombre de la Empresa"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.contacto_empresa"                     
                                label="Nombre de contacto de la Empresa"
                              ></v-text-field>
                            </v-col>
                              <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.cargo_desempenia"
                                label="Cargo que desempeña"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.tel_empresa"
                                label="Telefono de la Empresa"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6" md="2">
                              <v-text-field
                                v-model="formulario.estatus"
                                label="Estatus"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6" md="2">
                              <v-text-field
                                v-model="formulario.fecha_monitoreo"
                                label="Fecha de Monitoreo"
                              ></v-text-field>
                            </v-col>
                          </v-row>
                          </v-form>
                      </v-container>
                    </v-card-text>
                    <v-divider></v-divider>           
                      <v-card-actions>
                        <div class="flex-grow-1"></div>
                        <v-btn color="red darken-1" text @click="cerrarModal">Cerrar</v-btn>
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
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
  <v-divider></v-divider>
  <!--FORMULARIO NUMERO 3-->
  <v-expansion-panels>
    <v-expansion-panel>
      <v-expansion-panel-header>
        Listado de Egresados con Seguimiento #3 Completado
      </v-expansion-panel-header>
      <v-expansion-panel-content>
         <div class="md-layout-item md-medium-size-100 md-xsmall-sixe-100 md-size-100">
            
            <v-overlay :value="loader" :z-index="'99999999'">
                <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
            </v-overlay>
            <v-card>
              <v-card-title>
                Lista de Egresados con Seguimiento #3 Completado
               <div class="flex-grow-1"></div>
                  <v-text-field
                    v-model="searchEgresado3"
                    append-icon="search"
                    label="Buscar egresado"
                    single-line
                    hide-details
                  ></v-text-field>
              </v-card-title>
              <v-data-table
                :headers="hTBEgresado"
                :items="arrayEgresado3"
                :footer-props="{
                  'items-per-page-options' :[5,10,15,30],
                  'items-per-page-text' :'Registros por Página'
                }"
                :items-per-page="10"
                multi-sort
                :search="searchEgresado3"
                class="elevation-3 text--center ml-80 pl-10 pr-10"
              >
              <!-- Templeate para form modal para agregar o actualizar categorias-->
            <template v-slot:top>
              <v-toolbar flat color="white">
                
                <div class="flex-grow-1"></div>
                <v-dialog v-model="modalF3" persistent max-width="700px">
                  <v-card>
                    <v-card-title class="headline light-blue lighten-5" primary-titles>
                      <span class="headline">Detalles de Seguimiento a Graduado</span>
                    </v-card-title>
                    <v-card-text>
                      <v-container>
                       <v-form ref="formSeguimiento" v-model="validForm" :lazy-validation="true">
                          <v-row>
                            <v-col cols="12" md="2">
                              <v-text-field
                                
                                label="Nombres"
                                v-model="formulario.nombre"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2">
                              <v-text-field
                               
                                label="Apellidos"
                                v-model="formulario.apellido"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2">
                              <v-text-field
                               
                                label="Correo Electronico"
                                v-model="formulario.correo"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2" v-show="formulario.celular2 != null">
                              <v-text-field
                               
                                label="Teléfono Celular"
                                v-model="formulario.celular2"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2" v-show="formulario.celular2 === null">
                              <v-text-field
                               
                                label="Teléfono Celular"
                                v-model="formulario.telefono"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.continua_estudiando"
                                label="Continua estudiando"
                              ></v-text-field>
                            </v-col>
                            <v-col>
                              <v-text-field
                                v-model="formulario.empleado"
                                label="Empleado"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.empleado_area_trabajo"
                                label="Empleado en su area de estudio"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.interes_colocado"
                                label="Le interesa ser colocado"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6" md="4">
                              <v-text-field 
                                v-model="formulario.tipo_empleo"
                                label="Tipo de empleo"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.nombre_empresa"
                                label="Nombre de la Empresa"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.contacto_empresa"                     
                                label="Nombre de contacto de la Empresa"
                              ></v-text-field>
                            </v-col>
                              <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.cargo_desempenia"
                                label="Cargo que desempeña"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.tel_empresa"
                                label="Telefono de la Empresa"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6" md="2">
                              <v-text-field
                                v-model="formulario.estatus"
                                label="Estatus"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6" md="2">
                              <v-text-field
                                v-model="formulario.fecha_monitoreo"
                                label="Fecha de Monitoreo"
                              ></v-text-field>
                            </v-col>
                          </v-row>
                          </v-form>
                      </v-container>
                    </v-card-text>
                    <v-divider></v-divider>           
                      <v-card-actions>
                        <div class="flex-grow-1"></div>
                        <v-btn color="red darken-1" text @click="cerrarModal">Cerrar</v-btn>
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
      </v-expansion-panel-content>
    </v-expansion-panel> 
  </v-expansion-panels>
  <v-divider></v-divider>
 <!--FORMULARIO NUMERO 4-->
  <v-expansion-panels>
    <v-expansion-panel>
      <v-expansion-panel-header>
        Listado de Egresados con Seguimiento #4 Completado
      </v-expansion-panel-header>
      <v-expansion-panel-content>
         <div class="md-layout-item md-medium-size-100 md-xsmall-sixe-100 md-size-100">
    
            <v-overlay :value="loader" :z-index="'99999999'">
                <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
            </v-overlay>
            <v-card>
              <v-card-title>
                Lista de Egresados con Seguimiento #4 Completado
               <div class="flex-grow-1"></div>
                  <v-text-field
                    v-model="searchEgresado4"
                    append-icon="search"
                    label="Buscar egresado"
                    single-line
                    hide-details
                  ></v-text-field>
              </v-card-title>
              <v-data-table
                :headers="hTBEgresado"
                :items="arrayEgresado4"
                :footer-props="{
                  'items-per-page-options' :[5,10,15,30],
                  'items-per-page-text' :'Registros por Página'
                }"
               :items-per-page="10"
                multi-sort
                :search="searchEgresado4"
                class="elevation-3 text--center ml-80 pl-10 pr-10"
              >
              <!-- Templeate para form modal para agregar o actualizar categorias-->
            <template v-slot:top>
              <v-toolbar flat color="white">
                
                <div class="flex-grow-1"></div>
                <v-dialog v-model="modalF3" persistent max-width="700px">
                  <v-card>
                    <v-card-title class="headline light-blue lighten-5" primary-titles>
                      <span class="headline">Detalles de Seguimiento a Graduado</span>
                    </v-card-title>
                    <v-card-text>
                      <v-container>
                       <v-form ref="formSeguimiento" v-model="validForm" :lazy-validation="true">
                          <v-row>
                            <v-col cols="12" md="2">
                              <v-text-field
                                disabled
                                label="Nombres"
                                v-model="formulario.nombre"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2">
                              <v-text-field
                               
                                label="Apellidos"
                                v-model="formulario.apellido"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2">
                              <v-text-field
                               
                                label="Correo Electronico"
                                v-model="formulario.correo"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2" v-show="formulario.celular2 != null">
                              <v-text-field
                               
                                label="Teléfono Celular"
                                v-model="formulario.celular2"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" md="2" v-show="formulario.celular2 === null">
                              <v-text-field
                               
                                label="Teléfono Celular"
                                v-model="formulario.telefono"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.continua_estudiando"
                                label="Continua estudiando"
                              ></v-text-field>
                            </v-col>
                            <v-col>
                              <v-text-field
                                v-model="formulario.empleado"
                                label="Empleado"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.empleado_area_trabajo"
                                label="Empleado en su area de estudio"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.interes_colocado"
                                label="Le interesa ser colocado"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6" md="4">
                              <v-text-field 
                                v-model="formulario.tipo_empleo"
                                label="Tipo de empleo"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.nombre_empresa"
                                label="Nombre de la Empresa"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.contacto_empresa"                     
                                label="Nombre de contacto de la Empresa"
                              ></v-text-field>
                            </v-col>
                              <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.cargo_desempenia"
                                label="Cargo que desempeña"
                              ></v-text-field>
                            </v-col>
                             <v-col cols="6" md="4">
                              <v-text-field
                                v-model="formulario.tel_empresa"
                                label="Telefono de la Empresa"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6" md="2">
                              <v-text-field
                                v-model="formulario.estatus"
                                label="Estatus"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="6" md="2">
                              <v-text-field
                                v-model="formulario.fecha_monitoreo"
                                label="Fecha de Monitoreo"
                              ></v-text-field>
                            </v-col>
                          </v-row>
                          </v-form>
                      </v-container>
                    </v-card-text>
                    <v-divider></v-divider>           
                      <v-card-actions>
                        <div class="flex-grow-1"></div>
                        <v-btn color="red darken-1" text @click="cerrarModal">Cerrar</v-btn>
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
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
  <v-divider></v-divider>
</div>
</template>
<script>
  export default {
    data () {
      return {
        arrayEgresado:[],
        arrayEgresado2:[],
        arrayEgresado3:[],
        arrayEgresado4:[],
        hTBEgresado:[
          {text:"Nombres", value:'nombre',class:'blue-grey lighten-4'},
          {text:"Apellidos", value:'apellido',class:'blue-grey lighten-4'},
          {text:"Carrera", value:'carrera', class:'blue-grey lighten-4 '},
          {text:"Correo", value:'correo', class:'blue-grey lighten-4 '},
          {text:"Accion", value:"action",sortable:false,aling:"center",class:'blue-grey lighten-4'},
        ],
        loader:false,
        modalF1:false,
        modalF2:false,
        modalF3:false,
        modalF4:false,
        formulario:{
         
        },
        searchEgresado1:"",
        searchEgresado2:"",
        searchEgresado3:"",
        searchEgresado4:"",
        validForm:true,
        editedF:-1,
      };
    },
    computed: {
    
    },
    methods: {
    FetchData(){
    let me = this;
    me.fetchEgresado();
    me.fetchEgresado2();
    me.fetchEgresado3();
    me.fetchEgresado4();	
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
        me.$http.get(`${me.$url}/seguimiento1`,header)
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
      fetchEgresado2() {  
        let token = sessionStorage.getItem('tokenS');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };
               
        me.loader = true;
        me.$http.get(`${me.$url}/seguimiento2`,header)
        .then(function(response){
            console.log(response.data)
          me.arrayEgresado2 = response.data;
          me.loader = false;
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });
      },
      fetchEgresado3() {  
        let token = sessionStorage.getItem('tokenS');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };
               
        me.loader = true;
        me.$http.get(`${me.$url}/seguimiento3`,header)
        .then(function(response){
            console.log(response.data)
          me.arrayEgresado3 = response.data;
          me.loader = false;
        })
        .catch(function(error){
          me.loader = false;
          console.log(error);
        });
      },
      fetchEgresado4() {  
        let token = sessionStorage.getItem('tokenS');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };
               
        me.loader = true;
        me.$http.get(`${me.$url}/seguimiento4`,header)
        .then(function(response){
            console.log(response.data)
          me.arrayEgresado4 = response.data;
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
        me.modalF2 = false;
        me.modalF3 = false;
        me.modalF4 = false;
      },

      showModal(formulario) {
        let me = this;
        me.editedF = me.arrayEgresado.indexOf(formulario);
        me.formulario = Object.assign({},formulario);
        me.modalF1 = true;
      },
      showModal2(formulario) {
        let me = this;
        me.editedF = me.arrayEgresado2.indexOf(formulario);
        me.formulario = Object.assign({},formulario);
        me.modalF2 = true;
      },
      showModal3(formulario) {
        let me = this;
        me.editedF = me.arrayEgresado3.indexOf(formulario);
        me.formulario = Object.assign({},formulario);
        me.modalF3 = true;
      },
      showModal4(formulario) {
        let me = this;
        me.editedF = me.arrayEgresado4.indexOf(formulario);
        me.formulario = Object.assign({},formulario);
        me.modalF4 = true;
      },
    },
    mounted() {
       let me = this;
       me.FetchData();
      let x = sessionStorage.getItem('tokenS');
      if(x != null){
        me.FetchData();
      }else{
         
         this.$router.push('/login')
      }
       
    },
  };
</script>