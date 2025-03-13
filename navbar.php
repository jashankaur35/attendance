<section>
<!-- Sidebar -->
    <div class="sidebar">
        <h3>Menu</h3>
        <a href="#" class="option">📋 Attendance</a>
        <a href="#" class="option">📂 Work</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard">
            <div class="date-time">
                Date:
                <span id="date"><?php
                    echo date("d-M-Y");
                ?></span> Time: <span id="time"><?php echo date("h:i:s"); ?></span>
            </div>
            <div class="heading">
            <?php
                echo strtoupper(date('F'))." MONTH";
            ?>
            </div>
            <p>Welcome </p>
            <?php
                include("upload.php");
            ?>
        </div>
    </div>
</section>


</body>
</html>









