@if(session('success') || $errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: '{{ session("success") ? "success" : "error" }}',
                title: '{{ session("success") ? "Berhasil!" : $errors->first() }}',
                text: '{{ session("success") ?? session("error") }}',
                timer: 3000,
                showConfirmButton: false
            });
        });
    </script>
@endif  

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Yakin mau hapus?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
<script>
    document.getElementById('buatPesanan').addEventListener('click',function(){
        Swal.fire({
            title:'Konfirmasi Pesanan?',
            text:'Apakah Pesanan Sudah Benar',
            icon:'question',
            showCancelButton:true,
            confirmButtonColor:'#205781',
            cancelButtonColor:'#d33',
            confirmButtonText:'Iya, Lanjutkan!',
            cancelButtonText:'batal',
        }).then((result)=>{
            if(result.isConfirmed){
                document.getElementById('orderForm').submit();
            }
        })
    })
</script>