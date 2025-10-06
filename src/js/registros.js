(function () {
    const inputFecha = document.querySelector("#fecha");
    
    

    if(inputFecha) {
        const tableBody = document.querySelector(".table__tbody");
        inputFecha.addEventListener("input", seleccionarFecha);

        function seleccionarFecha(e) {
            if(e.target.value) {
                filtrarRegistros(e.target.value);
            }
        }

        async function filtrarRegistros(fecha) {
            const datos = new FormData();
            datos.append("fecha", fecha);
            const url = "/api/fecha";
            const respuesta = await fetch(url, {
                method: "post",
                body: datos
            });
            const resultado = await respuesta.json();
            console.log(resultado);
            if(resultado.resultado !== false) {
                mostrarRegistros(resultado);
            } else {
                limpiarRegistros();
                const noResultados = document.createElement("P");
                noResultados.classList.add("dashboard__heading");
                noResultados.textContent = "No hay resultados para tu busqueda";
                tableBody.appendChild(noResultados);
                
            }
            

        }

        function mostrarRegistros(registros) {
            limpiarRegistros();
            const tbody = document.querySelector(".table__tbody");
            registros.forEach(registro => {
                

                registro.usuarios.forEach(usuario => {
                    const tr = document.createElement("TR");
                    tr.classList.add("table__tr");

                    const tdNombre = document.createElement("TD");
                    tdNombre.classList.add("table__td");

                    const {nombre, apellido} = usuario.usuario
                    tdNombre.textContent = `${nombre} ${apellido}`;
                    tr.appendChild(tdNombre);

                    const tdHora = document.createElement("TD");
                    tdHora.classList.add("table__td");
                    if(usuario.hora) {
                        tdHora.textContent = usuario.hora;
                        tr.appendChild(tdHora);
                    } else {
                        tdHora.textContent = "Hora de asistencia No registrada";
                        tr.appendChild(tdHora);
                    }
                    

                    const tdComida = document.createElement("TD");
                    tdComida.classList.add("table__td");
                    if(usuario.comida) {
                        const {horaSalida, horaEntrada} = usuario.comida;
                        tdComida.textContent = `${horaSalida} - ${horaEntrada}`;
                        tr.appendChild(tdComida);
                    } else {
                        tdComida.textContent = `No registrada`;
                        tr.appendChild(tdComida);
                    }

                    // const tdDiferiencia = document.createElement("TD");
                    // tdDiferiencia.classList.add("table__td");
                    // if(usuario.diferiencia) {
                    //     tdDiferiencia.textContent = usuario.diferiencia;
                    //     tr.appendChild(tdDiferiencia);
                    // } else {
                    //     tdDiferiencia.textContent = `No registrada`;
                    //     tr.appendChild(tdDiferiencia);
                    // }
                    

                    const tdSalida = document.createElement("TD");
                    tdSalida.classList.add("table__td");
                    if(usuario.salida) {
                        tdSalida.textContent = `${usuario.salida.horaSalida}`;
                        tr.appendChild(tdSalida);
                    } else {
                        tdSalida.textContent = "No registrada";
                        tr.appendChild(tdSalida);
                    }

                    tbody.appendChild(tr);

                });

                
            });

        }

        function limpiarRegistros() {
            while(tableBody.firstChild) {
                tableBody.removeChild(tableBody.firstChild);
            };
        }
    }


})();