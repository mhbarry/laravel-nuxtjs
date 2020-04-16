export const state = () => {
  return {
    user: {
      profils: []
    },
    tokens: {
      access: '',
      refresh: ''
    }
  }
}

export const getters = {
  user: state => state.user || { profils: [] },
  access_token: state => state.tokens.access,
  refresh_token: state => state.tokens.refresh,
  profils: state => _.isObject(state.user) ? state.user.profils || [] : []
}

export const mutations = {
  SET_DATA(state, data) {
    state.user = data.user || {}
    state.tokens = {
      access: data.access_token || '',
      refresh: data.refresh_token || ''
    }
    $nuxt.$session.set('auth', data)
  },
  SET_USER(state, user) {
    state.user = user
  }
}

export const actions = {
  setData(store, data) {
    store.commit('SET_DATA', data)
  },
  setUser(store, user) {
    store.commit('SET_USER', user)
  },
  logout(store) {
    store.commit('SET_DATA', {})
    $nuxt.$session.remove('auth')
    // document.querySelector('body').style.display = 'none'
    // window.location.href = window.location.origin
    $nuxt.$router.replace('/')
  }
}
