<template>
  <v-form v-model="valid" ref="formPerfil" :lazy-validation="true">
    <thead style="font-size:40px;align:center;">Seguimiento a Graduado</thead>
    <v-divider class="black"></v-divider>
    <thead style="font-size:25px">Datos Generales</thead>
    <v-divider class="black"></v-divider>
    <v-container>
      <!--v-row parte 1-->
      <v-row>
         <!--nombre-->
        <v-col cols="12" md="9">
          <v-select
            label="Nombre del egresado"
             :items="nombre"
          ></v-select>
        </v-col>
        <!--Apellido-->
        <v-col cols="12" md="3">
          <v-text-field
            label="Teléfono personal del egresado"
          ></v-text-field>
        </v-col>
      <!--Enfermemdad Cronica-->
        <v-col cols="12" md="6">
          <v-select
            :items="yesno"
            label="Continua estudiando?"
          ></v-select>
        </v-col>
        <v-col cols="12" md="6">
          <v-select
            :items="yesno"
            label="Empleado?"
          ></v-select>
        </v-col>
        <v-col cols="12" md="6">
          <v-select
            :items="yesno"
            label="Empleado en su area de Estudio?"
          ></v-select>
        </v-col>
        <v-col cols="12" md="6">
          <v-select
            :items="yesno"
            label="Le interesa ser colocado?"
          ></v-select>
        </v-col>
        <v-col cols="12" md="6">
          <v-select
            :items="empleo"
            label="Tipo de empleo?"
          ></v-select>
        </v-col>
         <!--si?Enfermemdad Cronica-->
        <v-col cols="12" md="6">
          <v-text-field
            label="Nombre de empresa"
          ></v-text-field>
        </v-col>
          <v-col cols="12" md="6">
          <v-text-field
            label="Nombre de contacto de la empresa"
          ></v-text-field>
        </v-col>
          <v-col cols="12" md="6">
          <v-text-field
            label="Cargo que desempeña"
          ></v-text-field>
        </v-col>
          <v-col cols="12" md="6">
          <v-text-field
            label="telefono de la empresa"
          ></v-text-field>
        </v-col>
          <v-col cols="12" md="6">
          <v-text-field
            label="Estatus"
          ></v-text-field>
        </v-col>
      </v-row>
  </v-container>
    <v-divider class="black"></v-divider>
    <template>
    <v-btn block color="purple" dark  
      
      elevation="8"
      @click="saveForm()"
    >Guaradar informacion del egredado</v-btn>
    </template>
  </v-form>
</template>

<script>
  export default {
    data () {
        return{
            nombre: ['Diego Uriel Martinez Guardado', 'Juan Armardo Paredes Escobar'],
            yesno: ['Si', 'No'],
        }
    }
    }
</script>