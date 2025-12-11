<script>
    @if (session()->has('successMsg'))
        toastr.success('{{ session('success') }}', "Success");
    @elseif (session()->has('errorMsg'))
        toastr.error('{{ session('errorMessage') }}', "Error");
    @elseif (session()->has('warningMsg'))
        toastr.warning('{{ session('warning') }}', "Warning");
    @endif
</script>