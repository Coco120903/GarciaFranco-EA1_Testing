<?php
// Initialize variables to store input values and error messages
$name = $email = $subject = $message = "";
$nameErr = $emailErr = $subjectErr = $messageErr = "";
$successMsg = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // Check if the email address is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate Subject
    if (empty($_POST["subject"])) {
        $subjectErr = "Subject is required";
    } else {
        $subject = test_input($_POST["subject"]);
    }

    // Validate Message
    if (empty($_POST["message"])) {
        $messageErr = "Message is required";
    } else {
        $message = test_input($_POST["message"]);
    }

    // Check if all inputs are valid before displaying the success message
    if (empty($nameErr) && empty($emailErr) && empty($subjectErr) && empty($messageErr)) {
        $successMsg = "Thank you for contacting us! We have received the following information:";
    }
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Contact Form</h1>
    
    <?php if (!empty($successMsg)): ?>
        <p style="color: green;"><?php echo $successMsg; ?></p>
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Subject:</strong> <?php echo $subject; ?></p>
        <p><strong>Message:</strong> <?php echo nl2br($message); ?></p>
    <?php else: ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?php echo $name; ?>" required>
            <span style="color: red;"><?php echo $nameErr; ?></span>
            
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
            <span style="color: red;"><?php echo $emailErr; ?></span>
            
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" value="<?php echo $subject; ?>" required>
            <span style="color: red;"><?php echo $subjectErr; ?></span>
            
            <label for="message">Message</label>
            <textarea name="message" id="message" required><?php echo $message; ?></textarea>
            <span style="color: red;"><?php echo $messageErr; ?></span>
            
            <br>
            <button type="submit">Send</button>
        </form>
    <?php endif; ?>
    
</body>
</html>