document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('form');

    function sendEmail() {
        const name = document.querySelector('input[name="name"]').value;
        const phone = document.querySelector('input[name="phone"]').value;
        const email = document.querySelector('input[name="email"]').value;
        const message = document.querySelector('textarea[name="message"]').value;

        const emailBody = `Name: ${name}\nPhone: ${phone}\nEmail: ${email}\nMessage: ${message}`;

        if (!name || !email || !message) {
            alert("Please fill in all required fields.");
            return;
        }

        const emailSettings = {
            SecureToken: "E149D335B74B31BF43A626B55EDFBBAFECD8",
            Host: "smtp.elasticemail.com",
            Username: "mikaysomera16@gmail.com",
            Password: "E149D335B74B31BF43A626B55EDFBBAFECD8",
            To: "mikaysomera16@gmail.com",
            From: email,
            Subject: "New message from your website",
            Body: emailBody
        };

        Email.send(emailSettings)
            .then(() => {
                alert("Email sent successfully!");
                window.location.href = "thank_you.php";
            })
            .catch(error => {
                console.error("Error sending email:", error);
                alert("Failed to send email. Please try again later.");
            });
    }

    form.addEventListener("submit", function(e) {
        e.preventDefault();
        sendEmail();
    });
});
