import Vue from 'vue'
import Vuex from 'vuex'

Vue.mixin({
  computed: {
    ...Vuex.mapGetters({
      user: 'auth/user',
      profils: ['auth/profils']
    })
  }
})

