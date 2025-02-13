<?php
include '../partials/header.php';
require_once '../partials/check_if_no_session_exists.php';
include_once '../databases/db_medical_facility.php';
include_once '../classes/cl_user.php';

$db = new db_medical_facility();
$dbase = $db->getConnection();
$personal_information = new cl_user($dbase);
$obtained_personal_information = $personal_information->readPersonalInformation($user['user_id']);

if (isset($_POST['createPersonalInformationButton'])) {
    $personal_information->image_url = $_POST['image_url'];
    $personal_information->given_name = $_POST['given_name'];
    $personal_information->middle_name = $_POST['middle_name'];
    $personal_information->last_name = $_POST['last_name'];
    $personal_information->suffix_name = $_POST['suffix_name'];
    $personal_information->sex = $_POST['sex'];
    $personal_information->date_of_birth = $_POST['date_of_birth'];
    $personal_information->place_of_birth = $_POST['place_of_birth'];
    $personal_information->civil_status = $_POST['civil_status'];
    $personal_information->employment_status = $_POST['employment_status'];
    $personal_information->religion = $_POST['religion'];
    $personal_information->nationality = $_POST['nationality'];
    $personal_information->user_id = $user['user_id'];
    $personal_information->createPersonalInformation();
}

if (isset($_POST['updatePersonalInformationButton'])) {
    $personal_information->personal_information_id = $_POST['update_personal_information_id'];
    $personal_information->image_url = $_POST['update_image_url'];
    $personal_information->given_name = $_POST['update_given_name'];
    $personal_information->middle_name = $_POST['update_middle_name'];
    $personal_information->last_name = $_POST['update_last_name'];
    $personal_information->suffix_name = $_POST['update_suffix_name'];
    $personal_information->sex = $_POST['update_sex'];
    $personal_information->date_of_birth = $_POST['update_date_of_birth'];
    $personal_information->place_of_birth = $_POST['update_place_of_birth'];
    $personal_information->civil_status = $_POST['update_civil_status'];
    $personal_information->employment_status = $_POST['update_employment_status'];
    $personal_information->religion = $_POST['update_religion'];
    $personal_information->nationality = $_POST['update_nationality'];
    
    $personal_information->updatePersonalInformation();
}
?>
<section>

    <?php include '../partials/menu.php' ?>

    <!-- PERSONAL INFORMATION -->
    <div class='p-2 bg-light'>
        <div class='d-flex flex-column w-100 p-2 align-items-center' style='height:80vh;'>
            <h2>Hi there!,</h2>
            <div class='w-50'>
                <p>We're glad you're here. Please come on in and let us know how we can assist you.
                    If you need any help or have any questions, don't hesitate to ask.
                    We're here to make your visit as comfortable and convenient as possible.</p>
            </div>
            <div class='w-75'>
                <h2 class='text-center'>Personal Information</h2>
                <?php
                if (is_array($obtained_personal_information) && !empty($obtained_personal_information)) {
                    if ($personal_information->isPersonalInformationExisting($user['user_id'])) {
                        echo "
                        <div class='d-flex justify-content-evenly align-items-center gap-1'>
                                <div class='d-flex justify-content-center align-items-center'>
                                    <img src='" . $obtained_personal_information['image_url'] . "' style='height:8rem;width:8rem; border:0.3rem solid black; border-radius: 100%;'/>
                                </div>
                                <div class='mt-5 d-flex flex-column gap-1'>
                                    <div class='d-flex justify-content-evenly'>
                                        <div class='d-flex gap-1'>
                                            <label>Given Name:</label>
                                            <strong class='text-decoration-underline'>" . $obtained_personal_information['given_name'] . "</strong>
                                        </div>
                                        <div class='d-flex gap-1'>
                                            <label>Middle Name:</label>
                                            <strong class='text-decoration-underline'>" . $obtained_personal_information['middle_name'] . "</strong>
                                        </div>
                                        <div class='d-flex gap-1'>
                                            <label>Last Name:</label>
                                            <strong class='text-decoration-underline'>" . $obtained_personal_information['last_name'] . "</strong>
                                        </div>
                                    </div>
        
                                    <div class='d-flex justify-content-evenly'>
                                        <div class='d-flex gap-1'>
                                            <label>Suffix Name:</label>
                                            <strong class='text-decoration-underline'>" . $obtained_personal_information['suffix_name'] . "</strong>
                                        </div>
                                        <div class='d-flex gap-1'>
                                            <label>Sex:</label>
                                            <strong class='text-decoration-underline'>" . $obtained_personal_information['sex'] . "</strong>
                                        </div>
                                        <div class='d-flex gap-1'>
                                            <label>Date of Birth:</label>
                                            <strong class='text-decoration-underline'>" . $obtained_personal_information['date_of_birth'] . "</strong>
                                        </div>
                                    </div>
        
                                    <div class='d-flex justify-content-evenly'>
                                        <div class='d-flex gap-1'>
                                            <label>Place of Birth:</label>
                                            <strong class='text-decoration-underline'>" . $obtained_personal_information['place_of_birth'] . "</strong>
                                        </div>
                                        <div class='d-flex gap-1'>
                                            <label>Civil Status:</label>
                                            <strong class='text-decoration-underline'>" . $obtained_personal_information['civil_status'] . "</strong>
                                        </div>
                                        <div class='d-flex gap-1'>
                                            <label>Employement Status:</label>
                                            <strong class='text-decoration-underline'>" . $obtained_personal_information['employment_status'] . "</strong>
                                        </div>
                                    </div>
        
                                    <div class='d-flex justify-content-evenly'>
                                        <div class='d-flex gap-1'>
                                            <label>Religion:</label>
                                            <strong class='text-decoration-underline'>" . $obtained_personal_information['religion'] . "</strong>
                                        </div>
                                        <div class='d-flex gap-1'>
                                            <label>Nationality:</label>
                                            <strong class='text-decoration-underline'>" . $obtained_personal_information['nationality'] . "</strong>
                                        </div>
                                        <div class='d-flex gap-1'>
                                            <label>User Id:</label>
                                            <strong class='text-decoration-underline'>" . $obtained_personal_information['user_id'] . "</strong>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class='w-100 mt-3 d-flex justify-content-center align-items-center'>
                            <a href='#' id='edit-locator-slip' type='button' class='btn btn-sm' style='color:#FFF; background-color: #333;'
                                data-bs-toggle='modal' data-bs-target='#updatePersonalInformationModal' 
                                data-bs-toggle='tooltip' title='Update Record' 
                                data-row='" . htmlspecialchars(json_encode($obtained_personal_information, JSON_HEX_APOS | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8') . "'>
                                    <i class='fa-solid fa-edit fa-lg'></i>Update Personal Information
                            </a>
                        </div>          
                                ";
                    }
                } else {
                    echo "
                            <div class='d-flex flex-column justify-content-center'>
                                <p class='text-center'>Looks like you don't have any information yet. Click the button below to enter your personal information</p>
                                <button type='button' class='btn btn-sm' style='color:#FFF; background-color: #333;'
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
        <div class='modal-dialog modal-xl'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>Create Personal Information</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <form method='POST' autocomplete='false'>
                    <div class='modal-body'>
                        <div class='row'>
                            <div class='form-group col-md-12'>
                                <small class='font-weight-bold mt-1'>Image URL</small>
                                <input type='text' id='image-url' name='image_url' class='form-control form-control-sm'
                                    placeholder='Example: https://static.wikia.nocookie.net/spongebob/images/c/ca/Mermaid_Man_stock_art.png'
                                    />
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <small class='font-weight-bold mt-1'>Given Name</small>
                                <input type='text' id='given-name' name='given_name'
                                    class='form-control form-control-sm' placeholder='Example: Juan' required />
                            </div>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Middle Name</small>
                                <input type='text' id='middle-name' name='middle_name'
                                    class='form-control form-control-sm' placeholder='Example: Dela' required />
                            </div>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Last Name</small>
                                <input type='text' id='last-name' name='last_name' class='form-control form-control-sm'
                                    placeholder='Example: Cruz' required />
                            </div>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Suffix Name</small>
                                <input type='text' id='suffix-name' name='suffix_name'
                                    class='form-control form-control-sm' placeholder='Example: Jr., Sr. etc' />
                            </div>
                        </div>

                        <div class='row'>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Sex</small>
                                <select id='sex' name='sex' class='form-control form-control-sm'>
                                    <option value='Others'>Others</option>
                                    <option value='Male'>Male</option>
                                    <option value='Female'>Female</option>
                                </select>
                            </div>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Date of Birth</small>
                                <input id='date-of-birth' name='date_of_birth' type='date'
                                    class='form-control form-control-sm' />
                            </div>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Place of Birth</small>
                                <input type='text' id='place-of-birth' name='place_of_birth'
                                    class='form-control form-control-sm' placeholder='Example: Baguio City Benguet'
                                    required />
                            </div>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Civil Status</small>
                                <select id='civil-status' name='civil_status' class='form-control form-control-sm'>
                                    <option value='Single'>Single</option>
                                    <option value='Married'>Married</option>
                                    <option value='Separated'>Separated</option>
                                    <option value='Divorced'>Divorced</option>
                                    <option value='Not Applicable'>Not Applicable</option>
                                </select>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='form-group col-md-4'>
                                <small class='font-weight-bold mt-1'>Employment Status</small>
                                <select id='employment-status' name='employment_status'
                                    class='form-control form-control-sm'>
                                    <option value='Unemployed'>Unemployed</option>
                                    <option value='Employed'>Employed</option>
                                    <option value='Self Employed'>Self Employed</option>
                                </select>
                            </div>
                            <div class='form-group col-md-4'>
                                <small class='font-weight-bold mt-1'>Religion</small>
                                <input type='text' id='religion' name='religion' class='form-control form-control-sm'
                                    placeholder='Example: Roman Catholic' required />
                            </div>
                            <div class='form-group col-md-4'>
                                <small class='font-weight-bold mt-1'>Nationality</small>
                                <input type='text' id='nationality' name='nationality'
                                    class='form-control form-control-sm' placeholder='Example: Filipino' required />
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' class='btn btn-sm' name='createPersonalInformationButton'
                            style='color:#FFF; background-color: #333;'>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Personal Information -->
    <div class='modal fade' id='updatePersonalInformationModal' data-bs-backdrop='static' data-bs-keyboard='false'>
        <div class='modal-dialog modal-xl'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='exampleModalLabel'>Create Personal Information</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <form method='POST' autocomplete='false'>
                    <div class='modal-body'>
                        <div class='row'>
                            <div class="form-group col-md-6" hidden>
                                <small class="font-weight-bold mt-1">Personal Information Id</small>
                                <input id="update-personal-information-id" type="text" class="form-control form-control-sm" name="update_personal_information_id" readonly/>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='form-group col-md-12'>
                                <small class='font-weight-bold mt-1'>Image URL</small>
                                <input type='text' id='update-image-url' name='update_image_url' class='form-control form-control-sm'
                                    placeholder='Example: https://static.wikia.nocookie.net/spongebob/images/c/ca/Mermaid_Man_stock_art.png'
                                    />
                            </div>
                        </div>
                        <div class='row'>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Given Name</small>
                                <input type='text' id='update-given-name' name='update_given_name'
                                    class='form-control form-control-sm' placeholder='Example: Juan' required />
                            </div>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Middle Name</small>
                                <input type='text' id='update-middle-name' name='update_middle_name'
                                    class='form-control form-control-sm' placeholder='Example: Dela' required />
                            </div>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Last Name</small>
                                <input type='text' id='update-last-name' name='update_last_name' class='form-control form-control-sm'
                                    placeholder='Example: Cruz' required />
                            </div>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Suffix Name</small>
                                <input type='text' id='update-suffix-name' name='update_suffix_name'
                                    class='form-control form-control-sm' placeholder='Example: Jr., Sr. etc' />
                            </div>
                        </div>
                        <div class='row'>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Sex</small>
                                <select id='update-sex' name='update_sex' class='form-control form-control-sm'>
                                    <option value='Others'>Others</option>
                                    <option value='Male'>Male</option>
                                    <option value='Female'>Female</option>
                                </select>
                            </div>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Date of Birth</small>
                                <input id='update-date-of-birth' name='update_date_of_birth' type='date'
                                    class='form-control form-control-sm' />
                            </div>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Place of Birth</small>
                                <input type='text' id='update-place-of-birth' name='update_place_of_birth'
                                    class='form-control form-control-sm' placeholder='Example: Baguio City Benguet'
                                    required />
                            </div>
                            <div class='form-group col-md-3'>
                                <small class='font-weight-bold mt-1'>Civil Status</small>
                                <select id='update-civil-status' name='update_civil_status' class='form-control form-control-sm'>
                                    <option value='Single'>Single</option>
                                    <option value='Married'>Married</option>
                                    <option value='Separated'>Separated</option>
                                    <option value='Divorced'>Divorced</option>
                                    <option value='Not Applicable'>Not Applicable</option>
                                </select>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='form-group col-md-4'>
                                <small class='font-weight-bold mt-1'>Employment Status</small>
                                <select id='update-employment-status' name='update_employment_status'
                                    class='form-control form-control-sm'>
                                    <option value='Unemployed'>Unemployed</option>
                                    <option value='Employed'>Employed</option>
                                    <option value='Self Employed'>Self Employed</option>
                                </select>
                            </div>
                            <div class='form-group col-md-4'>
                                <small class='font-weight-bold mt-1'>Religion</small>
                                <input type='text' id='update-religion' name='update_religion' class='form-control form-control-sm'
                                    placeholder='Example: Roman Catholic' required />
                            </div>
                            <div class='form-group col-md-4'>
                                <small class='font-weight-bold mt-1'>Nationality</small>
                                <input type='text' id='update-nationality' name='update_nationality'
                                    class='form-control form-control-sm' placeholder='Example: Filipino' required />
                            </div>
                        </div>
                    </div>
                    <div class='modal-footer'>
                        <button type='submit' class='btn btn-sm' name='updatePersonalInformationButton'
                            style='color:#FFF; background-color: #333;'>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>


<script>
    $(document).ready(function(){
    // Update locator slip by user when modal is triggered
        $('#updatePersonalInformationModal').on('show.bs.modal', function (e){
            var rowData = $(e.relatedTarget).data('row'); // Get the JSON data from the link
            // Assign values to modal fields
            $('#update-personal-information-id').val(rowData.personal_information_id);
            $('#update-image-url').val(rowData.image_url);
            $('#update-given-name').val(rowData.given_name);
            $('#update-middle-name').val(rowData.middle_name);
            $('#update-last-name').val(rowData.last_name);
            $('#update-suffix-name').val(rowData.suffix_name);
            $('#update-sex').val(rowData.sex);
            $('#update-date-of-birth').val(rowData.date_of_birth);
            $('#update-place-of-birth').val(rowData.place_of_birth);
            $('#update-civil-status').val(rowData.civil_status);
            $('#update-employment-status').val(rowData.employment_status);
            $('#update-religion').val(rowData.religion);
            $('#update-nationality').val(rowData.nationality);
        });
    });
</script>
<?php include '../partials/footer.php'; ?>