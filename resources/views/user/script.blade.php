<script>
    $(document).ready(function(){
        const id = '{{ $isianKartu->id }}';
        // Section Keterangan
        
        // Set height Keterangan 
        const keterangan = $('#keterangan'+id).val();
        const lineCount = keterangan.split('\n').length;
        const desiredRows = lineCount + 2;
        $('#keterangan' + id).attr('rows', Math.max(desiredRows, 4));
        
        // Input keterangan
        $('#keterangan'+id).on('click', function(){
            $('#saveButton'+id).removeClass('hidden');
            $('#cancelButton'+id).removeClass('hidden');
        });
        // Button cancel form keterangan
        $('#cancelButton'+id).on('click', function(){
            $('#saveButton'+id).addClass('hidden');
            $('#cancelButton'+id).addClass('hidden');
            $('#myForm'+id)[0].reset();
        });
        // Form keterangan
        $('#myForm'+id).on('submit', function(event){
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('addDescription2') }}",
                data: formData,
                success: function(response){
                    console.log(response);
                    $('#saveButton'+id).addClass('hidden');
                    $('#cancelButton'+id).addClass('hidden');
                    toastr.success('Berhasil memperbaharui keterangan!');
                    localStorage.clear();
                    // Perbaharui Status Keterangan
                    if(response.status_keterangan == 'hide'){
                        $('#descriptionStatus' + id).addClass('hidden');
                    } else {
                        $('#descriptionStatus' + id).removeClass('hidden');
                    }
                },
                error: function(){
                    toastr.error('Terjadi kesalahan, silakan coba lagi!');
                }
            });
        });
        // End Section Keterangan

        // Section Title
        // Button add form title
         $('#addTitle-'+id).on('click', function(){
            $('#titleChecklist'+id).removeClass('hidden');
            $('#saveButtonTitle'+id).removeClass('hidden');
            $('#cancelButtonTitle'+id).removeClass('hidden');
            $('#iconCheck-'+id).removeClass('hidden');
            $('#addTitle-'+id).addClass('hidden');
        });
        // Button cancel form title
        $('#cancelButtonTitle'+id).on('click', function(){
            $('#titleChecklist'+id).addClass('hidden');
            $('#saveButtonTitle'+id).addClass('hidden');
            $('#cancelButtonTitle'+id).addClass('hidden');
            $('#iconCheck-'+id).addClass('hidden');
            $('#addTitle-'+id).removeClass('hidden');
            $('#myFormTitle'+id)[0].reset();
        });
        // Form title
        $('#myFormTitle'+id).on('submit', function(event){
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: "{{ route('addTitle2') }}",
                data: formData,
                success: function(response){
                    console.log(response.card_id);
                    $('#titleChecklist'+id).addClass('hidden');
                    $('#saveButtonTitle'+id).addClass('hidden');
                    $('#cancelButtonTitle'+id).addClass('hidden');
                    $('#iconCheck-'+id).addClass('hidden');
                    $('#addTitle-'+id).removeClass('hidden');
                    localStorage.setItem('modal_id', response.card_id);
                    window.location.reload();
                    toastr.success('Berhasil menambahkan judul!');
                },
                error: function(){
                    toastr.error('Terjadi kesalahan, silakan coba lagi!');
                }
            });
        });
        // Show modal after create title
        var modal_id = localStorage.getItem('modal_id');
        $('#isianKartu'+modal_id).modal('show');
        $('#isianKartu'+id).on('click', function(){
            localStorage.clear();
        });
        // End Section Title
    });
</script>