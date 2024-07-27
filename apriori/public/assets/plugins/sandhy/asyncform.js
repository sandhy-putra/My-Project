  function saveform(e,url,form=null){
    e.preventDefault();
     // Serialize data formulir
     
     if(form!=null){
      var formData = $('#standarform'+form).serialize();
     }else{
      var formData = $('#standarform').serialize();
     }   
        // Kirim data ke server menggunakan AJAX
        $.ajax({
            type: 'POST',
            url: url, // Ganti '/submit' dengan URL endpoint Anda
            data: formData,
            success: function(response) {
              Swal.fire(
                  response.success,
                  response.message,
                  response.icon,
              ).then(() => {
                      // Delay 2 detik sebelum redirect
                      setTimeout(() => {
                        if(form!=null){
                          $('#standarform'+form)[0].reset();
                        }else{
                          $('#standarform')[0].reset();
                        }

                        window.location.href = response.refresh;
                      }, 300); // 2000 milidetik = 2 detik
                });
                
            },
            error: function(xhr, status, error) {
              Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan!.',
                            'error'
                        );
            }
        });
  }

  function openList(url,arrayParams,modal=1){
         // Mengubah array menjadi string JSON yang dikodekan URI
         let queryString = `params=${encodeURIComponent(JSON.stringify(arrayParams))}`;

         // Menambahkan query parameter ke URL
         let fullUrl = `${url}?${queryString}`;

         $.ajax({
             url: fullUrl,
             type: "GET",
             async: true,
             success: function(data) {
              if(modal==1){
                 $("#mdlresult").html(data);
              }else{
                $("#mdlresult2").html(data);
              }
             },
             error: function(xhr, status, error) {
                 console.error(status + ": " + error);
             }
         });
    }

    function destroyData(e,url,arrayParams){
      e.preventDefault();
      Swal.fire({
              title: 'Anda Yakin?',
              text: "Data yang telah dihapus / dinonaktifkan tidak dapat dikembalikan!",
              icon: 'question',
              showCancelButton: true
          }).then((result) => {
              if (result.isConfirmed) {
                  // Here you can add the code to delete the item
                  // For example, an AJAX request to delete the item from the server
                  var csrfToken = $('meta[name="csrf-token"]').attr('content');
                  
                  // Mengubah array menjadi string JSON yang dikodekan URI
                  let queryString = `params=${encodeURIComponent(JSON.stringify(arrayParams))}`;
                  // Menambahkan query parameter ke URL
                  let fullUrl = `${url}?${queryString}`;

                  
                  $.ajax({
                      url: fullUrl, // Replace with your URL
                      type: 'GET',
                      data: {
                        _token: csrfToken // Menambahkan token CSRF ke data permintaan
                      },
                      success: function(response) {
                          Swal.fire(
                              response.success,
                              response.message,
                              response.icon,
                          ).then(() => {
                                  // Delay 2 detik sebelum redirect
                                  setTimeout(() => {
                                    window.location.href = response.refresh;
                                  }, 300); // 2000 milidetik = 2 detik
                              });
                          
                      },
                      error: function(error) {
                          Swal.fire(
                            response.success,
                            response.message,
                            response.icon,
                          );
                      }
                  });
              }
          });
    }

    function logout(e,url){
      e.preventDefault();
      Swal.fire({
              title: 'Anda Yakin?',
              text: "Anda akan keluar dari sistem",
              icon: 'question',
              showCancelButton: true
          }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                      url: '/logout', // Replace with your URL
                      type: 'GET',
                      
                      success: function(response) {
                        window.location.href = '/logout';
                      }
                  });
              }
          });
    }