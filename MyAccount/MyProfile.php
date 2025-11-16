<!--header end-->
<?php
$externalCss = "
<style>
    /* Professional Modern UI */

    .profile-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: #fff;
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        margin-bottom: 30px;
    }

    .profile-picture img {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        border: 5px solid #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        object-fit: cover;
    }

    .card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    }

    .card-title {
        font-weight: 600;
        font-size: 1.2rem;
    }

    .activity-list li {
        padding: 12px 0;
        border-bottom: 1px solid #eee;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
    }

    .activity-list li i {
        font-size: 1.2rem;
        margin-right: 10px;
    }

    .btn-custom {
        width: 48%;
    }

    .setting-label {
        font-weight: 600;
        color: #444;
    }
</style>";

require '../db/config.php';
require '../includes/auth.php';
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';
?>

<section class="wrapper">
    <div class="container">

        <!-- Profile Header Section -->
        <div class="profile-header shadow-sm">
            <div class="profile-picture mb-3">
                <img src="../images/2.png" alt="User Image">
            </div>
            <h3 class="mb-0"><?=$_SESSION['user_name']?></h3>
            <p class="mb-1" style="opacity: 0.9;">New York, USA</p>
            <p>Email: <?=$_SESSION['user_email']?></p>
        </div>


        <div class="row">
            <!-- Left: Personal Info -->
            <div class="col-lg-4 mb-4">
                <div class="card p-3">
                    <h5 class="card-title">Profile Information</h5>
                    <hr>
                    <p class="mb-2"><strong>Name:</strong><br> <?=$_SESSION['user_name']?></p>
                    <p class="mb-2"><strong>Email:</strong><br> <?=$_SESSION['user_email']?></p>
                    <p><strong>Location:</strong><br> New York, USA</p>
                </div>
            </div>

            <!-- Right: Activity & Settings -->
            <div class="col-lg-8">

                <!-- Recent Activity -->
                <div class="card p-3 mb-4">
                    <h5 class="card-title">Recent Activity</h5>
                    <ul class="list-unstyled activity-list">
                        <li><i class="fa fa-check-circle text-success"></i> Logged in at 10:30 AM</li>
                        <li><i class="fa fa-image text-info"></i> Updated profile picture</li>
                        <li><i class="fa fa-pencil-alt text-warning"></i> Changed email address</li>
                    </ul>
                </div>

                <!-- Settings -->
                <div class="card p-3">
                    <h5 class="card-title">Account Settings</h5>

                    <div class="mb-3">
                        <span class="setting-label">Password:</span><br>
                        ********
                    </div>

                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary btn-custom">Change Password</button>
                        <button class="btn btn-outline-secondary btn-custom">Update Info</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<?php
include '../includes/footer.php';
?>
