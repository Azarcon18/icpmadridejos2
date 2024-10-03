<?php
require_once('../../config.php');

// Check if ID is set in GET request
if (isset($_GET['id']) && $_GET['id'] > 0) {
    // Fetch wedding request from the database
    $qry = $conn->query("SELECT r.*, t.sched_type FROM `wedding_request` r 
                         INNER JOIN `schedule_type` t ON r.sched_type_id = t.id 
                         WHERE r.id = '{$_GET['id']}'");
    
    // Check if a record was found
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v; // Dynamically create variables from the fetched row
        }
    }
}
?>

<div class="container-fluid">
    <form action="" id="wedding-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <input type="hidden" name="sched_type_id" value="<?php echo isset($sched_type_id) ? $sched_type_id : '' ?>">
        <div class="col-12">
            <h4>Request For: <?php echo isset($sched_type) ? $sched_type : '' ?></h4><br>
            <div class="row">
                <div class="col-md-6">
                    <!-- Husband's Fullname -->
                    <p><strong>Husband</strong></p>
                    <div class="form-group">
                        <label for="husband_fname" class="control-label">First Name</label>
                        <input type="text" name="husband_fname" id="husband_fname" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="husband_mname" class="control-label">Middle Name</label>
                        <input type="text" name="husband_mname" id="husband_mname" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="husband_lname" class="control-label">Last Name</label>
                        <input type="text" name="husband_lname" id="husband_lname" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
            <label for="birthdate1" class="control-label">Birthdate</label>
            <input type="date" name="birthdate1" id="birthdate1" class="form-control rounded-0" required onchange="calculateAge('birthdate1', 'age')">
        </div>
        <div class="form-group">
            <label for="age" class="control-label">Age</label>
            <input type="number" name="age" id="age" class="form-control rounded-0" readonly>
        </div>
                    <div class="form-group">
                        <label for="birthplace" class="control-label">Place of Birth</label>
                        <input type="text" name="birthplace" id="birthplace" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                    <label for="gender" class="control-label">Sex/Gender</label>
                    <select name="gender" id="gender" class="form-control rounded-0" required>
                        <option value="">Select Sex/Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="non-binary">Non-binary</option>
                        <option value="other">Other</option>
                        <option value="prefer-not-to-say">Prefer not to say</option>
                    </select>
                </div>
                    <div class="form-group">
                        <label for="citizenship" class="control-label">Citizenship</label>
                        <input type="text" name="citizenship" id="citizenship" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class="control-label">Residence</label>
                        <textarea name="address" id="address" class="form-control rounded-0" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="civil_status" class="control-label">Civil Status</label>
                        <input type="text" name="civil_status" id="civil_status" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="father_name" class="control-label">Father Name</label>
                        <input type="text" name="father_name" id="father_name" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="fcitizenship" class="control-label">Citizenship</label>
                        <input type="text" name="fcitizenship" id="fcitizenship" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="mother_name" class="control-label">Mother Name</label>
                        <input type="text" name="mother_name" id="mother_name" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="mcitizenship" class="control-label">Citizenship</label>
                        <input type="text" name="mcitizenship" id="mcitizenship" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="advice" class="control-label">Name of a Persons Was Who Given Consent or Advice</label>
                        <input type="text" name="advice" id="advice" class="form-control rounded-0" required>
                        <span class="ml-2 text-muted">* Enter N/A if not applicable</span>
                    </div>
                    <div class="form-group">
                        <label for="relationship" class="control-label">Relationship</label>
                        <input type="text" name="relationship" id="relationship" class="form-control rounded-0" required>
                        <span class="ml-2 text-muted">* Enter N/A if not applicable</span>
                    </div>
                    <div class="form-group">
                        <label for="residence" class="control-label">Residence</label>
                        <textarea name="residence" id="residence" class="form-control rounded-0" required></textarea>
                        <span class="ml-2 text-muted">* Enter N/A if not applicable</span>
                    </div>
                </div>
                    <!-- Wife's Fullname -->
                    <div class="col-md-6">
                        <p><strong>Wife</strong></p>
                    <div class="form-group">
                        <label for="wife_fname" class="control-label">First Name</label>
                        <input type="text" name="wife_fname" id="wife_fname" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="wife_mname" class="control-label">Middle Name</label>
                        <input type="text" name="wife_mname" id="wife_mname" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="wife_lname" class="control-label">Last Name</label>
                        <input type="text" name="wife_lname" id="wife_lname" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
            <label for="wife_birthdate" class="control-label">Birthdate</label>
            <input type="date" name="wife_birthdate" id="wife_birthdate" class="form-control rounded-0" required onchange="calculateAge('wife_birthdate', 'wife_age')">
        </div>
        <div class="form-group">
            <label for="wife_age" class="control-label">Age</label>
            <input type="number" name="wife_age" id="wife_age" class="form-control rounded-0" readonly>
        </div>
                    <div class="form-group">
                        <label for="wife_birthplace" class="control-label">Place of Birth</label>
                        <input type="text" name="wife_birthplace" id="wife_birthplace" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                    <label for="wife_gender" class="control-label">Sex/Gender</label>
                    <select name="wife_gender" id="wife_gender" class="form-control rounded-0" required>
                        <option value="">Select Sex/Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="non-binary">Non-binary</option>
                        <option value="other">Other</option>
                        <option value="prefer-not-to-say">Prefer not to say</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="wife_citizenship" class="control-label">Citizenship</label>
                        <input type="text" name="wife_citizenship" id="wife_citizenship" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="wife_address" class="control-label">Residence</label>
                        <textarea name="wife_address" id="wife_address" class="form-control rounded-0" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="wife_civil_status" class="control-label">Civil Status</label>
                        <input type="text" name="wife_civil_status" id="wife_civil_status" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="wife_father_name" class="control-label">Father Name</label>
                        <input type="text" name="wife_father_name" id="wife_father_name" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="wife_fcitizenship" class="control-label">Citizenship</label>
                        <input type="text" name="wife_fcitizenship" id="wife_fcitizenship" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="wife_mother_name" class="control-label">Mother Name</label>
                        <input type="text" name="wife_mother_name" id="wife_mother_name" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="wife_mcitizenship" class="control-label">Citizenship</label>
                        <input type="text" name="wife_mcitizenship" id="wife_mcitizenship" class="form-control rounded-0" required>
                    </div>
                    <div class="form-group">
                        <label for="wife_advice" class="control-label">Name of a Persons Was Who Given Consent or Advice</label>
                        <input type="text" name="wife_advice" id="wife_advice" class="form-control rounded-0" required>
                        <span class="ml-2 text-muted">* Enter N/A if not applicable</span>
                    </div>
                    <div class="form-group">
                        <label for="wife_relationship" class="control-label">Relationship</label>
                        <input type="text" name="wife_relationship" id="wife_relationship" class="form-control rounded-0" required>
                        <span class="ml-2 text-muted">* Enter N/A if not applicable</span>
                    </div>
                    <div class="form-group">
                        <label for="wife_residence" class="control-label">Residence</label>
                        <textarea name="wife_residence" id="wife_residence" class="form-control rounded-0" required></textarea>
                        <span class="ml-2 text-muted">* Enter N/A if not applicable</span>
                    </div>
                </div>
</div>
                <div class="form-group">
                <p><strong>Place of Marriage</strong></p>
                        <textarea name="place_of_marriage1" id="place_of_marriage1" class="form-control rounded-0" required></textarea>
                        <label for="place_of_marriage1" class="control-label">(Office of the/ House of/ Barangay of/ Church of/ Mosque of)</label>
                        <textarea name="place_of_marriage2" id="place_of_marriage2" class="form-control rounded-0" required></textarea>
                        <label for="place_of_marriage2" class="control-label">(City/Municipality)</label>
                        <textarea name="place_of_marriage3" id="place_of_marriage3" class="form-control rounded-0" required></textarea>
                        <label for="place_of_marriage3" class="control-label">(Province)</label>
                </div>
                <div class="form-group">
                        <label for="date_of_marriage" class="control-label">Date of Marriage</label>
                        <input type="date" name="date_of_marriage" id="date_of_marriage" class="form-control rounded-0" required>
                        <span class="ml-2 text-muted">(Day)  (Month)  (Year)</span>
                    </div>
                <div class="form-group">
                        <label for="time_of_marriage" class="control-label">Time of Marriage</label>
                        <input type="time" name="time_of_marriage" id="time_of_marriage" class="form-control rounded-0" required>
                        <span class="ml-2 text-muted">(AM / PM)</span>
                </div>
                <div class="form-group">
                        <label for="marriage_license_no" class="control-label">Marriage License No.</label>
                        <input type="text" name="marriage_license_no" id="marriage_license_no" class="form-control rounded-0" readonly>
                </div>
                    </div>
                    <!-- Status -->
        <div class="form-group">
            <label for="status" class="control-label">Status</label>
            <select name="status" id="status" class="custom-select custom-select-sm rounded-0" required>
                <option value="0" <?php echo (isset($status) && $status == 0) ? "selected" : "" ?>>Pending</option>
                <option value="1" <?php echo (isset($status) && $status == 1) ? "selected" : "" ?>>Confirmed</option>
                <option value="2" <?php echo (isset($status) && $status == 2) ? "selected" : "" ?>>Cancelled</option>
            </select>
        </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(function() {
        $('#wedding-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this);
            $('.err-msg').remove();
            start_loader();

            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_wedding_req",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                dataType: 'json',
                error: function(err) {
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();
                },
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.reload();
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var el = $('<div>')
                            .addClass("alert alert-danger err-msg")
                            .text(resp.msg);
                        _this.prepend(el);
                        el.show('slow');
                        $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                        end_loader();
                    } else {
                        alert_toast("An error occurred", 'error');
                        end_loader();
                        console.log(resp);
                    }
                }
            });
        });
    });
</script>
<script>
function calculateAge(birthdateId, ageId) {
    var birthdate = new Date(document.getElementById(birthdateId).value);
    var today = new Date();
    var age = today.getFullYear() - birthdate.getFullYear();
    var monthDiff = today.getMonth() - birthdate.getMonth();
    
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
        age--;
    }
    
    document.getElementById(ageId).value = age;
}
</script>

<script>
        function generateLicenseNumber() {
            // Generate a simple license number: current timestamp + random number
            const timestamp = new Date().getTime();
            const randomNumber = Math.floor(Math.random() * 1000);  // Add a random 3-digit number
            const licenseNo = `ML-${timestamp}-${randomNumber}`;

            // Set the value of the Marriage License No. input
            document.getElementById("marriage_license_no").value = licenseNo;
        }

        window.onload = generateLicenseNumber;
    </script>