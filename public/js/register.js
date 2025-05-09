document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('register-form');
    const accountType = document.getElementById('account_type');
    const individualFields = document.getElementById('individual-fields');
    const companyFields = document.getElementById('company-fields');

    // Show/hide fields based on account type
    accountType.addEventListener('change', () => {
        if (accountType.value === 'Individual') {
            individualFields.classList.remove('hidden');
            companyFields.classList.add('hidden');
        } else if (accountType.value === 'Company') {
            individualFields.classList.add('hidden');
            companyFields.classList.remove('hidden');
        } else {
            individualFields.classList.add('hidden');
            companyFields.classList.add('hidden');
        }
    });

    // Form submission via fetch
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        clearErrors();

        const formData = new FormData(form);
        const submitButton = form.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.textContent = 'Submitting...';

        try {
            const response = await fetch('/api/register.php', {
                method: 'POST',
                body: formData
            });

            const contentType = response.headers.get('Content-Type') || '';
            if (!contentType.includes('application/json')) {
                throw new Error('Expected JSON response but received something else.');
            }

            const result = await response.json();

            if (result.success) {
                const overlay = document.getElementById('success-overlay');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.add('hidden'), 2500);
                form.reset();
                individualFields.classList.add('hidden');
                companyFields.classList.add('hidden');
            } else {
                showErrors(result.errors);

                // Preserve inputs from user
                for (const [key, value] of formData.entries()) {
                    const field = document.querySelector(`[name="${key}"]`);
                    if (field && field.type !== 'password') {
                        field.value = value;
                    }
                }
                // Explicitly clear password fields
                document.querySelector('[name="password"]').value = '';
                document.querySelector('[name="password_confirm"]').value = '';

                // Re-trigger account type logic
                const accountTypeSelect = document.getElementById('account_type');
                if (accountTypeSelect) {
                    accountTypeSelect.dispatchEvent(new Event('change'));
                }
            }
        } catch (err) {
            console.error('Request failed', err);
            document.getElementById(
                'general_error').textContent = 'Something went wrong. Please try again later.';
        } finally {
            submitButton.disabled = false;
            submitButton.textContent = 'Register';
        }
    });

    function clearErrors() {
        const errorElements = document.querySelectorAll('.error-message');
        errorElements.forEach(el => el.textContent = '');

        const inputs = form.querySelectorAll('input, select');
        inputs.forEach(input => input.classList.remove('invalid'));
    }

    function showErrors(errors) {
        for (const [key, msg] of Object.entries(errors)) {
            const errorElement = document.getElementById(`${key}_error`);
            const field = document.querySelector(`[name="${key}"]`);

            if (msg && errorElement) {
                errorElement.textContent = msg;
                if (field) field.classList.add('invalid');
            }
        }
    }
});
