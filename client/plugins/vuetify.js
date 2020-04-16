import Vue from 'vue'
import Vuetify from 'vuetify'

import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader version "^2.1.1" ,
import fr from './../node_modules/vuetify/src/locale/fr.ts'
Vue.use(Vuetify)

export default ctx => {
  const vuetify = new Vuetify({
    theme: {
      dark: false, // From 2.0 You have to select the theme dark or light here,th
      themes: {
        light: {
        }
      }
    },
    lang: {
      current: 'fr',
      locales: {
        fr
      }
    }
  })
  ctx.app.vuetify = vuetify
}
