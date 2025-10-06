
(function() {
    
    
    const botonEntrada = document.createElement("BUTTON");
    const botonDesayuno = document.createElement("BUTTON");
    const botonEntradaDesayuno = document.createElement("BUTTON");
    const botonComida = document.createElement("BUTTON");
    const botonEntradaComida = document.createElement("BUTTON");
    const botonSalida = document.createElement("BUTTON");

    //const usuarioHidden = document.querySelector("#usuarioId");
    

    const dashboardBotones = document.querySelector(".dashboard-botones");
    console.log(dashboardBotones);
    if(dashboardBotones) {

        botonEntrada.textContent = "Entrada";
        botonEntrada.classList.add("dashboard-botones__boton");
        botonEntrada.id = 1;

        botonDesayuno.textContent = "Desayuno";
        botonDesayuno.classList.add("dashboard-botones__boton");
        botonDesayuno.id = 5;

        botonEntradaDesayuno.textContent = "Entrada Desayuno";
        botonEntradaDesayuno.classList.add("dashboard-botones__boton");
        botonEntradaDesayuno.id = 6;

        botonComida.textContent = "Comida";
        botonComida.classList.add("dashboard-botones__boton");
        botonComida.id = 2;

        botonEntradaComida.textContent = "Entrada Comida";
        botonEntradaComida.classList.add("dashboard-botones__boton");
        botonEntradaComida.id = 3;

        botonSalida.textContent = "Salida";
        botonSalida.classList.add("dashboard-botones__boton");
        botonSalida.id = 4;

        dashboardBotones.appendChild(botonEntrada);
        dashboardBotones.appendChild(botonDesayuno);
        dashboardBotones.appendChild(botonEntradaDesayuno);
        dashboardBotones.appendChild(botonComida);
        dashboardBotones.appendChild(botonEntradaComida);
        dashboardBotones.appendChild(botonSalida);

        const fechaFormato = obtenerFecha();
        const horaFormato = obtenerHora();

        dashboardBotones.addEventListener("click", function(e) {
            if(e.target.id === "1") {
              
                ChecarEntrada(fechaFormato, horaFormato);
            }
            if(e.target.id === "2") {
                
                ChecarComida(fechaFormato, horaFormato);
            }
            if(e.target.id === "3") {
                
                ChecarComidaEntrada(fechaFormato, horaFormato);
            }
            if(e.target.id === "4") {
                
                ChecarSalida(fechaFormato, horaFormato);
            }
            if(e.target.id === "5") {
                
                ChecarDesayuno(fechaFormato, horaFormato);
            }
            if(e.target.id === "6") {
                
                ChecarDesayunoEntrada(fechaFormato, horaFormato);
            }
        });

        async function ChecarEntrada(fecha, hora) {
            // Objeto form data
            const datos = new FormData();
            //datos.append("usuarioId", usuarioHidden.value);
            datos.append("fecha", fecha);
            datos.append("hora", hora);

            const url = "/api/entrada";
            const respuesta = await fetch(url, {
                method: "post",
                body: datos
            });

            const resultado = await respuesta.json()
            
            if(resultado.resultado) {
                Swal.fire(
                    "Registro Exitoso",
                    "Tu Entrada Ha sido Registrada",
                    "success"
                ).then( () => location.href = "/logout");
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error",
                    icon: "error",
                    confirmButtonText: "OK"
                })
            }
            
        }

        async function ChecarDesayuno(fecha, hora) {
            // Objeto form data
            const datos = new FormData();
            //datos.append("usuarioId", usuarioHidden.value);
            datos.append("fecha", fecha);
            datos.append("horaSalida", hora);

            const url = "/api/desayuno";
            const respuesta = await fetch(url, {
                method: "post",
                body: datos
            });

            const resultado = await respuesta.json()
            
            if(resultado.resultado) {
                Swal.fire(
                    "Registro Exitoso",
                    "Tu Salida Ha sido Registrada",
                    "success"
                ).then( () => location.href = "/logout");
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error",
                    icon: "error",
                    confirmButtonText: "OK"
                })
            }
            
        }

        async function ChecarDesayunoEntrada(fecha, hora) {
            // Objeto form data
            const datos = new FormData();
            //datos.append("usuarioId", usuarioHidden.value);
            datos.append("fecha", fecha);
            datos.append("horaEntrada", hora);

            const url = "/api/desayunoEntrada";
            const respuesta = await fetch(url, {
                method: "post",
                body: datos
            });

            const resultado = await respuesta.json()
            
            if(resultado.resultado) {
                Swal.fire(
                    "Registro Exitoso",
                    "Tu Entrada Ha sido Registrada",
                    "success"
                ).then( () => location.href = "/logout");
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error",
                    icon: "error",
                    confirmButtonText: "OK"
                })
            }
            
        }
    

    async function ChecarComida(fecha, hora) {
            // Objeto form data
            const datos = new FormData();
            //datos.append("usuarioId", usuarioHidden.value);
            datos.append("fecha", fecha);
            datos.append("horaSalida", hora);

            const url = "/api/comida";
            const respuesta = await fetch(url, {
                method: "post",
                body: datos
            });

            const resultado = await respuesta.json();
            
            if(resultado.resultado) {
                Swal.fire(
                    "Registro Exitoso",
                    "Tu Salida Ha sido Registrada",
                    "success"
                ).then( () => location.href = "/logout");
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        
        }

        async function ChecarComidaEntrada(fecha, hora) {
            // Objeto form data
            const datos = new FormData();
            //datos.append("usuarioId", usuarioHidden.value);
            datos.append("fecha", fecha);
            datos.append("horaEntrada", hora);

            const url = "/api/comidaEntrada";
            const respuesta = await fetch(url, {
                method: "post",
                body: datos
            });

            const resultado = await respuesta.json();
            
            if(resultado.resultado) {
                Swal.fire(
                    "Registro Exitoso",
                    "Tu Entrada Ha sido Registrada",
                    "success"
                ).then( () => location.href = "/logout");
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        
        }

        async function ChecarSalida(fecha, hora) {
            // Objeto form data
            const datos = new FormData();
            //datos.append("usuarioId", usuarioHidden.value);
            datos.append("fecha", fecha);
            datos.append("horaSalida", hora);

            const url = "/api/salida";
            const respuesta = await fetch(url, {
                method: "post",
                body: datos
            });

            const resultado = await respuesta.json();
            
            if(resultado.resultado) {
                Swal.fire(
                    "Registro Exitoso",
                    "Tu Salida Ha sido Registrada",
                    "success"
                ).then( () => location.href = "/logout");
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Hubo un error",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        
        }
    }
    




    function obtenerFecha() {
        const fecha = new Date();
        const fechaYear = fecha.getFullYear();
        const FechaMes = fecha.getMonth() + 1;
        const fechaDay = fecha.getUTCDate() - 1;
        const fechaFormato = `${fechaYear}-${FechaMes}-${fechaDay}`;

        return fechaFormato;
    }

    function obtenerHora() {
        const hora = new Date()
        const horaHour = hora.getHours();
        const horaMinutes = hora.getMinutes();
        const horaFormato = `${horaHour}:${horaMinutes}:00`;

        return horaFormato;
    }




    

})();