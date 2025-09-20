// ==================== Login (Error handling only, no login logic)====================
import { createApp } from 'vue';

const app = createApp({
    data() {
        return {
            username: '',
            password: '',
            rememberMe: false,
            showPassword: false,

            usernameError: '',
            passwordError: '',
            loading: false,
        }
    },
    methods: {
        togglePassword() {
            this.showPassword = !this.showPassword;
        },
        submitLogin() {
            this.usernameError = '';
            this.passwordError = '';

            if (!this.username) {
                this.usernameError = 'Username is required.';
            }

            if (!this.password) {
                this.passwordError = 'Password is required.';
            } else if (this.password.length < 8) {
                this.passwordError = 'Password must be at least 8 characters.';
            }

            if (this.usernameError || this.passwordError) {
                return;
            }

            this.loading = true;

            // Send login request to Breeze
            fetch('/login-frontend', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                credentials: 'same-origin',
                body: JSON.stringify({
                    username: this.username,
                    password: this.password,
                    remember: this.rememberMe
                })
            })
            .then(res => res.json())
            .then(data => {
                this.loading = false;

                if (data.errors) {
                    // Handle Laravel validation errors
                    this.usernameError = data.errors.username ? data.errors.username[0] : '';
                    this.passwordError = data.errors.password ? data.errors.password[0] : '';
                } else {
                    // Login successful
                    alert(`Welcome back, ${data.user.username}!`);
                    window.location.href = data.redirect; 
                }
            })
            .catch(err => {
                this.loading = false;
                console.error('Login error:', err);
                alert('An error occurred. Please try again.');
            });
        }
    }
});

const el = document.getElementById('login-app');
if (el) {
    app.mount('#login-app');
}
