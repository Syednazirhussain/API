<script src="../controller/jquery-2.1.4.min.js"></script>
<script src="../controller/script.js"></script>
<?php include('../View/Layout/header.php'); ?>
        <div class="page">
            <div class="content">
                    <form id="login">
                        <div class="container">
                            <label><b>User Name</b></label>
                            <input id="username" type="text" placeholder="Enter username here" name="username" required>
                            <label><b>Email</b></label>
                            <input id="password" type="password" placeholder="Enter password here" name="password" required>
                            <div class="clearfix">
                                <button type="submit" name="submit" class="signupbtn">Login</button>
                            </div>
                            <h1 style="text-align: center;float: left" id="status"></h1>
                        </div>
                    </form>
            </div>
        </div>
<?php include('../View/Layout/footer.php'); ?>

