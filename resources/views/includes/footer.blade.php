<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
   function confirmDelete(id, dataName) {
      Swal.fire({
          title: 'Anda yakin?',
          text: "Anda akan menghapus " + dataName + " dari database!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Ya, hapus!',
          cancelButtonText: 'Tidak, batal!',
          reverseButtons: true
      }).then((result) => {
          if (result.isConfirmed) {
              document.getElementById('deleteForm-' + id).submit();
          }
      });
  }
</script>

<script>
    document.querySelector('.sidebar-item button').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin ingin keluar?',
            text: 'Anda akan logout dari aplikasi.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, keluar!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });
</script>