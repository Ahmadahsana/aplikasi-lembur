// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    dom: 'lBfrtip',
    buttons: [
      { extend: 'excel', className: 'btn btn-success btn-sm', "text": '<i class="ti-receipt"></i> Excel' },
      // { extend: 'pdf', className: 'btn btn-danger btn-sm', "text": '<i class="fas fa-file-pdf"></i> PDF' }
    ]
  });
  
});
