    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/style.css">
        <title>Registro</title>
    </head>

    <body>
        
            <form action="insert_user.php" method="POST">
                <h1>Registro</h1>
                <input type="text" name="name" placeholder="Nombre">
                <input type="text" name="lastname" placeholder="Apellido">
                <input type="text" name="username" placeholder="Nombre de usuario">
                <input type="text" name="password" placeholder="Contraseña">
                <input type="text" name="email" placeholder="Email">

                <input type="submit" value="Registrar">
            </form>


        </div>

        <script>
            
            function getContactList() {
                fetch('http://localhost/bk/index.php', {
                    method: 'GET'
                })
                .then(response => response.json())
                .then(data => {
                    const contactList = document.getElementById('contactList');
                    contactList.innerHTML = '';
                    data.forEach(contact => {
                        const listItem = document.createElement('li');
                        listItem.textContent = `/ / ${contact.nombre} / / ${contact.telefono} / / ${contact.email}`;

                        // Botón para actualizar contacto
                        const updateButton = document.createElement('button');
                        updateButton.textContent = 'Actualizar';
                        updateButton.addEventListener('click', () => updateContact(contact.id, contact.nombre, contact.telefono, contact.email));

                        // Botón para eliminar contacto
                        const deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Eliminar';
                        deleteButton.addEventListener('click', () => deleteContact(contact.id));

                        listItem.appendChild(updateButton);
                        listItem.appendChild(deleteButton);

                        contactList.appendChild(listItem);
                    });
                })
                .catch(error => console.error('Error al obtener la lista de contactos:', error));
            }

            // Función para agregar un nuevo contacto al back
            function addContact(event) {
                event.preventDefault();

                const form = event.target;
                const formData = new FormData(form);

                fetch('http://localhost/bk/index.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Contacto agregado:', data);
                    form.reset();
                    getContactList(); // Actualizar la lista de contactos después de agregar uno nuevo
                })
                .catch(error => console.error('Error al agregar contacto:', error));
            }

            // Función para actualizar un contacto existente
            function updateContact(id, nombre, telefono, email) {
                const updatedContact = {
                    nombre: prompt('Ingrese el nuevo nombre:', nombre),
                    telefono: prompt('Ingrese el nuevo teléfono:', telefono),
                    email: prompt('Ingrese el nuevo email:', email)
                };

                fetch(`http://localhost/bk/index.php?id=${id}`, {
                    method: 'PUT',
                    body: JSON.stringify(updatedContact),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        console.log('Contacto actualizado correctamente');
                        getContactList(); // Actualizar lista de contactos después de la actualización
                    } else {
                        console.error('Error al actualizar contacto:', response.statusText);
                    }
                })
                .catch(error => console.error('Error al actualizar contacto:', error));
            }

            // Función para eliminar un contacto
            function deleteContact(id) {
                fetch(`http://localhost/bk/index.php?id=${id}`, {
                    method: 'DELETE'
                })
                .then(response => {
                    if (response.ok) {
                        console.log('Contacto eliminado correctamente');
                        getContactList(); // Actualizar la lista de contactos después de eliminar
                    } else {
                        console.error('Error al eliminar contacto:', response.statusText);
                    }
                })
                .catch(error => console.error('Error al eliminar contacto:', error));
            }

            // agregar contacto
            const addContactForm = document.getElementById('addContactForm');
            addContactForm.addEventListener('submit', addContact);

            // Llamar a la función para obtener la lista de contactos cuando la página se carga
            getContactList();
        </script>


    </body>
    </html>










