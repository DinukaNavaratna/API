<?php
    require 'assets/php/sessions.php';
    require 'header.php';
    require 'assets/php/complaints.php';
?>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="card mt-4">
            <div class="card-header p-3">
              <h5 class="mb-0">Complaints</h5>
            </div>
            <div class="card-body p-3 pb-0">
              <?php 
                foreach ($msgs as $msg) { 
                $msg1 = explode(',', $msg); 
                if($msg1[0] != $userid){
              ?>
                  <div class="alert alert-primary text-white" style="text-align: right !important;">
                    <span class="text-sm"><?php echo $msg1[1]; ?></span>
                  </div>
              <?php 
                } else { 
              ?>
                  <div class="alert alert-dark text-white">
                    <span class="text-sm"><?php echo $msg1[1]; ?></span>
                  </div>
              <?php 
                } }
              ?>
            </div>
          </div>
        </div>
        <?php if($usertpe == 1 || $usertpe == 2) { ?>
        <input id="complaint_msg" class="alert <?php if($usertpe == 1) {echo "alert-dark";} else {echo "alert-dark";} ?> alert-dismissible text-white" role="alert" style="margin-top: 3vh !important;"></input>
        <button type="button" class="btn text-lg py-3" onclick="send_msg(<?php echo $userid.', '.$complaintid; ?>);">
          Send
        </button>
        <?php } ?>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script>
    function send_msg(userid, complaintid){
      var complaint_msg = $('#complaint_msg').val();
      $.ajax({
            url:"assets/php/complaints_updates.php",
            type: "post",
            data: {"func": "send_msg", "userid": userid, "msg": complaint_msg, "complaintid": complaintid},
            success:function(response){
                console.log("Resss: "+response);
                if(response == "success"){
                  if(complaintid == 0){
                    window.location.replace("profile.php");
                  } else {
                    window.location.replace("complaints.php?id="+complaintid);
                  }
                }
            },
            error: function (jqXHR, exception) {
                alert("Error");
            }
        });
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=3.0.2"></script>
</body>

</html>