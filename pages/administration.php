<?php
include '../partials/header.php';
require_once '../partials/check_if_no_session_exists.php';
include_once '../databases/db_medical_facility.php';
include_once '../classes/cl_user.php';
include '../php_functions/php_functions_common.php';

$db = new db_medical_facility();
$dbase = $db->getConnection();
$statement = new cl_user($dbase);
$users_list = $statement->readUsers();
$patient_list = $statement->readAllPersonalInformation();

if (isset($_POST['createPersonalInformationButton'])) {
    $statement->image_url = $_POST['image_url'];
    $statement->given_name = $_POST['given_name'];
    $statement->middle_name = $_POST['middle_name'];
    $statement->last_name = $_POST['last_name'];
    $statement->suffix_name = $_POST['suffix_name'];
    $statement->sex = $_POST['sex'];
    $statement->date_of_birth = $_POST['date_of_birth'];
    $statement->place_of_birth = $_POST['place_of_birth'];
    $statement->civil_status = $_POST['civil_status'];
    $statement->employment_status = $_POST['employment_status'];
    $statement->religion = $_POST['religion'];
    $statement->nationality = $_POST['nationality'];

    $statement->createPersonalInformation();
}

if (isset($_POST['updatePersonalInformationButton'])) {
    $statement->personal_information_id = $_POST['update_personal_information_id'];
    $statement->image_url = $_POST['update_image_url'];
    $statement->given_name = $_POST['update_given_name'];
    $statement->middle_name = $_POST['update_middle_name'];
    $statement->last_name = $_POST['update_last_name'];
    $statement->suffix_name = $_POST['update_suffix_name'];
    $statement->sex = $_POST['update_sex'];
    $statement->date_of_birth = $_POST['update_date_of_birth'];
    $statement->place_of_birth = $_POST['update_place_of_birth'];
    $statement->civil_status = $_POST['update_civil_status'];
    $statement->employment_status = $_POST['update_employment_status'];
    $statement->religion = $_POST['update_religion'];
    $statement->nationality = $_POST['update_nationality'];
    $statement->user_id = $_POST['update_user_id'];

    if ($statement->isUserIdExists($_POST['update_user_id'])) {
        $statement->updatePersonalInformation('administration.php');
    } else {
        echo "
            <script>
            let timerInterval;
            Swal.fire({
                icon: 'warning',
                html:
                    '<span>Updating Failed! Make sure the User Id exists!</span>',
                    showConfirmButton: false,
                    timer: 5000
            }).then(function() {
                window.location.href='administration.php';
            });
            </script>";
    }

}

?>
<section>
    <?php include '../partials/menu.php' ?>

    <div class='m-2 d-flex justify-content-end gap-1'>
        <button type='button' class='btn btn-sm border border-dark' style='color:#333; background-color: #fff;'
            data-bs-toggle='modal' data-bs-target='#seeListOfUsers'>
            <i class='fa fa-eye'></i> See List of Users
        </button>
        <button type='button' class='btn btn-sm' style='color:#FFF; background-color: #333;' data-bs-toggle='modal'
            data-bs-target='#createPersonalInformationModal'>
            <i class='fa fa-add'></i> Add Patient Record
        </button>
    </div>
    <div class="d-flex justify-content-center">
        <h2>Patients List</h2>
    </div>
    <div id='itemTableContainer' class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped display nowrap" id="itemTable" width="100%"
                cellspacing="0">
                <thead>
                    <tr>
                        <th class="align-middle text-center">Create At</th>
                        <th class="align-middle text-center">Image</th>
                        <th class="align-middle text-center">Full Name</th>
                        <th class="align-middle text-center">Sex</th>
                        <th class="align-middle text-center">Date of Birth</th>
                        <th class="align-middle text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($patient_list as $row) {
                        echo "<tr>                                                                                                                                                                                                                                                                         
                                        <td class='align-middle text-center'>" . displayDate($row['created_at']) . "</td>
                                        <td class='align-middle text-center'>
                                            <img src='" . $row['image_url'] . "'
                                                style='height:3rem;width:3rem; border:0.1rem solid black; border-radius: 100%;'
                                            />
                                        </td>                                                                    
                                        <td class='align-middle text-center'>" . $row['full_name'] . "</td>                                                                                                                                                                                                           
                                        <td class='align-middle text-center'>" . $row['sex'] . "</td>                                        
                                        <td class='align-middle text-center'>" . displayDate($row['date_of_birth']) . "</td>                                                                                                                                                                                                                                                                       
                                        <td class='align-middle text-center'>
                                            <div class='d-flex flex-column'>
                                                <a href='#' id='update-personal-information-modal' type='button' class='btn btn-sm' style='color:#FFF; background-color: #333;'
                                                    data-bs-toggle='modal' data-bs-target='#updatePersonalInformationModal' 
                                                    data-bs-toggle='tooltip' title='Update Record' 
                                                    data-row='" . htmlspecialchars(json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8') . "'>
                                                    <i class='fa-solid fa-eye fa-lg'></i>View
                                                </a>                                                
                                            </div>
                                        </td>                
                                    </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>


<!-- Create Patient Personal Information -->
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
                                placeholder='Example: https://static.wikia.nocookie.net/spongebob/images/c/ca/Mermaid_Man_stock_art.png' />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-3">
                            <small class='font-weight-bold mt-1'>Given Name</small>
                            <input type='text' id='given-name' name='given_name' class='form-control form-control-sm'
                                placeholder='Example: Juan' required />
                        </div>
                        <div class='form-group col-md-3'>
                            <small class='font-weight-bold mt-1'>Middle Name</small>
                            <input type='text' id='middle-name' name='middle_name' class='form-control form-control-sm'
                                placeholder='Example: Dela' required />
                        </div>
                        <div class='form-group col-md-3'>
                            <small class='font-weight-bold mt-1'>Last Name</small>
                            <input type='text' id='last-name' name='last_name' class='form-control form-control-sm'
                                placeholder='Example: Cruz' required />
                        </div>
                        <div class='form-group col-md-3'>
                            <small class='font-weight-bold mt-1'>Suffix Name</small>
                            <input type='text' id='suffix-name' name='suffix_name' class='form-control form-control-sm'
                                placeholder='Example: Jr., Sr. etc' />
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
                            <input type='text' id='nationality' name='nationality' class='form-control form-control-sm'
                                placeholder='Example: Filipino' required />
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
                <h1 class='modal-title fs-5' id='exampleModalLabel'>Update Personal Information</h1>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <form method='POST' autocomplete='false'>
                <div class='modal-body'>
                    <div class='row'>
                        <div class="form-group col-md-6" hidden>
                            <small class="font-weight-bold mt-1">Personal Information Id</small>
                            <input id="update-personal-information-id" type="text" class="form-control form-control-sm"
                                name="update_personal_information_id" readonly />
                        </div>
                    </div>
                    <div class='row'>
                        <div class='form-group col-md-12 d-flex justify-content-center'>
                            <img id='img-element'
                                style='height:8rem;width:8rem; border:0.3rem solid black; border-radius: 100%;' />
                        </div>
                    </div>
                    <div class='row'>
                        <div class='form-group col-md-12'>
                            <small class='font-weight-bold mt-1'>Image URL</small>
                            <input type='text' id='update-image-url' name='update_image_url'
                                class='form-control form-control-sm'
                                placeholder='Example: https://static.wikia.nocookie.net/spongebob/images/c/ca/Mermaid_Man_stock_art.png' />
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
                            <input type='text' id='update-last-name' name='update_last_name'
                                class='form-control form-control-sm' placeholder='Example: Cruz' required />
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
                            <select id='update-civil-status' name='update_civil_status'
                                class='form-control form-control-sm'>
                                <option value='Single'>Single</option>
                                <option value='Married'>Married</option>
                                <option value='Separated'>Separated</option>
                                <option value='Divorced'>Divorced</option>
                                <option value='Not Applicable'>Not Applicable</option>
                            </select>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='form-group col-md-3'>
                            <small class='font-weight-bold mt-1'>Employment Status</small>
                            <select id='update-employment-status' name='update_employment_status'
                                class='form-control form-control-sm'>
                                <option value='Unemployed'>Unemployed</option>
                                <option value='Employed'>Employed</option>
                                <option value='Self Employed'>Self Employed</option>
                            </select>
                        </div>
                        <div class='form-group col-md-3'>
                            <small class='font-weight-bold mt-1'>Religion</small>
                            <input type='text' id='update-religion' name='update_religion'
                                class='form-control form-control-sm' placeholder='Example: Roman Catholic' required />
                        </div>
                        <div class='form-group col-md-3'>
                            <small class='font-weight-bold mt-1'>Nationality</small>
                            <input type='text' id='update-nationality' name='update_nationality'
                                class='form-control form-control-sm' placeholder='Example: Filipino' required />
                        </div>
                        <div class='form-group col-md-3'>
                            <small class='font-weight-bold mt-1'>User Id</small>
                            <input type='number' id='update-user-id' name='update_user_id'
                                class='form-control form-control-sm' placeholder='Example: 456' required />
                        </div>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='submit' class='btn btn-sm' name='updatePersonalInformationButton'
                        style='color:#FFF; background-color: #333;'>Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class='modal fade' id='seeListOfUsers' data-bs-backdrop='static' data-bs-keyboard='false'>
    <div class='modal-dialog modal-md'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h1 class='modal-title fs-5' id='exampleModalLabel'>List of Registered Users</h1>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped display nowrap" id="itemTable" width="100%"
                        cellspacing="0">
                        <thead>
                            <tr>
                                <th class="align-middle text-center">Create At</th>
                                <th class="align-middle text-center">User ID</th>
                                <th class="align-middle text-center">Username</th>
                                <th class="align-middle text-center">Status</th>
                                <th class="align-middle text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users_list as $row) {
                                echo "<tr>                                                                                                                                                                                                                                                                         
                                        <td class='align-middle text-center'>" . displayDate($row['created_at']) . "</td>                                                                
                                        <td class='align-middle text-center'>" . $row['user_id'] . "</td>                                                                                                                                                                                                           
                                        <td class='align-middle text-center'>" . $row['username'] . "</td>                                        
                                        <td class='align-middle text-center'>" . $row['is_active'] . "</td>                                        
                                        <td class='align-middle text-center'>
                                            <div class='d-flex flex-column'>
                                                <a href='#' id='update-personal-information-modal' type='button' class='btn btn-sm' style='color:white; background-color: maroon;'
                                                    data-bs-toggle='modal' data-bs-target='#updatePersonalInformationModal' 
                                                    data-bs-toggle='tooltip' title='Update Record' 
                                                    data-row='" . htmlspecialchars(json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8') . "'>
                                                    <i class='fa-solid fa-trash fa-lg'></i>Archive
                                                </a>                                                
                                            </div>
                                        </td>                
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // DATA TABLE
    $(document).ready(function () {
        var table = $("#itemTable").DataTable({
            pagingType: 'full_numbers',
            scrollX: true,
            order: [],
            lengthMenu: [
                [10, 50, 100, 250, -1],
                [10, 50, 100, 250, 'All'],
            ],
            columnDefs:
                [
                    {
                        targets: [0, 1, 2, 3, 4, 5],
                        orderable: true
                    }
                ],
        });
    });

    // Update Record
    $(document).ready(function () {
        // Update locator slip by user when modal is triggered
        $('#updatePersonalInformationModal').on('show.bs.modal', function (e) {
            var rowData = $(e.relatedTarget).data('row'); // Get the JSON data from the link
            // Assign values to modal fields
            $('#update-personal-information-id').val(rowData.personal_information_id);
            $('#img-element').attr('src', rowData.image_url);
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
            $('#update-user-id').val(rowData.user_id);
        });
    });
</script>

<?php include '../partials/footer.php'; ?>