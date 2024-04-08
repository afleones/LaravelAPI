![image](https://github.com/afleones/LaravelAPI/assets/42587991/4c74f94e-a552-471b-a99e-f4698d9851b3)

Prueba Tecnica de Conocimiento Desarrollo Web Back End

Esta prueba tiene un tiempo de realizacion de 2 dias habiles desde el momento que se le asigna (en caso de no ser entregada dentro del tiempo estipulado, se asume como no competente para el cargo).

debe ser realizada en lenguaje php usando el framework => laravel

CLONAR REPOSITORIO PRECONFIGURADO PARA INICIAR DESARROLLO:

https://github.com/afleones/LaravelAPI.git

en un club de baloncesto nace la necesidad de poder manejar la informacion de cada jugador y sus directivos, usted ha sido contratado para solventar esta necesidad.

usted debe desarrollar una API web que permita manejar esta informacion.

LAS ENTIDADES SON:

* usuarios (Usuarios del sistema)
* personas (donde inicialmente se registraran las personas antes de ser jugadores, directivos o representantes).
* Jugadores
* directivos
* representantes(Padre,Madre,Acudiente)
* Grupos de Trabajo de los cuales haran parte los representantes y directivos. ej: grupo de logistica

ACTIVIDADES PROPUESTAS: 

inicialmente usted debera construir un M.E.R (Modelo Entidad Relacion) para determinar la logica del negocio y asi poder estructurar un codigo con base al caso de estudio.

Realizar un CRUD(CREATE, READ, UPDATE, DELETE) de las entidades mencionadas.

HERRAMIENTAS RECOMENDADAS: 

- Postman (pra probar los endpoints de forma local)
- Visual studio code (editor de codigo)
- mysql workbench (para tener visualizacion de la base de datos)
- chatgpt

puede usar las herramientas de su preferencia...

Entregables:

M.E.R (Modelo Entidad Relacion)
Coleccion de EndPoints en formato .JSON (se exporta en postman)
Script en formato .sql de la base de datos
Repositorio actualizado y funcional (subirlo en su cuenta de github y adjuntar link)

todo debe ser enviado como un .zip al correo: "andres.leones@nexus-it.co" con copia a "gerencia@nexus-it.co"

asunto: Prueba Tecnica de Conocimiento NEXUS IT

TENGA EN CUENTA QUE:

-Si un usuario no esta logueado en el sistema no debe poder acceder a las demas funciones.

- Las entidades mencionadas arriba son las principales, pero podra necesitar la creacion de mas entidades.

- Debe existir un modelo (persona) donde inicialmente se registren los usuarios del plantel, y luego con base en esta informacion registrada en el sistema, podra crear jugadores, directivos y representantes segun sea el caso.

- Asegurese de establecer correctamente las relaciones en la base de datos para evitar errores de funcionamiento.

- Los nombres en modelos deben ser en CamelCase y en Singular ej: Usuario y no Usuarios.
- Los nombres de los Controladores deben ser en CamelCase y en plural ej: UsuariosController.

-Debe tener una perfecta organizacion tanto del codigo(indentado, comentarios y estructura).

- Los campos que debe colocar en cada modelo, entre mas detallada sea la informacion que se registra mas facil sera darle manejo a la misma.

Exitos
