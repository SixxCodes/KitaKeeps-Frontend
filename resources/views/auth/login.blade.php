<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>KitaKeeps - Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/logo-removebg-preview.png" type="image/x-icon">

    <!-- Open Graph / Social Preview -->
    <meta property="og:title" content="KitaKeeps - Login">
    <meta property="og:description" content="Manage your hardware effortlessly.">
    <meta property="og:image" content="https://raw.githubusercontent.com/SixxCodes/KitaKeeps/main/assets/images/docu/social-preview-1.png">
    <meta property="og:url" content="https://sixxcodes.github.io/KitaKeeps/">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Tailwind -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

    <!-- Vue.js -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script> -->

    <!-- Font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- <link rel="stylesheet" href="{{ asset('assets/css/login-register.css') }}"> -->
</head>
<body>
    <x-guest-layout>
        <div id="login-app" class="relative flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
            
            <!-- Floating shapes -->
            <div class="float-shape"></div>
            <div class="float-shape"></div>
            <div class="float-shape"></div>

            <div class="relative z-10 w-full max-w-md p-10 bg-white shadow-2xl rounded-3xl fade-slide-in">

                <h2 class="mb-2 text-3xl font-extrabold text-center text-blue-600">Login to KitaKeeps</h2>
                <p class="mb-4 text-center">Welcome back! Log in to continue.</p>

                <form @submit.prevent="submitLogin" novalidate>

                    <!-- Username -->
                    <div class="mb-6">
                        <label for="username" class="block mb-2 font-semibold text-gray-700">Username</label>
                        <input
                            id="username"
                            type="username"
                            v-model.trim="username"
                            required
                            placeholder="kitakeepers143"
                            class="w-full px-4 py-3 text-gray-900 placeholder-gray-400 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                            :class="{'border-red-500': usernameError}"
                        />
                        <p v-if="usernameError" class="mt-1 text-sm text-red-500">@{{ usernameError }}</p>
                    </div>

                    <!-- Password -->
                    <div class="relative mb-6">
                        <label for="password" class="block mb-2 font-semibold text-gray-700">Password</label>
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            id="password"
                            v-model.trim="password"
                            required
                            placeholder="Enter your password"
                            class="w-full px-4 py-3 text-gray-900 placeholder-gray-400 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                            :class="{'border-red-500': passwordError}"
                        />
                        <p v-if="passwordError" class="mt-1 text-sm text-red-500">@{{ passwordError }}</p>

                        <!-- Show password (eye) icon -->
                        <button type="button" @click="togglePassword" class="absolute text-gray-500 right-3 top-11 hover:text-blue-600 focus:outline-none" :aria-label="showPassword ? 'Hide password' : 'Show password'">
                            <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                        </button>
                    </div>

                    <!-- <div class="flex items-center justify-between mb-6">

                        <label class="flex items-center text-gray-700">
                            <input type="checkbox" v-model="rememberMe" class="w-4 h-4 text-blue-600 form-checkbox" />
                            <span class="ml-2 text-sm">Remember me</span>
                        </label>

                        <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                    </div> -->

                    <button
                    type="submit"
                    class="w-full py-3 text-lg font-semibold text-white transition-colors bg-blue-600 rounded-lg focus:ring-4 focus:ring-blue-400 focus:outline-none"
                    :disabled="loading"
                    >
                        <span v-if="!loading">Log In</span>
                        <span v-else class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span>Logging in...</span>
                        </span>
                    </button>
                </form>

                <p class="mt-6 text-center text-gray-600">
                    Don't have an account?
                    <a href="{{ url('/register-frontend') }}" class="font-semibold text-blue-600 hover:underline">Register</a>
                </p>
            </div>
        </div>
    </x-guest-layout>
</body>
</html>
