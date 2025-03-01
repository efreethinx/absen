// Load Setting
function loadSettingUmum(){
    $("#load").html('<div class="text-center"><div class="spinner-border" role="status"></div><p>Loading data...</p></div>');
    $("#load").load("mod/system/form.php?action=system");
}

function loadSettingHour(){
    $("#load").html('<div class="text-center"><div class="spinner-border" role="status"></div><p>Loading data...</p></div>');
    $("#load").load("mod/system/form.php?action=setting-hour");
}

$(document).ready(function() {
  function loading(){
      $(".loading").show();
      $(".loading").delay(1500).fadeOut(500);
  }





loadSettingUmum();
/* -------------------- Edit ------------------- */
$("#load").on("submit", ".update-setting", function(e) {
    if($('#site_url').val()==''){    
         swal({title: 'Oops!', text: 'Harap bidang inputan tidak boleh ada yang kosong.!', icon: 'error', timer: 1500,});
         loading();
        return false;
    }
    else{
        loading();
        e.preventDefault();
        $.ajax({
            url:"mod/system/proses.php?action=update",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            beforeSend: function () { 
                loading();
            },
            success: function (data) {
                if (data == 'success') {
                    swal({title: 'Berhasil!', text: 'Data System berhasil disimpan.!', icon: 'success', timer: 1500,});
                   $('#modalEdit').modal('hide');
                   //setTimeout(function(){ location.reload(); }, 1500);
                   loadSettingUmum();

                } else {
                    swal({title: 'Oops!', text: data, icon: 'error', timer: 1500,});
                }

            },
            complete: function () {
                $(".loading").hide();
            },
        });
    }
  });

 

$(".btn-print").on('click',function () {
    $("#printarea").show();
    window.print();
});


});