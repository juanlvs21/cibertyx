# Cibertyx
Pagina web informativa de *Cibertyx*, explica quienes somos,  sus trabajos y un formulario de contacto.

Los trabajos en el portafolio de la pagina se cargan desde una base de datos para ser publicados dinamicamente.

El formulario de contacto ademas de enviar un correo electrónico se almacena en una base de datos para llevar un control de las solicitudes.

# Panel de Administrador
Al entrar a /admin muestra un login para iniciar sesion

- Inicio: 
	- Tarjetas con el numero de solicitudes  totales,  en ejecución, terminados  y rechazados. 
	- Grafica de barras con estadisticas reales de las solicitudes recibidas en cada mes. 
	- Las ultimas 5 solicitudes recibidas.
	- Ultimos 5 usuarios  que iniciaron sesion.
	- Ultimas 5 revisiones, muestra que usuario marco una solicitud especifica.

- Trabajos:
	- Solicitudes: muestra una tabla con los detalles de las solicitudes y los cambios de estados, marcar marcar como `revisado`, `en ejecucion`, `rechazado` y `terminado`.
	- Terminados: muestra una tabla con los detalles de las solicitudes terminadas, el nombre del proyecto y su url. (Los protectos en esta lista serán los que se mostraran en el portafolio de la pagina informativa)

- Usuarios: 
	- Lista de todos los usuarios de la plataforma.
	- Nuevo usuario: se ingresa el correo electronico del nuevo usuario y a su correo se le enviará su contraseña aleatorea la cual deberá ser cambiada posteriormente.

- Perfil: Permite cambiar datos personales, asi como tambien la contraseña.