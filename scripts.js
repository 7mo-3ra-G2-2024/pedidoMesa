
function agregarAlCarrito(nombre, precio) {
    // Crear un objeto producto con el nombre y precio
    var producto = {
        nombre: nombre,
        precio: precio
    };
    
    // Obtener el carrito actual del localStorage o inicializarlo si no existe
    var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    
    // Agregar el producto al carrito
    carrito.push(producto);

    
    // Guardar el carrito actualizado en el localStorage
    localStorage.setItem('carrito', JSON.stringify(carrito));
    // Actualizar la visualización del carrito
    actualizarCarrito();
}

    // Función para actualizar la visualización del carrito
function actualizarCarrito() {
    // Obtener el carrito actual del localStorage
    var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    // Calcular el total
    var total = 0, cant_pro = 0;

    // Iterar sobre los productos en el carrito
    carrito.forEach(function(producto) {        
        // Sumar el precio del producto al total
        total += parseFloat(producto.precio);
    });

    cant_pro = parseFloat(carrito.length);
    // Actualizar el total en la página
    document.getElementById('total').textContent = total.toFixed(2);
    document.getElementById('cant_plato').textContent = cant_pro;
}

function mostrarPedido() {
    // Obtener el carrito actual del localStorage
    var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    // Obtener el elemento de la lista del carrito
    var listaCarrito = document.getElementById('lista-carrito');

    // Limpiar el contenido previo del carrito
    listaCarrito.innerHTML = '';

    // Calcular el total
    var total = 0;

    // Iterar sobre los productos en el carrito
    carrito.forEach(function(producto) {
        // Crear un elemento de lista para cada producto
        var elementoProducto = document.createElement('li');
        elementoProducto.textContent = producto.nombre + ' - $' + producto.precio;
        
        // Agregar el producto a la lista del carrito
        listaCarrito.appendChild(elementoProducto);
    });

}

    // Función para realizar el pedido
function realizarPedido() {
    let formulario=document.getElementById('formulario');
    // Obtener el carrito actual del localStorage
    var carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    let datos=new FormData(formulario);
    console.log('me diste click');

    formulario.addEventListener('submit', function (e) {
        e.preventDefault();
        let id=1, v=false,nump=1;
        carrito.forEach(function(producto) {//RECORRE EL CARRITO
            datos.append("id",id);
            datos.append("nump",nump);
            datos.append("plato",producto.nombre);
            datos.append("precio",producto.precio);
            fetch('procesar_pedido.php',{
                method: 'POST',
                body: datos
            })//ENVIA LOS DATOS A REALIZARPEDIDO.PHP
            .then( res => res.json())
            .then( data => {//DA UNA RESPUESTA
                console.log(data)
                if (v==false && data=='si') {//SI se realiza el pedido
                    Swal.fire({
                      position: "center",
                      icon: "success",
                      title: 'Se ha realizado el pedido',
                      showConfirmButton: false,
                      timer: 1500
                    });
                    v=true;
                }//SI se realiza el pedido
                else if (v==false && data=='no') {//SI no se realiza el pedido
                    Swal.fire({
                      position: "center",
                      icon: "error",
                      title: 'No se pudo realizar el pedido!',
                      showConfirmButton: false,
                      timer: 1500
                    });
                    v=true;
                }//SI no se realiza el pedido
            }) //DA UNA RESPUESTA
            id++; 
        })    
    })//SI SE PRESIONO EL FORMULARIO
    
    // Implementa la lógica para procesar el pedido aquí, por ejemplo, enviar los datos al servidor
    // Luego, limpiar el carrito y actualizar la visualización del mismo
    localStorage.removeItem('carrito');
    actualizarCarrito();
}

function cancelarPedido(){
    Swal.fire({
      title: "Estas seguro?",
      text: "Seguro deseas cancelar el pedido.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si"
    }).then((result) => {
      if (result.isConfirmed) {///PARA CONDIRMA SI DESA CANCELAR
        Swal.fire({
          title: "Cancelado!",
          text: "El pedido a sido cancelado.",
          icon: "success",
          timer: 1500,
          showConfirmButton: false
        });
        // Obtener el carrito actual del localStorage o inicializarlo si no existe
        var carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        while(carrito.length > 0)
            carrito.pop(); 
        // Guardar el carrito actualizado en el localStorage
        localStorage.setItem('carrito', JSON.stringify(carrito));
        actualizarCarrito();  
      }///PARA CONDIRMA SI DESA CANCELAR
    });
}

function mostrarContacto() {
    var contacto = document.getElementById("contacto");
    if (contacto.style.display === "none") {
        contacto.style.display = "block";
    } else {
        contacto.style.display = "none";
    }
}

function mostrarProductos() {
    // Oculta otros elementos y muestra solo los productos
    document.getElementById("productos").style.display = "block";
    // Oculta otros elementos si es necesario
}

    // Llama a la función para actualizar el carrito cuando la página se carga
    window.onload = actualizarCarrito;