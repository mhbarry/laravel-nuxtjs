const options = JSON.parse(`{"env":{"APP_NAME":"Laravel","APP_ENV":"local","APP_URL":"http://localhost:8000","PUSHER_APP_ID":"myId","PUSHER_APP_KEY":"myKey","PUSHER_APP_SECRET":"mySecret","PUSHER_APP_CLUSTER":"mt1"}}`)
const env = options.env
window.env = env
export default function (context, inject) {
  inject('env', (key) => {
    key = key.toUpperCase()
    return env[key] || ''
  })
}
