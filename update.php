

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>
</head>
<body>
    <div class="users-form">
        <form id="editForm" method="POST">
            <h1>Editar Usuario</h1>
            <input type="hidden" name="id" value="">
            <input type="text" name="name" placeholder="Nombre">
            <input type="text" name="lastname" placeholder="Apellido">
            <input type="text" name="username" placeholder="Username">
            <input type="text" name="password" placeholder="Password">
            <input type="text" name="email" placeholder="Email">

            <input type="submit" value="Actualizar Informacion">
        </form>
    </div>

    <script>
        const form = document.getElementById('editForm');
        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            // Convert the form data to a PUT request
            const formData = new FormData(form);
            fetch('', { // Replace with the URL of your API endpoint, e.g., 'edit_user.php'
                method: 'PUT',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    alert('User information updated successfully!');
                    location.reload(); // Refresh the page after successful update
                } else {
                    alert('Error updating user information.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating user information.');
            });
        });
    </script>
</body>
</html>
