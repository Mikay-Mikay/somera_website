<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <section>
        <nav style="width: 100%; height: 45px;">
            <label class="logo">My Personal Website</label>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about_me.php">About Me</a></li>
                <li><a class="active" href="#">Contacts</a></li>
                <li><a href="blog.php">Blog</a></li>
            </ul>
        </nav>
        <button class="hamburger">
            <div class="bar"></div>
        </button>
        <nav class="mobile-nav">
            <a href="index.php">Home</a>
            <a href="about_me.php">About Me</a>
            <a class="active" href="#">Contacts</a>
            <a href="blog.php">Blog</a>
        </nav>
        <div class="container">
            <h1>Connect with Me</h1>
            <p>Feel free to reach out and get in touch with me.<br>I'm always eager to connect, collaborate, and discuss exciting opportunities!</p>
            <div class="contact-box">
                <div class="contact-left">
                    <h3>Send your requests!</h3>
                    <form method="POST" id="form">
                        <div class="input-row">
                            <div class="input-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" placeholder="Enter your Full Name" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                <label for="phone">Phone:</label>
                                <input type="text" name="phone" placeholder="Enter your Phone Number">
                            </div>
                        </div>
                        <div class="input-row">
                            <div class="input-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" placeholder="Enter your Email" required>
                            </div>
                        </div>
                        <div class="input-row">
                            <label for="message">Message:</label>
                            <textarea id="message" style="margin-right: 200px; width: 390px;" name="message" rows="7" placeholder="Enter your Message.." required></textarea>
                        </div>
                        <button type="submit" style="width: 15%; border: 2px solid transparent; outline: none; height: 35px; margin-top: 6px; margin-bottom: 15px; box-shadow: 0px 5px 15px 0px rgba(28, 0, 181, 0.3); transition: 0.4s; font-weight: bold; background: #E6BAA3; text-decoration: none; font-weight: bold; color: #D24545; border-radius: 5px;">Send</button>
                    </form>
                </div>
                <div class="contact-right">
                    <h3>Reach Me!</h3>
                    <table>
                        <tr>
                            <td>Email</td>
                            <td>mikaysomera16@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>63+9123456789</td>
                        </tr>
                        <tr>
                            <td>Social Medias</td>
                            <td>Facebook: Mikaela Somera<br>Instagram: mkljwn_<br>LinkedIn: Mikaela Somera<br>Github: Iska (Mikay-Mikay)</td>
                        </tr>
                    </table>
                    <button style="width: 23%; border: 2px solid transparent; outline: none; height: 35px; margin-top: 6px; margin-bottom: 15px; box-shadow: 0px 5px 15px 0px rgba(28, 0, 181, 0.3); transition: 0.4s; font-weight: bold; background: #E6BAA3; text-decoration: none; font-weight: bold; color: #D24545; border-radius: 5px;"><a href="logout.php"><a href="logout.php">Log Out</a></button>
                </div>
            </div>
        </div>
    </section>
    <script src="contact.js"></script>
    <script src="index.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
</body>
</html>
