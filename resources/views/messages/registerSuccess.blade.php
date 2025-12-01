<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Done!',
                text: 'User Created successfully',
                icon: 'success',
                confirmButtonText: 'Ok',
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true
            }).then(() => {
                window.location.href = 'https://gaza-academy.com/login';
            });
        });
    </script>


