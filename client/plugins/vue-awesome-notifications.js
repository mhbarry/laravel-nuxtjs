import Vue from 'vue'
import VueAWN from 'vue-awesome-notifications'
import 'awesome-notifications/dist/style.css'

Vue.use(VueAWN, {
  position: 'top-right',
  labels: {
    success: '',
    alert: '',
    confirm: '',
    okLabel: ''
  }
})
