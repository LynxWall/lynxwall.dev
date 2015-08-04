# lynxwall.dev
Phalcon test project

Project with multiple modules using a shared layout.

Found that routes had to be added to the DI container before the Application class
was initialized so they would work correcly.

root path '/' will default to the frontend module </br>
admin path '/admin' will used the admin module.

