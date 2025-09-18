<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>KitaKeeps - Signup</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/logo-removebg-preview.png" type="image/x-icon">

    <!-- Open Graph / Social Preview -->
    <meta property="og:title" content="KitaKeeps - Register">
    <meta property="og:description" content="Manage your hardware effortlessly.">
    <meta property="og:image" content="https://raw.githubusercontent.com/SixxCodes/KitaKeeps/main/assets/images/docu/social-preview-1.png">
    <meta property="og:url" content="https://sixxcodes.github.io/KitaKeeps/">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        <div id="register-app" class="relative flex items-center justify-center min-h-screen px-4 sm:px-6 lg:px-8">
            
            <!-- Floating shapes -->
            <div class="float-shape"></div>
            <div class="float-shape"></div>
            <div class="float-shape"></div>

            <div class="relative z-10 w-full max-w-xl p-10 bg-white shadow-2xl rounded-3xl fade-slide-in my-9">

                <h2 class="mb-2 text-3xl font-extrabold text-center text-blue-600">Register to KitaKeeps</h2>
                <p class="mb-4 text-center text-gray-500">Begin your journey to effortless harmony in hardware management.</p>

                <form @submit.prevent="submitRegister" novalidate>

                    <!-- Hardware Name -->
                    <div class="mb-4">
                        <label for="hardware-name" class="block mb-2 font-semibold text-gray-700">Hardware Name</label>
                        <input
                            id="hardware-name"
                            v-model.trim="hardwareName"
                            required
                            placeholder="KitaKeeps Warehouse"
                            class="w-full px-4 py-3 text-gray-900 placeholder-gray-400 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                            :class="{'border-red-500': hardwareNameError}"
                        />
                        <p v-if="hardwareNameError" class="mt-1 text-sm text-red-500">@{{ hardwareNameError }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="username" class="block mb-2 font-semibold text-gray-700">Username</label>
                        <input
                        id="username"
                        v-model.trim="username"
                        required
                        placeholder="KitaKeepers143"
                        class="w-full px-4 py-3 text-gray-900 placeholder-gray-400 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" :class="{'border-red-500': usernameError}"
                        />
                        <p v-if="usernameError" class="mt-1 text-sm text-red-500">@{{ usernameError }}</p>
                    </div>

                    <!--Name -->
                    <div class="flex mb-4 space-x-4">
                        <!-- First Name -->
                        <div class="flex-1">
                            <label for="first-name" class="block mb-2 font-semibold text-gray-700">First Name</label>
                            <input
                            id="first-name"
                            v-model.trim="firstName"
                            required
                            placeholder="Kita"
                            class="w-full px-4 py-3 text-gray-900 placeholder-gray-400 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" :class="{'border-red-500': firstNameError}"
                            />
                            <p v-if="firstNameError" class="mt-1 text-sm text-red-500">@{{ firstNameError }}</p>
                        </div>

                        <!-- Last Name -->
                        <div class="flex-1">
                            <label for="last-name" class="block mb-2 font-semibold text-gray-700">Last Name</label>
                            <input
                            id="last-name"
                            v-model.trim="lastName"
                            required
                            placeholder="Keepers"
                            class="w-full px-4 py-3 text-gray-900 placeholder-gray-400 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400" :class="{'border-red-500': lastNameError}"
                            />
                            <p v-if="lastNameError" class="mt-1 text-sm text-red-500">@{{ lastNameError }}</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block mb-2 font-semibold text-gray-700">Email address</label>
                        <input
                            id="email"
                            type="email"
                            v-model.trim="email"
                            required
                            placeholder="you@example.com"
                            class="w-full px-4 py-3 text-gray-900 placeholder-gray-400 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                            :class="{'border-red-500': emailError}"
                        />
                        <p v-if="emailError" class="mt-1 text-sm text-red-500">@{{ emailError }}</p>
                    </div>

                    <!-- Password -->
                    <div class="relative mb-4">
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

                    <!-- Confirm Password -->
                    <div class="relative mb-6">
                        <label for="confirm-password" class="block mb-2 font-semibold text-gray-700">Confirm Password</label>
                        <input
                            :type="showPassword ? 'text' : 'password'"
                            id="confirm-password"
                            v-model.trim="confirmPassword"
                            required
                            placeholder="Confirm your password"
                            class="w-full px-4 py-3 text-gray-900 placeholder-gray-400 transition border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400"
                            :class="{'border-red-500': confirmPasswordError}"
                        />
                        <p v-if="confirmPasswordError" class="mt-1 text-sm text-red-500">@{{ confirmPasswordError }}</p>

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
                        <span v-if="!loading">Register</span>
                        <span v-else class="flex items-center justify-center space-x-2">
                            <svg class="w-5 h-5 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                            <span>Registering...</span>
                        </span>
                    </button>
                </form>

                <p class="mt-6 text-center text-gray-600">
                    Already have an account?
                    <a href="{{ url('/login-frontend') }}" class="font-semibold text-blue-600 hover:underline">Log in</a>
                </p>
            </div>
        </div>
    </x-guest-layout>
</body>
</html>
