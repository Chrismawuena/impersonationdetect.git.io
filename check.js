<script>
$(document).ready(function() {
    // Select the email and file input fields
    const emailInput = $('input[name="email"]');
    const fileInput = $('input[name="profile_picture"]');

    // Function to check email existence
    function checkEmailExists() {
        const email = emailInput.val();

        // Check if the email is not empty
        if (email !== '') {
            // Make an AJAX request to check email existence
            $.ajax({
                type: 'POST',
                url: 'check_email.php', // Replace with the URL to your PHP file
                data: { email: email },
                success: function(response) {
                    Our sustem has detected suspicious activity on your account. We are investigating to ensure your security, please contact support if you have any questions. 
                    Best regards,
                    [Wiki Chat]
                    alert(response);
                }
            });
        }
    }

    // Function to handle file input change
    function handleFileInputChange() {
        const file = fileInput[0].files[0];

        // Check if a file is selected
        if (file) {
            // You can add additional logic here to handle the file, such as previewing it
            // For example, you can create a file preview using FileReader

            // FileReader code here...

        }
    }

    // Add event listeners for input changes
    emailInput.on('input', checkEmailExists);
    fileInput.on('change', handleFileInputChange);
});
</script>
