<?php 
    include '../partials/header.php';
    require_once '../partials/check_if_no_session_exists.php';
?>
<section>
    <?php include '../partials/menu.php'?>
    <div class="p-2">
        <div class="d-flex flex-column gap-2 bg-light">
            <h2>Dashboard</h2>
            <p>Hospitals today are facing a multitude of challenges, 
                from maintaining continuous operations and keeping patients safe, 
                to ensuring their data is secure and managing the financial aspects 
                of providing care. One of the top hospitals in the Philippines, for instance, 
                is the Perpetual Help Medical Center – Las Pinas, which has been providing excellent 
                healthcare services for 45 years. Other notable hospitals include St. Luke’s Medical Center, 
                Asian Hospital and Medical Center, and Makati Medical Center, which are all recognized 
                for their high-quality care and advanced medical technology</p>
            <p>In terms of the challenges hospitals are facing, cybersecurity is a major concern, 
                with the healthcare industry being especially susceptible to cyberattacks due to the 
                volume of personally identifiable information and protected health information they store. 
                In fact, research has shown that 60% of healthcare organizations have been hit with ransomware 
                attacks in the past 12 months, and the cost of mitigating a data breach can be as high as $10 million</p>
        </div>
    </div>
</section>

<?php include '../partials/footer.php';?>