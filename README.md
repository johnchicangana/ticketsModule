## Rutas api disponibles en el proyecto

GET|HEAD        api/interactions interactions.index
POST            api/interactions interactions.store
GET|HEAD        api/interactions/{id} interactions.show
PUT|PATCH       api/interactions/{id} interactions.update
DELETE          api/interactions/{id} interactions.destroy
GET|HEAD        api/roles ............ roles.index
GET|HEAD        api/roles/{id} ......... roles.show
GET|HEAD        api/tickets ..... tickets.index
POST            api/tickets ..... tickets.store
GET|HEAD        api/tickets/{id} .. tickets.show
PUT|PATCH       api/tickets/{id} tickets.update
DELETE          api/tickets/{id} tickets.destroy
GET|HEAD        api/user-roles user-roles.index
GET|HEAD        api/user-roles/{id} user-roles.show
GET|HEAD        api/users ........... users.index
GET|HEAD        api/users/{id} ........ users.show

## Description

El back esta hecho en laravel y front en vueJs, back y front estan disponibles en este mismo repositorio

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
