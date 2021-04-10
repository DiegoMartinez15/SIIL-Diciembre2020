<template>
<v-app>
 
  <template>
    <div>
    <v-container>
        <v-row>
            <v-card
            id="scroll-target"
            class="card"
            :src="'/itcha/tuputamadre.jpg'">
            <v-card-title>
            <v-col cols="4">
            <div>
             <v-avatar
                  size="120">
                    <img
                    class="mb-6"
                        :src="'/itcha/escudo.png'"
                    >
              </v-avatar>    
            </div>
               </v-col>
            <v-col cols="8">
            <div class="mb-4 ml-4">
                <v-toolbar-title  id="tittletool">Sistema Informatico de Intermediacion Laboral</v-toolbar-title>
            </div>
                 </v-col>
            </v-card-title>
            </v-card>
        </v-row>
    </v-container>
    </div>
  </template>

  <div>
    <section>
    <template >
        <v-card height="400" style="margin:20px">
        <v-carousel
        show-arrows-on-hover cycle class="mt-6" height="100%"  v-model="model">
          <v-carousel-item
            v-for="(color, i) in colors"
            :key="i"
            :src="'/itcha/'+ color.src"
          >
          </v-carousel-item>
        </v-carousel>
        </v-card>
      </template>
  </section>

   <template>
    <div>
    <v-container>
        <v-row>
          <v-card
            id="scroll-target"
            class="card2"
            :src="'/itcha/tuputamadre.jpg'">

            
            <v-card-actions>
              <v-spacer></v-spacer>
              <router-link
                to="/login"
                >
            <v-col class="text-center" cols="12" sm="12" >    
              <v-btn id="btncard"  elevation="10" color="primary" dark class="mb-2" >
                Inicia Ya!&nbsp;&nbsp;
                <v-icon>arrow_right_alt</v-icon>
              </v-btn>
            </v-col>
              </router-link>
            </v-card-actions>
          </v-card>
        </v-row>
    </v-container>
    </div>
  </template>

  <br>
  <br>

    <div>
      <h1 id="linetittle" class="text-center mb-16">Informacion del Proceso de Intermediacion Laboral </h1>
    </div>


    <template>
  <v-row justify="center" class="row align-content-between  mt-5 rounded" dense>
    <v-col cols="12" sm="4">
    <v-hover>
      <template v-slot:default="{ hover }">
        <v-card id="cards"
         :elevation="hover ? 40 : 1"
    class="mx-auto elevation-10"
    max-width="360"
  >
    <v-img height="200" class="white--text align end" src="https://www.itcha.edu.sv/images/portada/ventajas-med.JPG">
        <v-card-title>Que es Intermediacion Laboral?</v-card-title>
    </v-img>

    <v-card-text class="text--primary">
      <div>
      La Intermediación Laboral en ITCHA-AGAPE
      se enfoca básicamente en guiar al
      estudiante por una serie de procesos que le
      permitan asegurar un empleo formal,
      relacionado a las competencias adquiridas
      en su carrera técnica, tomando en cuenta
      sus necesidades, intereses y motivaciones.
      Para esto es necesario capacitar al
      estudiante egresado en la elaboración del
      Curriculum Vitae y cómo realizar su primera
      entrevista de trabajo, además de vincularlos
      con las respectivas empresas o instituciones
      que generan demanda de nuestros técnicos,
      ya sea a través de bolsas de empleo o por la Mesa de
      Empleo y Autoempleo de Chalatenango.
      </div>
    </v-card-text>

  </v-card>
      </template>
    </v-hover>
    </v-col>


  <v-col cols="12" sm="4">
  <v-hover>
      <template v-slot:default="{ hover }">
        <v-card id="cards"
         :elevation="hover ? 40 : 1"
    class="mx-auto elevation-10"
    max-width="360"
  >
    <v-img height="200" class="white--text align end" src="https://www.itcha.edu.sv/images/portada/ventajas-med.JPG">
        <v-card-title>Proceso Seguimiento A Graduados</v-card-title>
    </v-img>

    <v-card-text class="text--primary">
      <div>
      La empleabilidad se monitorea a través de
      llamadas telefónicas y de contactos por
      medio de nuestros medios virtuales. Los
      servicios de IL se prestarán a graduados del
      ITCHA-AGAPE por un período de 1 año
      posterior a su graduación. La IL se desarrolla
      con estudiantes graduados de las diferentes
      carreras del ITCHA-AGAPE por un periodo de
      1 año posterior a su graduación. La meta
      anual de inserción laboral está definida en el
      plan operativo anual de la institución. Los
      graduados que recibirán este apoyo serán
      aquellos que lo soliciten a través del
      formulario de seguimiento a graduados.
      </div>
    </v-card-text>

  </v-card>
      </template>
    </v-hover>
    </v-col>

  <v-col cols="12" sm="4">
  <v-hover>
      <template v-slot:default="{ hover }">
        <v-card id="cards"
         :elevation="hover ? 40 : 1"
    class="mx-auto elevation-10"
    max-width="360"
  >
    <v-img height="200" class="white--text align end" src="https://www.itcha.edu.sv/images/portada/ventajas-med.JPG">
        <v-card-title>Ventajas</v-card-title>
    </v-img>

    <v-card-text class="text--primary">
      <div>
        La principal ventaja de formar parte de este proceso
        es el que podras tener una oportunidad a lo largo de
        un año, de poder conseguir una oportunidad de empleo
        de acuerdo a los estudios y la carrera que hayas cursado
        en el Instituto Tecnologico de Chalatenango - ITCHA.
        Periodicamente se estaran publicando ofertas de empleo
        a nivel nacional para cualquier egresado que este interesado
        pueda obtener una mayor informacion de la vacante y de esta
        manera poder optar a un empleo en el area que se desempeña o desea.
      </div>
    </v-card-text>

      <v-card-actions>
        <router-link
        to="/login"
      >
        <v-col class="text-center mt-3 " cols="12" sm="12" >
        <v-btn id="btncard" elevation="10" color="primary" dark class="mb-2" >
            Inicia Ya!&nbsp;&nbsp;
          <v-icon>arrow_right_alt</v-icon>
          </v-btn>
        </v-col>
      </router-link>
      </v-card-actions>

  </v-card>
      </template>
    </v-hover>
    </v-col>
  </v-row>
</template>

  <template>
    <br>
    <br>

    <div>
      <h1 id="linetittle1" class="text-center">Como Empezar ?</h1>
    </div>
    <br>

    <template>
    <h3 id="linetittle2">En el siguiente video estan los pasos para formar parte del proceso de Intermediacion Laboral</h3>
      <div id="youtube-wrapper">
        <div align="center" id="video-youtube">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/Enby2XCwD1Y" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </template>
    
    <br>
    <br>
    <div>
      <h1 id="linetittle1" class="text-center">Nosotros</h1>
    </div>
    <br>

    <template>
      <v-row >
        <img class="featurette-image img-responsive" id="img"
        src="/itcha/logoMEGATEC.png" width="200" height="100"
         />
        <img class="featurette-image img-responsive" id="img"
        src="/itcha/logoMEGATEC.png" width="200" height="100"
         />
        <img class="featurette-image img-responsive" id="img"
        src="/itcha/logoMEGATEC.png" width="200" height="100"
         />
        <img class="featurette-image img-responsive" id="img"
        src="/itcha/logoMEGATEC.png" width="200" height="100"
         />
        <img class="featurette-image img-responsive" id="img"
        src="/itcha/logoMEGATEC.png" width="200" height="100"
         />
        
      </v-row>
    </template>
  <br>

  </template>

  

    <template>
    <v-footer dark color="blue" >
      <v-row justify="center">
      <v-col cols="12" sm="4">
        <v-card-title> <h3 id="center">Nuestra Mision<v-icon class="ml-5">
            directions_run
          </v-icon></h3>
        </v-card-title>
         <v-divider id="linetittle2"></v-divider>
       <v-card-text class="white--text pt-0">
        Formar profesionales técnicos con responsabilidad ciudadana, pensamiento crítico, con sensibilidad a la investigación y al desarrollo tecnológico,
        a través de un proceso educativo que integra aspectos académicos, procedimentales y actitudinales, fortalecidos con un sistema de gestión de calidad,
        para promover el desarrollo social sostenible de nuestro país.
      </v-card-text>
      </v-col>
      <v-col cols="12" sm="4">
        <v-card-title><h3 id="center">Nuestra Vision<v-icon class="ml-5">
            visibility
          </v-icon></h3>
        </v-card-title>
        <v-divider id="linetittle2"></v-divider>
       <v-card-text class="white--text pt-0">
        Ser una institución educativa referente en la formación de profesionales en áreas tecnológicas con competencias para la vida y el trabajo, con sensibilidad humana;
        que se incorporen responsablemente al desarrollo productivo sostenible del país.
      </v-card-text>
      </v-col>
      </v-row>
    </v-footer>
    </template>

    <template>
  <v-footer
    dark
    padless
  >
    <v-card
      class="flex"
      flat
      tile
    >
      
      <v-card-title class="black">
        <strong class="py-2 white--text text-left">&copy; {{new Date().getFullYear()}} - Derechos Reservados - ITCHA AGAPE</strong>

        <v-spacer></v-spacer>
        <v-col cols="12" sm="4">
        <v-btn
          v-for="(item, i) in icons" :key="i"
          class="mx-4 mb-2"
          dark
          fab
          :href="item.link"

        >
          <v-icon size="20px">
            {{ item.icon }}
          </v-icon>
        </v-btn>
        </v-col>
      </v-card-title>
    
      <v-btn
                v-show="!hidden"
                color="secondary"
                elevation="9"
                dark
                absolute
                top
                right
                fab
                x-large 
                @click="$vuetify.goTo(target, options)"
              >
                <v-icon>keyboard_arrow_up</v-icon>
              </v-btn>        
      
    </v-card>
  </v-footer>
  </template>
  

</div>
</v-app>
</template>


<script>
  import * as easings from 'vuetify/es5/services/goto/easing-patterns'

  export default {
    data ()  {
       return {
        hidden: false,
        type: 'number',
        number: 1,
        selector: '#scroll-with-options',
        selected: 'Button',
        elements: ['Button', 'Radio group'],
        duration: 300,
        offset: 0,
        easing: 'easeInOutCubic',
        easings: Object.keys(easings),

      icons: [
        {icon:'mdi-facebook', link: 'http://www.facebook.com/itcha.agape.megatec/'},
        {icon:'mdi-twitter', link: 'https://twitter.com/ITCHA_AGAPE' },
        {icon:'mdi-youtube', link: 'https://www.youtube.com/user/ITCHAAGAPEsv'},
        {icon:'mdi-instagram', link: 'https://www.instagram.com/itcha_agapeelsalvador/'},
        {icon:'mdi-whatsapp', link: 'https://wa.me/50378663586'},
      ],
      model: 0,
      colors: [
                { src:'carru3.jpg'},
                {src:'carru2.jpg'},
                {src:'carru1.jpg'},
                ],
       
    }

    },
    computed: {

      target () {
        const value = this[this.type]
        if (!isNaN(value)) return Number(value)
        else return value
      },
      options () {
        return {
          duration: this.duration,
          offset: this.offset,
          easing: this.easing,
        }
      },
      element () {
        if (this.selected === 'Button') return this.$refs.button
        else if (this.selected === 'Radio group') return this.$refs.radio
        else return null
      },
    },
  }
</script>
<style>
#tittletool{
  font-size: 28px;
  margin-top: -5px;
  color: white;
}
#linetittle{
  border-bottom: solid 3px #0071BC;
  margin-left: 15%;
  margin-right: 15%;
  margin-bottom: 15px;
}
#center{
  text-align: center;
  margin: 0 auto;
}
#linetittle1{
  border-bottom: solid 3px #0071BC;
  margin-left: 11%;
  margin-right: 11%;
  margin-bottom: 15px;
}
#linetittle2{
  border-bottom: solid 3px white;
  margin-bottom: 15px;
  margin-left: 10%;
  margin-right: 10%;
  text-align: center;
}
#cards{
  border-radius: 16px;
  margin: 15px;
  height: 570px;
}
#btncard{

  font-family: system-ui;
  font-size: 16px;
  width: 1000px;
  margin-top: -10%;
  bottom:1px;
  margin: 0 auto;
}
.card{
    width: 100%;
    height: 150px;
    background-image: url('/itcha/tuputamadre.jpg');
    
}
.card2{
    margin-top: -15px;
    width: 100%;
    height: 50px;
    background-image: url('/itcha/tuputamadre.jpg');
    
}
#card2{
  margin: auto;
  width: 93%;
  height: 50px;
}
#imgmega{
  float: left;
}
#img{
  display: block;
  margin: auto;
  padding: 10px;  
}

#video-youtube{
  border: 0px;
  height: 0px;
  padding-bottom: 56.25%;
  position: relative;
}
#video-youtube iframe{
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  border-radius: 16px;
}
#youtube-wrapper{
  width: 70%;
  margin: auto;
}

</style>