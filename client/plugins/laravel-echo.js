import Echo from 'laravel-echo'

window.Pusher = require('pusher-js')
console.error(env)
window.Echo = new Echo({
  broadcaster: 'pusher',
  key: 'myKey',
  wsHost: window.location.hostname,
  wsPort: 6001,
  disableStats: true,
  enabledTransports: ['ws', 'wss']
})
