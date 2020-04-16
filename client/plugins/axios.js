import _ from 'underscore'
export default function ({ $axios, redirect, store, isDev }) {

  $axios.onRequest(config => {
    config.baseURL = $nuxt.$env('APP_URL') + '/api'

    config.headers.common.Authorization = store.getters['auth/access_token']
  })

  $axios.onError(error => {
    const code = parseInt(error.response && error.response.status)
    if (code == 422) {
      let message = `<div><h2>Erreurs : </h2><ul>`;
      // $awn.alert(`Merci de bien remplir le formulaire`)
      _.each(error.response.data.errors, errors => {
        message += `<li>${errors.join(message)}</li>`
      })
      message += `</ul></div>`
      $nuxt.$awn.alert(message)
    } else if (code == 401) {
      $nuxt.$store.dispatch('auth/logout')
    }
  })

  $axios.onResponse((response) => {
  })
}
