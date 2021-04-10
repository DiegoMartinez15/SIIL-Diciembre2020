<template>
  <div class="content">
    <v-expansion-panels>
    <v-expansion-panel >
      <v-expansion-panel-header>
        Opciones de Seguimiento a Graduado
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        <template>
           <v-btn elevation="10" color="red darken-1" rounded dark class="mb-5" style="align: center" @click="ResetSeguimiento()">
              Reinicio de Seguimientos
              <v-icon style="margin-left: 5px">restart_alt</v-icon>
            </v-btn>
      </template>   
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>

  <!--FORMULARIO SEGUIMIENTO #1-->   
  <v-expansion-panels>
    <v-expansion-panel >
      <v-expansion-panel-header>
        Seguimiento a Graduado 1 Trimestre
      </v-expansion-panel-header>
      <v-expansion-panel-content>
     <template>
    <div class="md-layout-item md-medium-size-400 md-xsmall-sixe-400 md-size-400">
      
      <v-overlay :value="loader" :z-index="'99999999'">
          <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
      </v-overlay>
      <v-card>
        <v-card-title>
          Listado de Egresados
         <div class="flex-grow-1"></div>
          <v-text-field
            v-model="searchEgresado"
            append-icon="search"
            label="Buscar egresado o Carrera en especifico"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
      
        <v-data-table
          
          :headers="hTBegresado"
          :items="arrayEgresado"
          :footer-props="{
            'items-per-page-options' :[5,10,15,20,30],
            'items-per-page-text' :'Registros por Página'
          }"
          :items-per-page="5"
          :search="searchEgresado"
          multi-sort
          class="elevation-3 text--center ml-80 pl-10 pr-10"
        >
        <!-- Templeate para form modal para agregar o actualizar categorias-->
      <template v-slot:top>
        <v-toolbar flat color="white">
          <div class="flex-grow-1"></div>
          <v-dialog v-model="modalSeguimiento1" persistent max-width="1080px">
            <v-card>
              <v-card-title class="headline light-blue lighten-5" primary-titles>
                <span class="headline">Seguimiento a Graduados</span>
              </v-card-title>
              <v-card-text>
                <v-container>
                 <v-form ref="formSeguimiento" v-model="validForm" :lazy-validation="true">
                  <v-row>
                    <v-col cols="12" md="2">
                      <v-text-field
                      label="Nombres"
                        disabled
                        v-model="viewform.nombre"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2">
                      <v-text-field
                      label="Apellidos"
                       disabled
                        v-model="viewform.apellido"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2">
                      <v-text-field
                      label="Correo electrónico"
                       disabled
                        v-model="viewform.correo"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2" v-show="viewform.celular2 != null">
                      <v-text-field
                       disabled
                        v-model="viewform.celular2"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2" v-show="viewform.celular2 === null">
                      <v-text-field
                       disabled
                        v-model="viewform.telefono"
                      ></v-text-field>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-select
                        v-model="formulario.continua_estudiando"
                        @keyup="errorsNombre = []"
                        :rules="[v => !!v || 'Campo requerido']"
                        label="Continua estudiando"
                        required
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                    <v-col>
                      <v-select
                        v-model="formulario.empleado"
                        @keyup="errorsNombre = []"
                        :rules="[v => !!v || 'Campo requerido']"
                        label="Empleado"
                        required
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-select
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.empleado_area_trabajo"
                        @keyup="errorsNombre = []"
                        :rules="[v => !!v || 'Campo requerido']"
                        label="Empleado en su area de estudio"
                        required
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                    <v-col cols="6" md="4">
                      <v-select
                        v-model="formulario.interes_colocado"
                        @keyup="errorsNombre = []"
                        :rules="[v => !!v || 'Campo requerido']"
                        label="Le interesa ser colocado"
                        required
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                    <v-col cols="6" md="4">
                      <v-select 
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.tipo_empleo"
                        @keyup="errorsNombre = []"
                        label="Tipo de empleo"
                        :error-messages="errorsNombre"
                        :items="empleo"
                      ></v-select>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.nombre_empresa"
                        @keyup="errorsNombre = []"
                        label="Nombre de la Empresa"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.contacto_empresa"
                        @keyup="errorsNombre = []"
                        label="Nombre de contacto de la Empresa"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                      <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.cargo_desempenia"
                        @keyup="errorsNombre = []"
                        label="Cargo que desempeña"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.tel_empresa"
                        @keyup="errorsNombre = []"
                        label="Telefono de la Empresa"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="6" md="4">
                      <v-text-field
                        v-model="formulario.estatus"
                        @keyup="errorsNombre = []"
                        label="Estatus"
                        :error-messages="errorsNombre"
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
                  <v-btn
                    color="info darken-1"
                    :disabled="!validForm"
                    @click="saveForm()"
                    text
                  >Enviar Informacion
                </v-btn>
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
                color="indigo"            
                elevation="8"
                small
                fab
                dark
                v-on="on"
                @click="showModalFormulario(item)"
              >
              <v-icon>switch_account</v-icon>
              </v-btn>
            </template>
            <span>Seguimiento a Graduado</span>
          </v-tooltip>
        </template>
        <v-snackbar v-model="snackbar">
            {{ msjSnackBar}}
            <v-btn color="red" text @click="snackbar = false">Cerrar</v-btn>
        </v-snackbar>
        </v-data-table>
      </v-card>
    </div>
    </template> 
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
    <div class="flex-grow-1"></div>
  <!--FORMULARIO SEGUIMIENTO #2-->   
  <v-expansion-panels>
    <v-expansion-panel >
      <v-expansion-panel-header>
        Seguimiento a Graduado 2 Trimestre
      </v-expansion-panel-header>
      <v-expansion-panel-content>

     <div class="md-layout-item md-medium-size-100 md-xsmall-sixe-100 md-size-100">
      
      <v-overlay :value="loader" :z-index="'99999999'">
          <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
      </v-overlay>
      <v-card>
        <v-card-title>
          Listado de Egresados. Seguimiento #2
         <div class="flex-grow-1"></div>
          <v-text-field
            v-model="searchEgresado"
            append-icon="search"
            label="Buscar egresado"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
      
        <v-data-table
          
          :headers="hTBegresado"
          :items="arrayEgresado2"
          :footer-props="{
            'items-per-page-options' :[5,10,15,20,30],
            'items-per-page-text' :'Registros por Página'
          }"
          :items-per-page="5"
          :search="searchEgresado"
          multi-sort
          class="elevation-3 text--center ml-80 pl-10 pr-10"
        >
        <!-- Templeate para form modal para agregar o actualizar categorias-->
      <template v-slot:top>
        <v-toolbar flat color="white">
          <div class="flex-grow-1"></div>
          <v-dialog v-model="modalSeguimiento2" persistent max-width="1080px">
            <v-card>
              <v-card-title class="headline light-blue lighten-5" primary-titles>
                <span class="headline">Seguimiento a Graduados</span>
              </v-card-title>
              <v-card-text>
                <v-container>
                 <v-form ref="formSeguimiento" v-model="validForm" :lazy-validation="true">
                  <v-row>
                    <v-col cols="12" md="2">
                      <v-text-field
                        disabled
                        label="Nombres"
                        v-model="viewform.nombre"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2">
                      <v-text-field
                       disabled
                       label="Apellidos"
                        v-model="viewform.apellido"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2">
                      <v-text-field
                       disabled
                       label="Correo electrónico"
                        v-model="viewform.correo"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2" v-show="viewform.celular2 != null">
                      <v-text-field
                       disabled
                        v-model="viewform.celular2"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2" v-show="viewform.celular2 === null">
                      <v-text-field
                       disabled
                        v-model="viewform.telefono"
                      ></v-text-field>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-select
                        v-model="formulario.continua_estudiando"
                        @keyup="errorsNombre = []"
                        :rules="[v => !!v || 'Campo requerido']"
                        label="Continua estudiando"
                        required
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                    <v-col>
                      <v-select
                        v-model="formulario.empleado"
                        @keyup="errorsNombre = []"
                        :rules="[v => !!v || 'Campo requerido']"
                        label="Empleado"
                        required
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-select
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.empleado_area_trabajo"
                        @keyup="errorsNombre = []"
                        label="Empleado en su area de estudio"
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                    <v-col cols="6" md="4">
                      <v-select
                        v-model="formulario.interes_colocado"
                        @keyup="errorsNombre = []"
                        :rules="[v => !!v || 'Campo requerido']"
                        label="Le interesa ser colocado"
                        required
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                    <v-col cols="6" md="4">
                      <v-select 
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.tipo_empleo"
                        @keyup="errorsNombre = []"
                        label="Tipo de empleo"
                        :error-messages="errorsNombre"
                        :items="empleo"
                      ></v-select>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.nombre_empresa"
                        @keyup="errorsNombre = []"
                        label="Nombre de la Empresa"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.contacto_empresa"
                        @keyup="errorsNombre = []"
                        label="Nombre de contacto de la Empresa"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                      <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.cargo_desempenia"
                        @keyup="errorsNombre = []"
                        label="Cargo que desempeña"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.tel_empresa"
                        @keyup="errorsNombre = []"
                        label="Telefono de la Empresa"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="6" md="4">
                      <v-text-field
                        v-model="formulario.estatus"
                        @keyup="errorsNombre = []"
                        label="Estatus"
                        :error-messages="errorsNombre"
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
                  <v-btn
                    color="info darken-1"
                    :disabled="!validForm"
                    @click="saveForm2()"
                    text
                  >Enviar Informacion
                </v-btn>
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
                color="indigo"            
                elevation="8"
                small
                fab
                dark
                v-on="on"
                @click="showModalFormulario2(item)"
              >
              <v-icon>switch_account</v-icon>
              </v-btn>
            </template>
            <span>Seguimiento a Graduado</span>
          </v-tooltip>
        </template>
        <v-snackbar v-model="snackbar">
            {{ msjSnackBar}}
            <v-btn color="red" text @click="snackbar = false">Cerrar</v-btn>
        </v-snackbar>
        </v-data-table>
      </v-card>
    </div>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
    <div class="flex-grow-1"></div>
    <!--FORMULARIO SEGUIMIENTO #3-->
  <v-expansion-panels>
    <v-expansion-panel >
      <v-expansion-panel-header>
        Seguimiento a Graduado 3 Trimestre
      </v-expansion-panel-header>
      <v-expansion-panel-content>
            
     <div class="md-layout-item md-medium-size-100 md-xsmall-sixe-100 md-size-100">
      
      <v-overlay :value="loader" :z-index="'99999999'">
          <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
      </v-overlay>
      <v-card>
        <v-card-title>
          Listado de Egresados. Seguimiento #3
         <div class="flex-grow-1"></div>
          <v-text-field
            v-model="searchEgresado"
            append-icon="search"
            label="Buscar egresado"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
      
        <v-data-table
          
          :headers="hTBegresado"
          :items="arrayEgresado3"
          :footer-props="{
            'items-per-page-options' :[5,10,15,20,30],
            'items-per-page-text' :'Registros por Página'
          }"
          :items-per-page="5"
          :search="searchEgresado"
          multi-sort
          class="elevation-3 text--center ml-80 pl-10 pr-10"
        >
        <!-- Templeate para form modal para agregar o actualizar categorias-->
      <template v-slot:top>
        <v-toolbar flat color="white">
          <div class="flex-grow-1"></div>
          <v-dialog v-model="modalSeguimiento3" persistent max-width="1080px">
            <v-card>
              <v-card-title class="headline light-blue lighten-5" primary-titles>
                <span class="headline">Seguimiento a Graduados</span>
              </v-card-title>
              <v-card-text>
                <v-container>
                 <v-form ref="formSeguimiento" v-model="validForm" :lazy-validation="true">
                  <v-row>
                    <v-col cols="12" md="2">
                      <v-text-field
                        disabled
                        label="Nombres"
                        v-model="viewform.nombre"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2">
                      <v-text-field
                      label="Apellidos"
                       disabled
                        v-model="viewform.apellido"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2">
                      <v-text-field
                      label="Correo electrónico"
                       disabled
                        v-model="viewform.correo"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2" v-show="viewform.celular2 != null">
                      <v-text-field
                       disabled
                        v-model="viewform.celular2"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2" v-show="viewform.celular2 === null">
                      <v-text-field
                       disabled
                        v-model="viewform.telefono"
                      ></v-text-field>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-select
                        v-model="formulario.continua_estudiando"
                        @keyup="errorsNombre = []"
                        :rules="[v => !!v || 'Campo requerido']"
                        label="Continua estudiando"
                        required
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                    <v-col>
                      <v-select
                        v-model="formulario.empleado"
                        @keyup="errorsNombre = []"
                        :rules="[v => !!v || 'Campo requerido']"
                        label="Empleado"
                        required
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-select
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.empleado_area_trabajo"
                        @keyup="errorsNombre = []"
                        label="Empleado en su area de estudio"
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                    <v-col cols="6" md="4">
                      <v-select
                        v-model="formulario.interes_colocado"
                        @keyup="errorsNombre = []"
                        :rules="[v => !!v || 'Campo requerido']"
                        label="Le interesa ser colocado"
                        required
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                    <v-col cols="6" md="4">
                      <v-select 
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.tipo_empleo"
                        @keyup="errorsNombre = []"
                        label="Tipo de empleo"
                        :error-messages="errorsNombre"
                        :items="empleo"
                      ></v-select>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.nombre_empresa"
                        @keyup="errorsNombre = []"
                        label="Nombre de la Empresa"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.contacto_empresa"
                        @keyup="errorsNombre = []"
                        label="Nombre de contacto de la Empresa"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                      <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.cargo_desempenia"
                        @keyup="errorsNombre = []"
                        label="Cargo que desempeña"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.tel_empresa"
                        @keyup="errorsNombre = []"
                        label="Telefono de la Empresa"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="6" md="4">
                      <v-text-field
                        v-model="formulario.estatus"
                        @keyup="errorsNombre = []"
                        label="Estatus"
                        :error-messages="errorsNombre"
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
                  <v-btn
                    color="info darken-1"
                    :disabled="!validForm"
                    @click="saveForm3()"
                    text
                  >Enviar Informacion
                </v-btn>
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
                color="indigo"            
                elevation="8"
                small
                fab
                dark
                v-on="on"
                @click="showModalFormulario3(item)"
              >
              <v-icon>switch_account</v-icon>
              </v-btn>
            </template>
            <span>Seguimiento a Graduado</span>
          </v-tooltip>
        </template>
        <v-snackbar v-model="snackbar">
            {{ msjSnackBar}}
            <v-btn color="red" text @click="snackbar = false">Cerrar</v-btn>
        </v-snackbar>
        </v-data-table>
      </v-card>
    </div>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
    <div class="flex-grow-1"></div>
     <!--FORMULARIO SEGUIMIENTO #4-->
  <v-expansion-panels>
    <v-expansion-panel >
      <v-expansion-panel-header>
        Seguimiento a Graduado 4 Trimestre
      </v-expansion-panel-header>
      <v-expansion-panel-content>
          
     <div class="md-layout-item md-medium-size-100 md-xsmall-sixe-100 md-size-100">
      
      <v-overlay :value="loader" :z-index="'99999999'">
          <v-progress-circular indeterminate size="80" color="grey darken-4"></v-progress-circular>
      </v-overlay>
      <v-card>
        <v-card-title>
          Listado de Egresados. Seguimiento #4
         <div class="flex-grow-1"></div>
          <v-text-field
            v-model="searchEgresado"
            append-icon="search"
            label="Buscar egresado"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
      
        <v-data-table
          
          :headers="hTBegresado"
          :items="arrayEgresado4"
          :footer-props="{
            'items-per-page-options' :[5,10,15,20,30],
            'items-per-page-text' :'Registros por Página'
          }"
          :items-per-page="5"
          :search="searchEgresado"
          multi-sort
          class="elevation-3 text--center ml-80 pl-10 pr-10"
        >
        <!-- Templeate para form modal para agregar o actualizar categorias-->
      <template v-slot:top>
        <v-toolbar flat color="white">
          <div class="flex-grow-1"></div>
          <v-dialog v-model="modalSeguimiento4" persistent max-width="1080px">
            <v-card>
              <v-card-title class="headline light-blue lighten-5" primary-titles>
                <span class="headline">Seguimiento a Graduados</span>
              </v-card-title>
              <v-card-text>
                <v-container>
                 <v-form ref="formSeguimiento" v-model="validForm" :lazy-validation="true">
                  <v-row>
                    <v-col cols="12" md="2">
                      <v-text-field
                        disabled
                        label="Nombres"
                        v-model="viewform.nombre"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2">
                      <v-text-field
                       disabled
                       label="Apellidos"
                        v-model="viewform.apellido"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2">
                      <v-text-field
                      label="Correo electrónico"
                       disabled
                        v-model="viewform.correo"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2" v-show="viewform.celular2 != null">
                      <v-text-field
                       disabled
                        v-model="viewform.celular2"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" md="2" v-show="viewform.celular2 === null">
                      <v-text-field
                       disabled
                        v-model="viewform.telefono"
                      ></v-text-field>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-select
                        v-model="formulario.continua_estudiando"
                        @keyup="errorsNombre = []"
                        :rules="[v => !!v || 'Campo requerido']"
                        label="Continua estudiando"
                        required
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                    <v-col>
                      <v-select
                        v-model="formulario.empleado"
                        @keyup="errorsNombre = []"
                        :rules="[v => !!v || 'Campo requerido']"
                        label="Empleado"
                        required
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-select
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.empleado_area_trabajo"
                        @keyup="errorsNombre = []"
                        label="Empleado en su area de estudio"
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                    <v-col cols="6" md="4">
                      <v-select
                        v-model="formulario.interes_colocado"
                        @keyup="errorsNombre = []"
                        :rules="[v => !!v || 'Campo requerido']"
                        label="Le interesa ser colocado"
                        required
                        :error-messages="errorsNombre"
                        :items="yesno"
                      ></v-select>
                    </v-col>
                    <v-col cols="6" md="4">
                      <v-select 
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.tipo_empleo"
                        @keyup="errorsNombre = []"
                        label="Tipo de empleo"
                        :error-messages="errorsNombre"
                        :items="empleo"
                      ></v-select>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.nombre_empresa"
                        @keyup="errorsNombre = []"
                        label="Nombre de la Empresa"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.contacto_empresa"
                        @keyup="errorsNombre = []"
                        label="Nombre de contacto de la Empresa"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                      <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.cargo_desempenia"
                        @keyup="errorsNombre = []"
                        label="Cargo que desempeña"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                     <v-col cols="6" md="4">
                      <v-text-field
                      :disabled="formulario.empleado === 'No'"
                        v-model="formulario.tel_empresa"
                        @keyup="errorsNombre = []"
                        label="Telefono de la Empresa"
                        :error-messages="errorsNombre"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="6" md="4">
                      <v-text-field
                        v-model="formulario.estatus"
                        @keyup="errorsNombre = []"
                        label="Estatus"
                        :error-messages="errorsNombre"
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
                  <v-btn
                    color="info darken-1"
                    :disabled="!validForm"
                    @click="saveForm4()"
                    text
                  >Enviar Informacion
                </v-btn>
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
                color="indigo"            
                elevation="8"
                small
                fab
                dark
                v-on="on"
                @click="showModalFormulario4(item)"
              >
              <v-icon>switch_account</v-icon>
              </v-btn>
            </template>
            <span>Seguimiento a Graduado</span>
          </v-tooltip>
        </template>
        <v-snackbar v-model="snackbar">
            {{ msjSnackBar}}
            <v-btn color="red" text @click="snackbar = false">Cerrar</v-btn>
        </v-snackbar>
        </v-data-table>
      </v-card>
    </div>  
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>  
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
        hTBegresado:[
          {text:"Nombres", value:'nombre',class:'blue-grey lighten-4'},
          {text:"Apellidos", value:'apellido',class:'blue-grey lighten-4'},
          {text:"Carrera", value:'carrera', class:'blue-grey lighten-4 '},
          {text:"Correo", value:'correo', class:'blue-grey lighten-4 '},
          {text:"Acciones", value:'action',sortable:false,aling:"center",class:'blue-grey lighten-4'},
        ],
        sform:-1,
        viewform:{},
        loader:false,
        searchEgresado:"",
        modalSeguimiento1:false,
        modalSeguimiento2:false,
        modalSeguimiento3:false,
        modalSeguimiento4:false,
        validForm:true,
        formulario:{
          id_aspirante:"",
          id_egresado:"",
          continua_estudiando:"",
          empleado:"",
          empleado_area_trabajo:"",
          interes_colocado:"",
          tipo_empleo:"",
          nombre_empresa:"",
          contacto_empresa:"",
          cargo_desempenia:"",
          tel_empresa:"",
          estatus:"",
        },
        datosReset:{
          seguimiento_completado:"Si",
          estado:"F"
        },
        yesno: ['Si', 'No'],
        empleo: ['Formal', 'Ocacional'],
        snackbar:false,
        msjSnackBar:"",
        errorsNombre:[],
      };
    },
    computed: {

     
    },
    methods: {
      ResetSeguimiento(){
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };  
             let Toast = me.$swal.mixin({
          toast: true,
          position: "bottom-end",
          showConfirmButton: true,
          timer: 3000
        });
        me.loader = true;
        me.$http.put(`${me.$url}/reset`,me.datosReset,header)
        .then(function(response){
            if (response.status == 200) {
              Toast.fire({
              icon:"success",
              title: "Reinicio completado correctamente"
            });
              me.loader = false;
            }
        })
        .catch(function(error){
          if (error.status != 200) {

            Toast.fire({
              icon:"error",
              title: "Ups Ocurrió un error, Intenta nuevamente"
            });
              me.loader = false;
          }
           
        });
      },

      AllData(){
        let me =this;
        me.fetchEgresados();
        me.fetchEgresados2();
        me.fetchEgresados3();
        me.fetchEgresados4();
      },

      fetchEgresados() {  
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };  
        me.loader = true;
        me.$http.get(`${me.$url}/formularioList`,header)
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
      fetchEgresados2() {  
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };  
        me.loader = true;
        me.$http.get(`${me.$url}/formularioList2`,header)
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
      fetchEgresados3() {  
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };  
        me.loader = true;
        me.$http.get(`${me.$url}/formularioList3`,header)
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
      fetchEgresados4() {  
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };  
        me.loader = true;
        me.$http.get(`${me.$url}/formularioList4`,header)
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
        me.modalSeguimiento1 = false;
        me.modalSeguimiento2 = false;
        me.modalSeguimiento3 = false;
        me.modalSeguimiento4 = false;
        setTimeout(() => {
          me.formulario={
          id_aspirante:"",
          id_egresado:"",
          continua_estudiando:"",
          empleado:"",
          empleado_area_trabajo:"",
          interes_colocado:"",
          tipo_empleo:"",
          nombre_empresa:"",
          contacto_empresa:"",
          cargo_desempenia:"",
          tel_empresa:"",
          estatus:"",
          };
          me.resetValidation();
        }, 300);
      },
      resetValidation() {
        let me = this;
        me.errorsNombre = [];
        me.$refs.formSeguimiento.resetValidation();
      },
      saveForm(){
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };
         
          if (me.$refs.formSeguimiento.validate()) {
             const Toast = me.$swal.mixin({
              timer: 10000,
               timerProgressBar: true,   
          
            });
               Toast.fire({
              width:'200%',
              padding:'2rem',
              backdrop:true,
              title: 'Enviar la Informacion?',
              text: "Estas a punto de enviar esta informacion!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Enviar información',
              cancelButtonText: 'Cancelar'
            }).then((result) => {
              if (result.isConfirmed) {
               me.formulario.id_aspirante = me.viewform.id_aspirante;
               me.formulario.id_egresado = me.viewform.id_egresado;
              console.log(me.formulario)
              me.$http.post(`${me.$url}/seguimientoSave`, me.formulario, header)
                .then(function(response) {
                  if(response.status == 200){
                    me.loader = true;
                    
                  Toast.fire(
                  'Listo!',
                  'Información enviada con éxito',
                  'success'
                  );
                  me.arrayEgresado.splice(me.sform, 1);
                  me.fetchEgresados2();
                  me.loader = false;
                  }
                  me.cerrarModal();
               
              })
              .catch(function(error) {
                me.cerrarModal();
                me.loader = false;
                console.log(error);
                me.$swal("Ups", "Ha Ocurrio Un Error Intente Nuevamente", "error");
              });
               
              }
            });
           
          }     
      },
       saveForm2(){
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };
         
          if (me.$refs.formSeguimiento.validate()) {
             const Toast = me.$swal.mixin({
              timer: 10000,
               timerProgressBar: true,   
          
            });
               Toast.fire({
              width:'200%',
              padding:'2rem',
              backdrop:true,
              title: 'Enviar la Informacion?',
              text: "Estas a punto de enviar esta informacion!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Enviar información',
              cancelButtonText: 'Cancelar'
            }).then((result) => {
              if (result.isConfirmed) {
               me.formulario.id_aspirante = me.viewform.id_aspirante;
               me.formulario.id_egresado = me.viewform.id_egresado;
              console.log(me.formulario)
              me.$http.post(`${me.$url}/seguimientoSave2`, me.formulario, header)
                .then(function(response) {
                  if(response.status == 200){
                    me.loader = true;
                    
                  Toast.fire(
                  'Listo!',
                  'Información enviada con éxito',
                  'success'
                  );
                  me.arrayEgresado2.splice(me.sform, 1);
                  me.fetchEgresados3();
                  me.loader = false;
                  }
                  me.cerrarModal();
               
              })
              .catch(function(error) {
                me.cerrarModal();
                me.loader = false;
                console.log(error);
                me.$swal("Ups", "Ha Ocurrio Un Error Intente Nuevamente", "error");
              });
               
              }
            });
           
          }    
      },
       saveForm3(){
        let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };
         
          if (me.$refs.formSeguimiento.validate()) {
             const Toast = me.$swal.mixin({
              timer: 10000,
               timerProgressBar: true,   
          
            });
               Toast.fire({
              width:'200%',
              padding:'2rem',
              backdrop:true,
              title: 'Enviar la Informacion?',
              text: "Estas a punto de enviar esta informacion!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Enviar información',
              cancelButtonText: 'Cancelar'
            }).then((result) => {
              if (result.isConfirmed) {
               me.formulario.id_aspirante = me.viewform.id_aspirante;
               me.formulario.id_egresado = me.viewform.id_egresado;
              console.log(me.formulario)
              me.$http.post(`${me.$url}/seguimientoSave3`, me.formulario, header)
                .then(function(response) {
                  if(response.status == 200){
                    me.loader = true;
                    
                  Toast.fire(
                  'Listo!',
                  'Información enviada con éxito',
                  'success'
                  );
                  me.arrayEgresado3.splice(me.sform, 1);
                  me.fetchEgresados4();
                  me.loader = false;
                  }
                  me.cerrarModal();
               
              })
              .catch(function(error) {
                me.cerrarModal();
                me.loader = false;
                console.log(error);
                me.$swal("Ups", "Ha Ocurrio Un Error Intente Nuevamente", "error");
              });
               
              }
            });
           
          }      
      },
       saveForm4(){
       let token = localStorage.getItem('token');
        let me = this,
         header = {
              headers: {
                "Authorization": "Bearer "+ token,
                
              },
            };
         
          if (me.$refs.formSeguimiento.validate()) {
             const Toast = me.$swal.mixin({
              timer: 10000,
               timerProgressBar: true,   
          
            });
               Toast.fire({
              width:'200%',
              padding:'2rem',
              backdrop:true,
              title: 'Enviar la Informacion?',
              text: "Estas a punto de enviar esta informacion!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Enviar información',
              cancelButtonText: 'Cancelar'
            }).then((result) => {
              if (result.isConfirmed) {
               me.formulario.id_aspirante = me.viewform.id_aspirante;
               me.formulario.id_egresado = me.viewform.id_egresado;
              console.log(me.formulario)
              me.$http.post(`${me.$url}/seguimientoSave4`, me.formulario, header)
                .then(function(response) {
                  if(response.status == 200){
                    me.loader = true;
                    
                  Toast.fire(
                  'Listo!',
                  'Información enviada con éxito',
                  'success'
                  );
                  me.arrayEgresado4.splice(me.sform, 1);
                  me.loader = false;
                  }
                  me.cerrarModal();
               
              })
              .catch(function(error) {
                me.cerrarModal();
                me.loader = false;
                console.log(error);
                me.$swal("Ups", "Ha Ocurrio Un Error Intente Nuevamente", "error");
              });
               
              }
            });
           
          }   
      },
      setMessageToSnackBar(msj, estado) {
        let me = this;
        me.snackbar = estado;
        me.msjSnackBar = msj;
      },
      showModalFormulario(viewform) {
        let me = this;
        me.sform = me.arrayEgresado.indexOf(viewform);
        me.viewform = Object.assign({},viewform);
        me.modalSeguimiento1 = true;
        console.log(viewform);
      },
       showModalFormulario2(viewform) {
        let me = this;
        me.sform = me.arrayEgresado2.indexOf(viewform);
        me.viewform = Object.assign({},viewform);
        me.modalSeguimiento2 = true;
        console.log(viewform);
      },
       showModalFormulario3(viewform) {
        let me = this;
        me.sform = me.arrayEgresado3.indexOf(viewform);
        me.viewform = Object.assign({},viewform);
        me.modalSeguimiento3 = true;
        console.log(viewform);
      },
       showModalFormulario4(viewform) {
        let me = this;
        me.sform = me.arrayEgresado4.indexOf(viewform);
        me.viewform = Object.assign({},viewform);
        me.modalSeguimiento4 = true;
        console.log(viewform);
      },
      
    },
    mounted() {
      let me = this;
      me.AllData();

      let x = sessionStorage.getItem('tokenS');
      if(x != null){
        let y = "Aqui"
        console.log(y.substr(0,1));
      }else{
         
         this.$router.push('/login')
      }
       
    },
  };
</script>