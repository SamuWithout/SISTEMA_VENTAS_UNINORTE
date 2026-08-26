document.getElementById('registroForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const nombre = document.getElementById('nombre').value;
    const edad = document.getElementById('edad').value;
    const respuestaDiv = document.getElementById('respuesta');

    // Estructurar los datos a enviar
    const datos = {
        nombre: nombre,
        edad: edad
    };

    try {
        const respuesta = await fetch('guardar.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(datos)
        });

        const resultado = await respuesta.json();
        
        if (resultado.status === 'exito') {
            respuestaDiv.style.color = 'green';
            respuestaDiv.textContent = resultado.mensaje;
            document.getElementById('registroForm').reset();
        } else {
            respuestaDiv.style.color = 'red';
            respuestaDiv.textContent = 'Error al guardar los datos.';
        }
    } catch (error) {
        respuestaDiv.style.color = 'red';
        respuestaDiv.textContent = 'Error de conexión con el servidor.';
    }
});