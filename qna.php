<?php
    session_start();

    include("php\connection.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Lost Pets</title>
        <link rel="stylesheet" type="text/css" href="css\style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins">
        <link rel="shortcut icon" type="image/x-icon" href="Design-Images\cat_shortcuticon.png">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }

            .askaQ,
            .ansaQ,
            .QnAs {
                margin: 20px auto;
                max-width: 600px;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                align-items: center;
            }

            .QnAs {
                margin: 20px auto;
                max-width: 800px;
                padding: 20px;
                background-color: #f9f9f9;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            }

            .QnAs h1 {
                font-size: 24px;
                margin-bottom: 20px;
                text-align: center;
            }

            .question {
                margin-bottom: 30px;
                text-align: center;
            }

            .question-text {
                font-weight: bold;
                font-size: 18px;
                margin-bottom: 10px;
            }

            .answer-list {
                padding-left: 20px;
            }

            .answer {
                font-size: 16px;
                margin-bottom: 5px;
            }


            ul {
                list-style-type: none;
                padding: 0;
            }

            ul li {
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <header>
            <a href="home.php"><img class="logo"src="Design-Images\cat_logo.png" alt="Cat Icon"></a>
            <h1 class="title">Lost Pets</h1>
            <p class="quote">"Help us, to help you!"</p>
            <nav>
                <div class="topnav" id="myTopnav">
                    <div class="dropdown">
                        <button class="dropbtn">
                            Missing Pets
                        </button>
                        <div class="dropdown-content">
                            <a href="report_missing_pet.php">Report Missing Pets</a>
                            <a href="missing_pets.php">View Missing Pets</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn">
                            Found Pets
                        </button>
                        <div class="dropdown-content">
                            <a href="report_found_pets.php">Report Found Pets</a>
                            <a href="found_pets.php">View Found Pets</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn"> <img src="">
                            <i class="fa fa-bars"></i>
                        </button>
                        <div class="dropdown-content">
                            <a href="shop.php">Shop</a>
                            <a href="help_advice.php" class="active">Help & Advice</a>
                            <a href="contact.html">Contact Us</a>
                            <a href="admin_page.php">Admin</a>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
                    <div class="right-links" style="float: right">
                        <a href="account.php">Account</a>
                        <a href="logout.php"> <buttom class="btn">Log Out</buttom></a>
                    </div>
                </div>
            </nav>
        </header>
        <?php
            // Function to sanitize input data
            function sanitize_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            // Function to display success or error messages
            function display_message($message, $type = 'success')
            {
                echo '<div class="alert alert-' . $type . '">' . $message . '</div>';
            }

            // Handle ask question form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ask_question'])) {
                // Sanitize input data
                $question_text = sanitize_input($_POST['question_text']);

                // Check if the question text is not empty
                if (!empty($question_text)) {
                    // Insert the question into the database
                    $user_id = 1; // Assuming user ID 1 is asking the question, replace with actual user ID
                    $sql = "INSERT INTO questions (user_id, question_text) VALUES ('$user_id', '$question_text')";
                    if ($con->query($sql) === TRUE) {
                        display_message("Question posted successfully.");
                    } else {
                        display_message("Error posting question: " . $con->error, 'danger');
                    }
                } else {
                    display_message("Question text cannot be empty.", 'danger');
                }
            }

            // Handle answer question form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['answer_question'])) {

                // Sanitize input data
                $answer_text = sanitize_input($_POST['answer_text']);
                $question_id = $_POST['question_id'];

                // Check if the answer text is not empty
                if (!empty($answer_text)) {

                    // Insert the answer into the database
                    $user_id = 1; // Assuming user ID 1 is answering the question, replace with actual user ID
                    $sql = "INSERT INTO answers (user_id, question_id, answer_text) VALUES ('$user_id', '$question_id', '$answer_text')";
                    if ($con->query($sql) === TRUE) {
                        display_message("Answer posted successfully.");
                    } else {
                        display_message("Error posting answer: " . $con->error, 'danger');
                    }
                } else {
                    display_message("Answer text cannot be empty.", 'danger');
                }
            }

            // Retrieve questions and their answers along with usernames
            $sql = "SELECT q.id AS question_id, q.question_text, a.answer_text, u.Username AS asker_username, u2.Username AS answerer_username
            FROM questions q 
            LEFT JOIN answers a ON q.id = a.question_id 
            LEFT JOIN user u ON q.user_id = u.Id
            LEFT JOIN user u2 ON a.user_id = u2.Id
            ORDER BY q.id ASC";
    
            $result = $con->query($sql);
            $questions = array();
            if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $question_id = $row['question_id'];
                if (!isset($questions[$question_id])) {
                    $questions[$question_id] = array(
                        'question_text' => $row['question_text'],
                        'asker_username' => $row['asker_username'],
                        'answers' => array()
                    );
                }
                if (!empty($row['answer_text'])) {
                    $questions[$question_id]['answers'][] = array(
                        'answer_text' => $row['answer_text'],
                        'answerer_username' => $row['answerer_username']
                    );
                }
            }
            }
        ?>
        <div class="askaQ">
            <h1>Ask a Question</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <textarea name="question_text" rows="4" cols="50" placeholder="Enter your question"></textarea><br><br>
                <input type="submit" name="ask_question" value="Ask Question">
            </form>
        </div>

        <div class="ansaQ">
            <h1>Answer a Question</h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <select name="question_id">
                    <?php
                    foreach ($questions as $question_id => $question) {
                        echo "<option value='$question_id'>" . $question['question_text'] . "</option>";
                    }
                    ?>
                </select><br><br>
                <textarea name="answer_text" rows="4" cols="50" placeholder="Enter your answer"></textarea><br><br>
                <input type="submit" name="answer_question" value="Answer Question">
            </form>
        </div>

        <div class="QnAs">
            <h1>Questions and Answers</h1>
            <?php foreach ($questions as $question): ?>
                <div class="question">
                    <p class="question-text">Asked by: <?php echo $question['asker_username']; ?></p>
                    <p><?php echo $question['question_text']; ?></p>
                    <ul class="answer-list">
                        <?php foreach ($question['answers'] as $answer): ?>
                            <li class="answer">Answered by: <?php echo $answer['answerer_username']; ?><br><?php echo $answer['answer_text']; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>



        <?php
        // Close the database connection
        $con->close();
        ?>
        <script>
            window.embeddedChatbotConfig = {
            chatbotId: "LaKRJr_-iPekl6Al0xMG6",
            domain: "www.chatbase.co"
            }
        </script>
        <script
            src="https://www.chatbase.co/embed.min.js"
            chatbotId="LaKRJr_-iPekl6Al0xMG6"
            domain="www.chatbase.co"
            defer>
        </script>
    </body>
</html>