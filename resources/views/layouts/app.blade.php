<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Task & Project Tracker')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/css/tasks.css',
        'resources/css/login.css',
        'resources/css/dashboard.css',
        'resources/js/app.js'
    ])

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

</head>


<body>

<div class="dashboard-page">


    <!-- =========================================
         SIDEBAR
         ========================================= -->

    <aside class="dashboard-sidebar">


        <!-- BRAND -->

        <div class="dashboard-brand">

            <div class="brand-logo">

                <i data-lucide="check-check"></i>

            </div>

            <div class="brand-text">

                <strong>
                    Task Tracker
                </strong>

                <span>
                    Workspace
                </span>

            </div>

        </div>


        <!-- =========================================
             NAVIGATION
             ========================================= -->

        <nav class="dashboard-nav">


            <!-- MAIN -->

            <div class="nav-section-title">
                MAIN
            </div>


            <!-- DASHBOARD -->

            <a
                href="{{ route('dashboard') }}"
                class="dashboard-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            >

                <span class="nav-icon">
                    <i data-lucide="layout-dashboard"></i>
                </span>

                <span class="nav-text">
                    Dashboard
                </span>

            </a>


            <!-- TASKS -->

            <a
                href="{{ route('tasks.index') }}"
                class="dashboard-nav-link {{ request()->routeIs('tasks.index', 'tasks.show', 'tasks.edit') ? 'active' : '' }}"
            >

                <span class="nav-icon">
                    <i data-lucide="check-square"></i>
                </span>

                <span class="nav-text">
                    Tasks
                </span>

            </a>


            <!-- ADD TASK -->

            <a
                href="{{ route('tasks.create') }}"
                class="dashboard-nav-link {{ request()->routeIs('tasks.create') ? 'active' : '' }}"
            >

                <span class="nav-icon">
                    <i data-lucide="plus-circle"></i>
                </span>

                <span class="nav-text">
                    Add Task
                </span>

            </a>


            <!-- WORKSPACE -->

            <div class="nav-section-title dashboard-nav-space">
                WORKSPACE
            </div>


            <!-- PROJECTS -->

            <a
                href="{{ route('tasks.index') }}"
                class="dashboard-nav-link"
            >

                <span class="nav-icon">
                    <i data-lucide="folder-kanban"></i>
                </span>

                <span class="nav-text">
                    Projects
                </span>

            </a>


            <!-- DEADLINES -->

            <a
                href="{{ route('tasks.index') }}"
                class="dashboard-nav-link"
            >

                <span class="nav-icon">
                    <i data-lucide="calendar-clock"></i>
                </span>

                <span class="nav-text">
                    Deadlines
                </span>

            </a>


        </nav>


        <!-- =========================================
             SIDEBAR BOTTOM
             ========================================= -->

        <div class="sidebar-bottom">


            <!-- LOGOUT -->

            <div class="sidebar-logout">

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                >

                    @csrf

                    <button
                        type="submit"
                        class="logout-btn"
                    >

                        <span class="logout-icon">

                            <i data-lucide="log-out"></i>

                        </span>

                        <span class="logout-text">
                            Logout
                        </span>

                    </button>

                </form>

            </div>


            <!-- ORGANIZATION MESSAGE -->

            <div class="sidebar-footer">

                <div class="sidebar-footer-icon">

                    <i data-lucide="sparkles"></i>

                </div>

                <div>

                    <strong>
                        Stay organized
                    </strong>

                    <span>
                        Finish what matters.
                    </span>

                </div>

            </div>

        </div>


    </aside>


    <!-- =========================================
         MAIN APPLICATION
         ========================================= -->

    <main class="dashboard-main">


        <!-- =========================================
             TOP BAR
             ========================================= -->

        <header class="dashboard-topbar">


            <!-- PAGE INFORMATION -->

            <div>

                <span class="dashboard-eyebrow">

                    @yield(
                        'eyebrow',
                        'OVERVIEW'
                    )

                </span>


                <h1>

                    @yield(
                        'page-title',
                        'Dashboard'
                    )

                </h1>


                <p>

                    @yield(
                        'page-description',
                        "Here's what's happening with your tasks today."
                    )

                </p>

            </div>


            <!-- =====================================
                 USER PROFILE
                 ===================================== -->

            <div class="dashboard-user">


                <div class="user-avatar">

                    CJ

                </div>


                <div class="user-details">

                    <strong>
                        CJ Cerbito
                    </strong>

                    <span>
                        Project Manager
                    </span>

                </div>


                <div class="user-menu-icon">

                    <i data-lucide="chevron-down"></i>

                </div>


            </div>


        </header>


        <!-- =========================================
             PAGE CONTENT
             ========================================= -->

        @yield('content')


    </main>


</div>


<!-- =========================================
     INITIALIZE ICONS
     ========================================= -->

<script>
    lucide.createIcons();
</script>


</body>

</html>