import '../css/tasks.css';
import '../css/login.css';
import '../css/dashboard.css';

/* =========================================================
   TASK SEARCH & FILTERS
   ========================================================= */

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('taskSearch');
    const projectFilter = document.getElementById('projectFilter');
    const statusFilter = document.getElementById('statusFilter');
    const priorityFilter = document.getElementById('priorityFilter');
    const clearButton = document.getElementById('clearTaskFilters');

    const rows = document.querySelectorAll('.task-row');
    const noResults = document.getElementById('noTaskResults');


    // Only run this code on the Tasks page

    if (!searchInput || !rows.length) {
        return;
    }


    function filterTasks() {

        const search =
            searchInput.value.toLowerCase().trim();

        const project =
            projectFilter.value.toLowerCase();

        const status =
            statusFilter.value.toLowerCase();

        const priority =
            priorityFilter.value.toLowerCase();


        let visibleTasks = 0;


        rows.forEach(function (row) {

            const task =
                row.dataset.task || '';

            const rowProject =
                row.dataset.project || '';

            const assigned =
                row.dataset.assigned || '';

            const rowStatus =
                row.dataset.status || '';

            const rowPriority =
                row.dataset.priority || '';


            const matchesSearch =
                task.includes(search) ||
                rowProject.includes(search) ||
                assigned.includes(search);


            const matchesProject =
                project === 'all' ||
                rowProject === project;


            const matchesStatus =
                status === 'all' ||
                rowStatus === status;


            const matchesPriority =
                priority === 'all' ||
                rowPriority === priority;


            const shouldShow =
                matchesSearch &&
                matchesProject &&
                matchesStatus &&
                matchesPriority;


            if (shouldShow) {

                row.style.display = '';

                visibleTasks++;

            } else {

                row.style.display = 'none';

            }

        });


        // Show empty state when nothing matches

        if (visibleTasks === 0) {

            noResults.style.display = 'block';

        } else {

            noResults.style.display = 'none';

        }

    }


    // Search

    searchInput.addEventListener(
        'input',
        filterTasks
    );


    // Filters

    projectFilter.addEventListener(
        'change',
        filterTasks
    );

    statusFilter.addEventListener(
        'change',
        filterTasks
    );

    priorityFilter.addEventListener(
        'change',
        filterTasks
    );


    // Clear

    clearButton.addEventListener(
        'click',
        function () {

            searchInput.value = '';

            projectFilter.value = 'all';

            statusFilter.value = 'all';

            priorityFilter.value = 'all';

            filterTasks();

        }
    );

});