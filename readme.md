# Ada - A Light weight php framework.


Ada has been designed to be an easy to learn and use lightweight framework.

# New Features!

  - Can now specify controller and methods a route should point too.
  - Routes are now seperated by GET requests and POST requests
  ```php
        $router->get(
          array(
            '_url' => '[:host]/account/login',  // URL
             'controller' => 'account',  //Controller to call.
            'action' => 'login' // Controller Method to call.
        )
    );
```

## Features

### Installation


### Development

Want to contribute? Great!

### Todos
 - Finish writing this.
 - Email support
 - Password reset
 - Caching support
 - Api authentication maybe
 - error handling / logging
 - Form Validation
 - xss filtering

License
----
MIT

