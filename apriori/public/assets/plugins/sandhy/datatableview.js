var tabledatavalue = document.getElementById('table-data-value');
  if (tabledatavalue === null) {
    tabledatavalue='';
  }else{
    tabledatavalue=document.getElementById('table-data-value').innerHtml;
  }
  
  $(function () {
    if(tabledatavalue!=''){
      tableid= '#' + '{{ $tableid }}';
      $(tableid).DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo(tableid+'_wrapper .col-md-6:eq(0)');

    // Delete data
      $(tableid).on('click', '.del-btn', function() {
        var dataIdValue = $(this).data('url');

        deletedata(dataIdValue);
    });

    }

    
  });