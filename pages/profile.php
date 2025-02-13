<?php
include '../partials/header.php';
require_once '../partials/check_if_no_session_exists.php';
include_once '../databases/db_medical_facility.php';
include_once '../classes/cl_user.php';

$db = new db_medical_facility();
$dbase = $db->getConnection();
$personal_information = new cl_user($dbase);

if (isset($_POST['createPersonalInformationButton'])) {
    $personal_information->given_name = $_POST['given_name'];
    $personal_information->middle_name = $_POST['middle_name'];
    $personal_information->last_name = $_POST['last_name'];
    $personal_information->suffix_name = $_POST['suffix_name'];
    $personal_information->sex = $_POST['sex'];
    $personal_information->date_of_birth = $_POST['date_of_birth'];
    $personal_information->civil_status = $_POST['civil_status'];
    $personal_information->employment_status = $_POST['employment_status'];
    $personal_information->religion = $_POST['religion'];
    $personal_information->nationality = $_POST['nationality'];
    $personal_information->user_id = $user['user_id'];
    $personal_information->createPersonalInformation();
}
?>
<section>

    <?php include '../partials/menu.php' ?>

    <!-- PERSONAL INFORMATION -->
    <div class='p-2 bg-light'>
        <h2>Personal Information</h2>
        <div class='d-flex w-100 p-2'>
            <div class='w-50'>
                <p>We're glad you're here. Please come on in and let us know how we can assist you.
                    If you need any help or have any questions, don't hesitate to ask.
                    We're here to make your visit as comfortable and convenient as possible.</p>
            </div>
            <div class='w-50'>
                <?php
                    if ($personal_information->isPersonalInformationExisting($user['user_id'])) {
                        echo "
                            <div class='d-flex gap-1'>
                                <label>Given Name:</label>
                                <input type='text'/>
                            </div>
                            <div class='d-flex gap-1'>
                                <label>Middle Name:</label>
                                <input type='text'/>
                            </div>
                            <div class='d-flex gap-1'>
                                <label>Last Name:</label>
                                <input type='text'/>
                            </div>
                            <div class='d-flex gap-1'>
                                <label>Suffix Name:</label>
                                <input type='text'/>
                            </div>
                            <div class='d-flex gap-1'>
                                <label>Sex:</label>
                                <input type='text'/>
                            </div>
                            <div class='d-flex gap-1'>
                                <label>Date of Birth:</label>
                                <input type='text'/>
                            </div>
                            <div class='d-flex gap-1'>
                                <label>Date of Birth:</label>
                                <input type='text'/>
                            </div>
                            <div class='d-flex gap-1'>
                                <label>Civil Status:</label>
                                <input type='text'/>
                            </div>
                            <div class='d-flex gap-1'>
                                <label>Employement Status:</label>
                                <input type='text'/>
                            </div>
                            <div class='d-flex gap-1'>
                                <label>Religion:</label>
                                <input type='text'/>
                            </div>
                            <div class='d-flex gap-1'>
                                <label>Nationality:</label>
                                <input type='text'/>
                            </div>
                            <div class='d-flex gap-1'>
                                <label>User Id:</label>
                                <input type='text'/>
                            </div>
                        ";
                        }else{
                            echo "
                                <div >
                                    <p>Looks like you don't have any information yet. Click the button below to enter your personal information</p>
                                    <button type='button' class='btn btn-sm' style='color:#FFF; background-color: #143601;'
                                        data-bs-toggle='modal' data-bs-target='#createPersonalInformationModal'>
                                        <i class='fa fa-add'></i> Enter Personal Information
                                    </button>
                                </div>
                            ";
                        }
                ?>
                

            </div>
        </div>
    </div>



    <!-- Create Personal Information -->
    <div class='modal fade' id='createPersonalInformationModal' data-bs-backdrop='static' data-bs-keyboard='false'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>Create Personal Information</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <form method='POST' autocomplete='false'>
                    <div class='modal-body'>
                        <div class='form-row'>
                            <div class='form-group col-md-12'>
                                <small class='font-weight-bold mt-1'>Given Name</small>
                                <input type='text' id='given-name' name='given_name'
                                    class='form-control form-control-sm' placeholder='Example: Juan' required />
                            </div>
                            <div class='form-group col-md-12'>
                                <small class='font-weight-bold mt-1'>Middle Name</small>
                                <input type='text' id='middle-name' name='middle_name'
                                    class='form-control form-control-sm' placeholder='Example: Dela' required />
                            </div>
                            <div class='form-group col-md-12'>
                                <small class='font-weight-bold mt-1'>Last Name</small>
                                <input type='text' id='last-name' name='last_name' class='form-control form-control-sm'
                                    placeholder='Example: Cruz' required />
                            </div>
                            <div class='form-group col-md-12'>
                                <small class='font-weight-bold mt-1'>Suffix Name</small>
                                <input type='text' id='suffix-name' name='suffix_name'
                                    class='form-control form-control-sm' placeholder='Example: Jr., Sr. etc' />
                            </div>
                            <div class='form-group col-md-12'>
                                <small class='font-weight-bold mt-1'>Sex</small>
                                <select id='sex' name='sex' class='form-control form-control-sm'>
                                    <option value='Others'>Others</option>
                                    <option value='Male'>Male</option>
                                    <option value='Female'>Female</option>
                                </select>
                            </div>
                            <div class='form-group col-md-12'>
                                <small class='font-weight-bold mt-1'>Date of Birth</small>
                                <input id='date-of-birth' name='date_of_birth' type='date'
                                    class='form-control form-control-sm' />
                            </div>
                            <div class='form-group col-md-12'>
                                <small class='font-weight-bold mt-1'>Place of Birth</small>
                                <input type='text' id='place-of-birth' name='place_of_birth'
                                    class='form-control form-control-sm' placeholder='Example: Baguio City Benguet'
                                    required />
                            </div>
                            <div class='form-group col-md-12'>
                                <small class='font-weight-bold mt-1'>Civil Status</small>
                                <select id='civil-status' name='civil_status' class='form-control form-control-sm'>
                                    <option value='Single'>Single</option>
                                    <option value='Married'>Married</option>
                                    <option value='Separated'>Separated</option>
                                    <option value='Divorced'>Divorced</option>
                                    <option value='Not Applicable'>Not Applicable</option>
                                </select>
                            </div>
                            <div class='form-group col-md-12'>
                                <small class='font-weight-bold mt-1'>Employment Status</small>
                                <select id='employment-status' name='employment_status'
                                    class='form-control form-control-sm'>
                                    <option value='Unemployed'>Unemployed</option>
                                    <option value='Employed'>Employed</option>
                                    <option value='Self Employed'>Self Employed</option>
                                </select>
                            </div>
                            <div class='form-group col-md-12'>
                                <small class='font-weight-bold mt-1'>Religion</small>
                                <input type='text' id='religion' name='religion' class='form-control form-control-sm'
                                    placeholder='Example: Roman Catholic' required />
                            </div>
                            <div class='form-group col-md-12'>
                                <small class='font-weight-bold mt-1'>Nationality</small>
                                <input type='text' id='nationality' name='nationality'
                                    class='form-control form-control-sm' placeholder='Example: Filipino' required />
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' class='btn btn-sm' name='createPersonalInformationButton'
                            style='color:#FFF; background-color: #143601;'>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include '../partials/footer.php'; ?>