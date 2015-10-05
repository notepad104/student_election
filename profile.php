<?php
    include "header.php";
    include "dbcon.php";
    session_start();
    if(!isset($_SESSION['login-user'])){
        header("location: index.php");
    }

    $voter_id = $_SESSION['login-user'];
    $query_users = mysql_query("SELECT * FROM users WHERE `roll_no` = '$voter_id'");
    $fetch_users = mysql_fetch_assoc($query_users);
    $voter_id = $fetch_users['user_id'];
    $role = $fetch_users['role'];
    $_SESSION['login-user-id'] = $voter_id;
    $_SESSION['view-profile'] = $voter_id;  
    $_SESSION['role'] = $role;

?>

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">IIITM Student Election</a>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#about">Polls</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Results</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                    <?php if($role == 'admin'){?>
                    <li>
                        <a class="page-scroll" href="admin.php">Admin</a>
                    </li>
                    <?php }?>
                    <li>
                        <a href="logout.php"><button class="btn btn-danger" href="logout.php">Logout</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="intro" class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Welcome to IIITM Student Election Portal</h1>
                    <p>Democracy cannot succeed unless those who express their choice are prepared to choose wisely. The real safeguard of democracy, therefore, are elections</p>
                    <a class="btn btn-success page-scroll" href="nominee_profile.php">View Profile</a>
                    <a class="btn btn-default page-scroll" href="#about">Start Voting!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Polls</h1>
                </div>
                <div class="col-lg-12">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <?php
                        $saari_query = mysql_query("SELECT * FROM `elections` as E 
                          join `election_users` as EU on E.election_id = EU.election_id 
                          join `users` as U on EU.user_id = U.user_id 
                          join `positions` as P on E.position_id = P.position_id
                          WHERE E.active = 1 AND U.role = 'student'");

                        $saari_rows = mysql_num_rows($saari_query)/4;
                        if($saari_rows == 0 )
                                 echo "<div><h3><small>No Active Polls</small></h3></div>";
                            else{
                    ?>
                          <!-- Indicators -->
                          <ol class="carousel-indicators">
                          <?php
                          
                            for($row = 0; $row < $saari_rows; $row++){
                                if($row == 0){
                                    echo "<li data-target='#myCarousel' data-slide-to='$row' class='active'></li>";
                                }
                                else{
                                    echo "<li data-target='#myCarousel' data-slide-to='$row'></li>";
                                }
                            }
                        ?>
                          </ol>

                          <!-- Wrapper for slides -->
                          <div class="carousel-inner" role="listbox">
                          <?php
                          
                          $i = 0;


                          while($iter = mysql_fetch_assoc($saari_query)){
                            
                            if($i == 0){
                                echo "<div class='item active'>";
                            }
                            else
                                echo "<div class='item'>";

                            $election_id = $iter['election_id'];    
                            
                            $check_vote = mysql_query("SELECT * FROM `vote2` WHERE `election_id` = $election_id AND `voter_id` = $voter_id");
                            $has_voted = mysql_num_rows($check_vote);
                            $nominee_id = -1;
                            if($has_voted == 1){
                                $nominee_id = mysql_fetch_assoc($check_vote)['nominee_id'];
                            }

                            //echo $iter['election_id'];
                            $en = $iter['election_name'];
                            $pn = $iter['position_name'];
                            $y = $iter['year'];
                            $current_nominee = $iter['user_id'];
                            echo "<h3>$en</h3>
                            <h4>Nominees for $pn
                                <small></small>
                                </h4>";
                            $fn = $iter['fname'];
                            $ln = $iter['lname'];
                            $b = $iter['bio'];
                            $election_users_id = $iter['election_users_id'];
                            echo "<form action = 'addVote.php' method = 'POST'>";
                            echo "<div class='col-lg-3 col-sm-4 text-center'>

                                    <h3>$fn $ln</h3>          
                                    <p>$b</p>
                                    <div class = 'form-group'><button class = 'btn btn-primary' name= 'view-profile' value='$current_nominee'>View Profile</button></div>";
                                    if($has_voted == 0){
                                    echo "<div class = 'form-group'>
                                    <button class = 'btn btn-success' name= 'vote_button' value=$election_users_id>Vote!!</button></div>
                                    </div>";
                                    }
                                    else{
                                        if($nominee_id == $iter['user_id']){
                                          echo "<div class = 'form-group'><button class = 'btn btn-warning' disabled>Voted!!</button></div>
                                          </div>";  
                                        }
                                        else
                                            echo "</div>";
                                    }

                                for($x =0; $x < 3; $x++){
                                    $iter = mysql_fetch_assoc($saari_query);
                                    
                                    $fn = $iter['fname'];
                                    $ln = $iter['lname'];
                                    $b = $iter['bio'];
                                    $current_nominee = $iter['user_id'];
                                    $election_users_id = $iter['election_users_id'];
                                    echo "<div class='col-lg-3 col-sm-4 text-center'>

                                    <h3>$fn $ln</h3>          
                                    <p>$b</p>";
                                    echo "<div class = 'form-group'><button class = 'btn btn-primary' name= 'view-profile' value='$current_nominee'>View Profile</button></div>";

                                    if($has_voted == 0){
                                    echo "<div class = 'form-group'><button type = 'submit' class = 'btn btn-success' name= 'vote_button' value= '$election_users_id'>Vote!!</button></div>
                                    </div>";
                                    }
                                    else{
                                        if($nominee_id == $iter['user_id']){
                                          echo "<div class = 'form-group'><button class = 'btn btn-warning' disabled>Voted!!</button></div>
                                          </div>";  
                                        }
                                        else
                                            echo "</div>";
                                    }
                                }
                            $i++;
                            echo "</div>";
                            }
                            
                          ?>
                                
                            
                            

                            
                          </div>

                          <!-- Left and right controls -->
                          <a href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="services-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Results</h1>
                    <?php
                        $result_query = mysql_query("SELECT * FROM `elections` AS E join `results` AS R on E.election_id = R.election_id join `users` as U on R.user_id = U.user_id join `election_users` as EU on EU.user_id = U.user_id join `positions` as P on E.position_id = P.position_id WHERE E.election_id=EU.election_id AND E.active = 0 ORDER BY E.timestamp DESC");
                    ?>
                    <?php 
                    if(mysql_num_rows($result_query) == 0) 
                        echo "<h3><small>No Election Resulted Yet</small></h3>";
                    else
                    ?>
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Election Name</th>
                            <th>Position</th>
                            <th>Year</th>
                            <th>Winner</th>
                            <th>Votes</th>
                            <th>Details</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                        <?php

                        while($result = mysql_fetch_assoc($result_query)){
                            $election = $result['election_name'];
                            $election_id = $result['election_id'];
                            $position = $result['position_name'];
                            $year = $result['year'];
                            $winner = $result['fname'].' '.$result['lname'];
                            $votes = $result['votes'];

                          echo "<tr align='left'>
                            <td>$election</td>
                            <td>$position</td>
                            <td>$year</td>
                            <td>$winner</td>
                            <td>$votes</td>
                            <td>";
                        ?>

                            <a href='view_details.php?view_details=<?php echo $election_id; ?>'<button class='btn btn-success' >Details</button></a>
                            </td>
                          </tr>
                          <?php
                            }
                          ?>
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Contact</h1>
                    <div class="col-lg-12">
                        <h1><small>Aditya Verma</small></h1>
                        <h1><small>Ashutosh Jindal</small></h1>
                        <h1><small>Shubham Aggarwal</small></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery.js"></script>

    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery.easing.min.js"></script>
    <script src="js/scrolling-nav.js"></script>

</body>

</html>
