<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="../css/register.css">
    <script defer src="../js/register.js"></script>
</head>
<body>
<div class="container">
    <h2>User Registration</h2>

    <form id="register-form">

        <!-- Account Type -->
        <div class="form-group">
            <label for="account_type">Account Type <span class="required">*</span></label>
            <select id="account_type" name="account_type">
                <option value="" selected disabled>Choose...</option>
                <option value="Individual">Individual</option>
                <option value="Company">Company</option>
            </select>
            <div id="account_type_error" class="error-message"></div>
        </div>

        <!-- Full Name (Individual) -->
        <div id="individual-fields" class="form-group hidden">
            <label for="full_name">Full Name <span class="required">*</span></label>
            <input type="text" id="full_name" name="full_name">
            <div id="full_name_error" class="error-message"></div>
        </div>

        <!-- Contact Name & Job Title (Company) -->
        <div id="company-fields" class="hidden">
            <div class="form-group">
                <label for="contact_name">Contact Name <span class="required">*</span></label>
                <input type="text" id="contact_name" name="contact_name">
                <div id="contact_name_error" class="error-message"></div>
            </div>

            <div class="form-group">
                <label for="job_title">Job Title <span class="required">*</span></label>
                <input type="text" id="job_title" name="job_title">
                <div id="job_title_error" class="error-message"></div>
            </div>
        </div>

        <!-- Username -->
        <div class="form-group">
            <label for="username">Username <span class="required">*</span></label>
            <input type="text" id="username" name="username">
            <div id="username_error" class="error-message"></div>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email Address <span class="required">*</span></label>
            <input type="email" id="email" name="email">
            <div id="email_error" class="error-message"></div>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password <span class="required">*</span></label>
            <input type="password" id="password" name="password">
            <div id="password_error" class="error-message"></div>
        </div>

        <!-- Retype Password -->
        <div class="form-group">
            <label for="password_confirm">Retype Password <span class="required">*</span></label>
            <input type="password" id="password_confirm" name="password_confirm">
            <div id="password_confirm_error" class="error-message"></div>
        </div>

        <!-- Phone Number -->
        <div class="form-group">
            <label for="phone_number">Phone Number (Optional)</label>
            <input type="tel" id="phone_number" name="phone_number">
            <div id="phone_number_error" class="error-message"></div>
        </div>

        <!-- General error -->
        <div id="general_error" class="error-message"></div>

        <button type="submit">Register</button>
    </form>
    <div id="success-overlay" class="success-overlay hidden">Registration successful!</div>
</div>
</body>
</html>
