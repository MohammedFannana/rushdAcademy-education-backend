<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Faild!',
                text: 'An error occurred while creating the user.',
                icon: 'error',
                confirmButtonText: 'Ok',
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true
            }).then(() => {
                window.location.href = 'https://gaza-academy.com/register';
            });
        });
    </script>
