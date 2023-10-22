/*variables globales para la conexion de envio y recepcion*/
var xmlhttp;
if(window.XMLHttpRequest){xmlhttp=new XMLHttpRequest();}
else{xmlhttp=new ActibeXObject("Microsoft.XMLHTTP");}
/*funcion para mostrar*/

function mostrar() {
    fetch('servidor.php?nombre=&mensaje=')
        .then(response => response.text())
        .then(data => {
            const chat = document.getElementById('chat');
            if (chat.value !== data) {
                chat.value = data;
            }
            setTimeout(mostrar, 1000); // Actualizar cada segundo
        })
        .catch(error => console.error(error));
}

function insertar() {
    const nombre = document.getElementById('nombre').value;
    const mensaje = document.getElementById('mensaje').value;
    
    if (nombre && mensaje) {
        fetch(`servidor.php?nombre=${nombre}&mensaje=${mensaje}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('chat').value = data;
            })
            .catch(error => console.error(error));
    }
}

