const middleware = {}

middleware['auth'] = require('..\\middleware\\auth.js')
middleware['auth'] = middleware['auth'].default || middleware['auth']

middleware['not-auth'] = require('..\\middleware\\not-auth.js')
middleware['not-auth'] = middleware['not-auth'].default || middleware['not-auth']

export default middleware
