<?php
    require 'assets/php/sessions.php';
    require 'header.php';
    require 'assets/php/profile.php';
?>
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('<?php echo $imageurl; ?>');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row gx-4 mb-2">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php echo $firstname." ".$lastname; ?>
              </h5>
              <input id="user_designation" class="mb-0 font-weight-normal text-sm" value="<?php echo $designation; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>></input>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0" onclick="<?php if($approved){echo "approval('disapprove', $userid);";}else{echo "approval('approve', $userid);";} ?>">
              <?php if(!$show_approve){ ?>
                <ul class="nav nav-pills nav-fill p-1" role="tablist">
                  <li class="nav-item">
                    <button class="nav-link mb-0 px-0 py-1 " title="<?php if($approved){echo "Disapprove this profile";}else{echo "Approve this profile";} ?>">
                      <i class="material-icons text-lg position-relative">settings</i>
                      <span class="ms-1"><?php if($approved){echo "Disapprove";}else{echo "Approve";} ?></span>
                    </button>
                  </li>
                </ul>
              <?php } else if(!$approved){echo "Pending Account Approval!";}else{echo "Account Approved!";}?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="row">
            <div class="col-12 col-xl-4">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-md-8 d-flex align-items-center">
                      <h6 class="mb-0">Profile Information</h6>
                    </div>
                    <div class="col-md-4 text-end">
                    <?php if($editable){ ?>
                      <a href="javascript:;" onclick="<?php if(!$edit){echo "window.location.replace('profile.php?edit');";} else {echo "update();";} ?>">
                        <i class="fas <?php if(!$edit){echo "fa-user-edit";} else {echo "fa-save";} ?> text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php if(!$edit){echo "Edit Profile";} else {echo "Save Changes";} ?>"></i>
                      </a>
                    <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?php echo $fullname; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; <input id="user_mobile" type="text" value="<?php echo $mobile; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $email; ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Industry:</strong> &nbsp; <input id="user_industry" type="text" value="<?php echo $industry; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Highest Education:</strong> &nbsp; <input id="user_highest_education" type="text" value="<?php echo $highest_education; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Expected Salary:</strong> &nbsp; <input id="user_expected_salary" type="text" value="<?php echo $expected_salary; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Address:</strong> &nbsp; <input id="user_address" type="text" value="<?php echo $address; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">City:</strong> &nbsp; <input id="user_city" type="text" value="<?php echo $city; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Postal Code:</strong> &nbsp; <input id="user_postcode" type="text" value="<?php echo $postalcode; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none; width:60% !important;"';} ?>></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Country:</strong> &nbsp; <input id="user_country" type="text" value="<?php echo $country; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">DOB:</strong> &nbsp; <input id="user_dob" type="text" value="<?php echo $dob; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">NIC:</strong> &nbsp; <input id="user_nic" type="text" value="<?php echo $nic; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-xl-4">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <h6 class="mb-0">About Me</h6>
                </div>
                <div class="card-body p-3">
                  <p class="text-sm"><textarea id="user_about" class="text-sm" style="width:100%;" rows="6" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>><?php echo $about; ?></textarea></p>
                  <hr class="horizontal gray-light my-4">
                  <h6 class="text-uppercase text-body text-xs font-weight-bolder">Top 3 Skills</h6>
                  <ul class="list-group">
                    <li class="list-group-item border-0 px-0">
                      <div class="form-check ps-0">
                        <label class="form-check-label text-body text-truncate w-80 mb-0" for="flexSwitchCheckDefault"><input id="user_skill1" type="text" value="<?php echo $skill1; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>></label>
                      </div>
                    </li>
                    <li class="list-group-item border-0 px-0">
                      <div class="form-check form-switch ps-0">
                        <label class="form-check-label text-body text-truncate w-80 mb-0" for="flexSwitchCheckDefault1"><input id="user_skill2" type="text" value="<?php echo $skill2; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>></label>
                      </div>
                    </li>
                    <li class="list-group-item border-0 px-0">
                      <div class="form-check form-switch ps-0">
                        <label class="form-check-label text-body text-truncate w-80 mb-0" for="flexSwitchCheckDefault2"><input id="user_skill3" type="text" value="<?php echo $skill3; ?>" <?php if(!$edit){echo 'disabled  style="background:transparent; border:none;"';} ?>></label>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-xl-4">
              <div class="card card-plain h-100">
                <div class="card-header pb-0 p-3">
                  <h6 class="mb-0">Complaints</h6>
                </div>
                <div class="card-body p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                      <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Topic</h6>
                        <p class="mb-0 text-xs">Message message...</p>
                      </div>
                      <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                      <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Topic</h6>
                        <p class="mb-0 text-xs">Message message...</p>
                      </div>
                      <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                    </li>
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                      <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">Topic</h6>
                        <p class="mb-0 text-xs">Message message...</p>
                      </div>
                      <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto" href="javascript:;">Reply</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 mt-4">
              <div class="row">
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card card-blog card-plain">
                    <div class="card-body p-3">
                      <h5>Birth Certificate</h5>
                      <p class="mb-4 text-sm">
                        <?php echo $filename_bc; ?>
                      </p>
                      <div class="d-flex align-items-center justify-content-between">
                        <?php if($edit){ ?>
                          <input type="file" id="bd_file" style="display:none">
                          <button type="button" class="btn btn-outline-primary btn-sm mb-0" onclick="document.getElementById('bd_file').click();">Upload Document</button>
                        <?php } else {?>
                          <button type="button" class="btn btn-outline-primary btn-sm mb-0" onclick="window.open('files/bd.pdf')">View Document</button>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card card-blog card-plain">
                    <div class="card-body p-3">
                      <h5>Curriculum Vitae</h5>
                      <p class="mb-4 text-sm">
                        <?php echo $filename_cv; ?>
                      </p>
                      <div class="d-flex align-items-center justify-content-between">
                        <?php if($edit){ ?>
                          <input type="file" id="cv_file" style="display:none">
                          <button type="button" class="btn btn-outline-primary btn-sm mb-0" onclick="document.getElementById('cv_file').click();">Upload Document</button>
                        <?php } else {?>
                          <button type="button" class="btn btn-outline-primary btn-sm mb-0" onclick="window.open('files/cv.pdf')">View Document</button>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card card-blog card-plain">
                    <div class="card-body p-3">
                      <h5>NIC/Passport</h5>
                      <p class="mb-4 text-sm">
                        <?php echo $filename_nic; ?>
                      </p>
                      <div class="d-flex align-items-center justify-content-between">
                        <?php if($edit){ ?>
                          <input type="file" id="nic_file" style="display:none">
                          <button type="button" class="btn btn-outline-primary btn-sm mb-0" onclick="document.getElementById('nic_file').click();">Upload Document</button>
                        <?php } else {?>
                          <button type="button" class="btn btn-outline-primary btn-sm mb-0" onclick="window.open('files/nic.pdf')">View Document</button>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card card-blog card-plain">
                    <div class="card-body p-3">
                      <h5>Others</h5>
                      <p class="mb-4 text-sm">
                        <?php echo $filename_other; ?>
                      </p>
                      <div class="d-flex align-items-center justify-content-between">
                        <?php if($edit){ ?>
                          <input type="file" id="other_file" style="display:none">
                          <button type="button" class="btn btn-outline-primary btn-sm mb-0" onclick="document.getElementById('other_file').click();">Upload Document</button>
                        <?php } else {?>
                          <button type="button" class="btn btn-outline-primary btn-sm mb-0" onclick="window.open('files/other.pdf')">View Document</button>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
    function update(){
      var user_designation = $('#user_designation').val();
      var user_mobile = $('#user_mobile').val();
      var user_industry = $('#user_industry').val();
      var user_highest_education = $('#user_highest_education').val();
      var user_expected_salary = $('#user_expected_salary').val();
      var user_address = $('#user_address').val();
      var user_nic = $('#user_nic').val();
      var user_dob = $('#user_dob').val();
      var user_country = $('#user_country').val();
      var user_postcode = $('#user_postcode').val();
      var user_city = $('#user_city').val();
      var user_about = $('#user_about').val();
      var user_skill1 = $('#user_skill1').val();
      var user_skill2 = $('#user_skill2').val();
      var user_skill3 = $('#user_skill3').val();

      $.ajax({
            url:"assets/php/update_profiles.php",
            type: "post",
            data: {"func": "update", "userid": <?php echo $userid; ?>, "user_designation": user_designation, "user_mobile": user_mobile, "user_industry": user_industry, "user_highest_education": user_highest_education, "user_expected_salary": user_expected_salary, "user_address": user_address, "user_nic": user_nic, "user_dob": user_dob, "user_country": user_country, "user_postcode": user_postcode, "user_city": user_city, "user_about": user_about, "user_skill1": user_skill1, "user_skill2": user_skill2, "user_skill3": user_skill3},
            success:function(response){
                console.log("Resss: "+response);
                if(response == "success"){
                  window.location.replace("profile.php");
                }
            },
            error: function (jqXHR, exception) {
                alert("Error");
            }
        });
      }
      
    function approval(func, user_id){
      $.ajax({
            url:"assets/php/update_profiles.php",
            type: "post",
            data: {"func": func, "userid": user_id},
            success:function(response){
                console.log("Resss: "+response);
                if(response == "success"){
                  window.location.replace("profile.php?user="+user_id);
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