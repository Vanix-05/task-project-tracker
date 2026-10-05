<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Task & Project Tracker</title>

    @vite('resources/js/app.js')
</head>

<body>

<div class="login-page">

    <!-- BACKGROUND DECORATION -->

    <div class="glow glow-one"></div>
    <div class="glow glow-two"></div>

    <div class="login-wrapper">

        <!-- =========================================
             LEFT SIDE
             ========================================= -->

        <div class="login-showcase">

            <!-- BRAND -->

            <div class="brand">

                <div class="brand-icon">
                    ✓
                </div>

                <span>
                    Task & Project <strong>Tracker</strong>
                </span>

            </div>


            <!-- HERO TEXT -->

            <div class="hero-content">

                <h1>
                    Plan better.<br>
                    Work <span>smarter.</span>
                </h1>

                <p>
                    Manage your projects and tasks efficiently.
                    Stay organized, track your progress,
                    and achieve your goals.
                </p>

            </div>


            <!-- STAT CARDS -->

            <div class="showcase-stats">

                <div class="showcase-stat">

                    <div class="stat-icon">
                        ✓
                    </div>

                    <strong>12</strong>

                    <span>Total Tasks</span>

                </div>


                <div class="showcase-stat">

                    <div class="stat-icon">
                        ▰
                    </div>

                    <strong>4</strong>

                    <span>Projects</span>

                </div>


                <div class="showcase-stat">

                    <div class="stat-icon">
                        ◉
                    </div>

                    <strong>89%</strong>

                    <span>Progress</span>

                </div>

            </div>


          <!-- TASK PREVIEW -->

<div class="task-preview">

    <!-- HEADER -->

    <div class="task-preview-header">

        <div>
            <span class="preview-label">
                WORKSPACE
            </span>

            <h3>
                My Tasks
            </h3>
        </div>

        <span class="task-count">
            4 tasks
        </span>

    </div>


    <!-- PROGRESS -->

    <div class="task-progress">

        <div class="progress-info">

            <span>
                Today's progress
            </span>

            <strong>
                50%
            </strong>

        </div>

        <div class="progress-bar">

            <div class="progress-fill"></div>

        </div>

    </div>


    <!-- TASK LIST -->

    <div class="task-list">

        <!-- COMPLETED -->

        <div class="preview-task completed">

            <div class="task-check">
                ✓
            </div>

            <div class="task-info">

                <strong>
                    Design dashboard
                </strong>

                <span>
                    UI/UX Design
                </span>

            </div>

            <span class="task-status">
                Done
            </span>

        </div>


        <!-- COMPLETED -->

        <div class="preview-task completed">

            <div class="task-check">
                ✓
            </div>

            <div class="task-info">

                <strong>
                    Build login page
                </strong>

                <span>
                    Task Tracker
                </span>

            </div>

            <span class="task-status">
                Done
            </span>

        </div>


        <!-- IN PROGRESS -->

        <div class="preview-task active">

            <div class="task-check">
                →
            </div>

            <div class="task-info">

                <strong>
                    Test application
                </strong>

                <span>
                    Development
                </span>

            </div>

            <span class="task-status progress">
                In progress
            </span>

        </div>


        <!-- PENDING -->

        <div class="preview-task">

            <div class="task-check">
                ○
            </div>

            <div class="task-info">

                <strong>
                    Deploy project
                </strong>

                <span>
                    Production
                </span>

            </div>

            <span class="task-status pending">
                Pending
            </span>

        </div>

    </div>


    <!-- FOOTER -->

    <div class="task-preview-footer">

        <span>
            2 of 4 tasks completed
        </span>

        <span class="view-all">
            View workspace →
        </span>

    </div>

</div>

            <!-- FEATURES -->

            <div class="features">

                <div class="feature">
                    <span>✦</span>
                    Stay organized.
                </div>

                <div class="feature">
                    <span>▥</span>
                    Track progress.
                </div>

                <div class="feature">
                    <span>◎</span>
                    Finish what matters.
                </div>

            </div>

        </div>


        <!-- =========================================
             RIGHT SIDE
             ========================================= -->

        <div class="login-section">

            <div class="login-card">

                <!-- LOGIN ICON -->

                <div class="login-card-icon">
                    ✓
                </div>


                <!-- HEADER -->

                <div class="login-header">

                    <h2>
                        Welcome Back
                    </h2>

                    <p>
                        Sign in to your workspace.
                    </p>

                </div>


                <!-- SUCCESS MESSAGE -->

                @if(session('success'))

                    <div class="login-success">
                        {{ session('success') }}
                    </div>

                @endif


                <!-- ERROR MESSAGE -->

                @if($errors->any())

                    <div class="login-error">
                        {{ $errors->first() }}
                    </div>

                @endif


                <!-- LOGIN FORM -->

                <form
                    action="{{ route('login.submit') }}"
                    method="POST"
                >

                    @csrf


                    <!-- EMAIL -->

                    <div class="login-form-group">

                        <label for="email">
                            Email Address
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                @
                            </span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                required
                            >

                        </div>

                    </div>


                    <!-- PASSWORD -->

                    <div class="login-form-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="input-wrapper">

                            <span class="input-icon">
                                🔒
                            </span>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                required
                            >

                            <span class="password-icon">
                                ◉
                            </span>

                        </div>

                    </div>


                    <!-- OPTIONS -->

                    <div class="login-options">

                        <label class="remember-me">

                            <input
                                type="checkbox"
                                name="remember"
                            >

                            <span>
                                Remember me
                            </span>

                        </label>

                        <a
                            href="#"
                            class="forgot-password"
                        >
                            Forgot password?
                        </a>

                    </div>


                    <!-- SIGN IN -->

                    <button
                        type="submit"
                        class="login-btn"
                    >
                        <span>→</span>
                        Sign In
                    </button>

                </form>


                <!-- DIVIDER -->

                <div class="login-divider">

                    <span></span>

                    <p>
                        or continue with
                    </p>

                    <span></span>

                </div>


                <!-- SOCIAL BUTTONS -->

                <div class="social-buttons">

                    <button
                        type="button"
                        class="social-btn"
                    >
                        <strong>G</strong>
                        Google
                    </button>

                    <button
                        type="button"
                        class="social-btn"
                    >
                        <strong>●</strong>
                        GitHub
                    </button>

                    <button
                        type="button"
                        class="social-btn"
                    >
                        <strong>⊞</strong>
                        Microsoft
                    </button>

                </div>

            </div>


            <!-- FOOTER -->

            <div class="login-footer">

                Task & Project Tracker

                <span>
                    MVC CRUD Application
                </span>

            </div>

        </div>

    </div>

</div>

</body>
</html>