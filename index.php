<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyHive - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        main {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 10px;
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-45%, -30%);
            width: 100%;
            max-width: 800px;
        }

        .exam, .task, .custom-reminder {
            background-color: rgba(255, 0, 0, 0.2);
        }

        .task {
            background-color: rgba(0, 0, 255, 0.2);
        }

        .custom-reminder {
            background-color: rgba(0, 128, 0, 0.2);
        }

        .date-box {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            margin: 2px;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        .date-box:hover {
            background-color: #f0f0f0;
        }

        .task-item {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            background-color: #fff;
        }

        .content-section {
            width: 100%;
            height: auto;
            max-width: 800px;
            padding: 20px;
            margin: 10px auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .activities-section,
        .classes-section,
        .calendar-section {
            height: auto;
            width: 100%;
            max-width: 800px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }

        .calendar-section {
            min-height: 500px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="flex justify-between p-4">
        <div>
            <h2 id="current-time" class="text-lg font-semibold text-gray-700"></h2>
            <p id="current-date" class="text-sm text-gray-600"></p>
        </div>
        <div class="flex items-center space-x-4">
            <img src="https://placehold.co/50x50" alt="User  profile image" class="rounded-full">
            <div>
                <h4 class="font-semibold text-lg text-gray-700">Hello, Ryan</h4>
                <small class="text-sm text-gray-600">You have <span id="task-count">0</span> tasks today</small>
            </div>
        </div>
    </header>
    <script>
        // Function to update the current time and date
        function updateDateTime() {
            const now = new Date();
            const optionsDate = { year: 'numeric', month: 'long', day: 'numeric' };
            const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit' };

            document.getElementById('current-time').innerText = now.toLocaleTimeString([], optionsTime);
            document.getElementById('current-date').innerText = now.toLocaleDateString([], optionsDate);
        }

        // Call the function to update the time/date immediately
        updateDateTime();
        // Update time/date every second
        setInterval(updateDateTime, 1000);

        function showContent(sectionId) {
            const contentSections = document.querySelectorAll('.content-section');
            contentSections.forEach(( section) => {
                section.classList.add('hidden');
            });
            document.getElementById(sectionId).classList.remove('hidden');
        }
    </script>
    
    <script>
        function showContent(sectionId) {
            const contentSections = document.querySelectorAll('.content-section');
            contentSections.forEach((section) => {
                section.classList.add('hidden');
            });
            document.getElementById(sectionId).classList.remove('hidden');
        }

        // Function to update the task count
        function updateTaskCount() {
            const taskList = document.getElementById('task-list');
            const taskCount = taskList.children.length;
            document.getElementById('task-count').innerText = taskCount;
        }
    </script>
<nav class="w-64 bg-white p-5">
    <ul class="space-y-2 text-sm">
        <li><a href="#" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200" onclick="showContent('dashboard')">
            <i class="fas fa-tachometer-alt text-gray-400"></i>
            <span>Dashboard</span>
        </a></li>
        <li><a href="#" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200" onclick="showContent('activities')">
            <i class="fas fa-user-friends text-gray-400"></i>
            <span>Activities</span>
        </a></li>
        <li><a href="#" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200" onclick="showContent('classes')">
            <i class="fas fa-chalkboard-teacher text-gray-400"></i>
            <span>Classes</span>
        </a></li>
        <li><a href="#" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200" onclick="showContent('calendar')">
            <i class="fas fa-calendar-alt text-gray-400"></i>
            <span>Calendar</span>
        </a></li>
        <li><a href="#" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200">
            <i class="fas fa-cog text-gray-400"></i>
            <span>Settings</span>
        </a></li>
        <li><a href="#" class="flex items-center space-x-3 text-gray-700 p-2 rounded-md font-medium hover:bg-gray-200">
            <i class="fas fa-sign-out-alt text-gray-400"></i>
            <span>Logout</span>
        </a></li>
    </ul>
    <div class="mt-4 text-center text-lg font-bold text-gray-700">
        StudyHive
    </div>
</nav>
<main>
    <div id="dashboard" class="content-section">
        <!-- Time and Date Display -->
        <div class="flex flex-col items-center mb-4">
            <h2 id="current-time" class="text-lg font-semibold text-gray-700"></h2>
            <p id="current-date" class="text-sm text-gray-600"></p>
        </div>

        <!-- Upcoming Tasks Section -->
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Upcoming Tasks</h3>
        <div id="upcoming-tasks" class="bg-white p-4 rounded-lg shadow">
            <!-- Upcoming tasks will be displayed here -->
        </div>
    </div>

    <div id="activities" class="activities-section content-section hidden">
        <div class="mt-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold text-gray-700 mb-4"> Add Task</h3>
                <form id="task-form" onsubmit="addTask(event)">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="task-name">Activity Name</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="task-name" type="text" placeholder="" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="task-subject">Subject</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="task-subject" type="text" placeholder="" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="task-due-date">Due Date</label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="task-due-date" type="datetime-local" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="task-description">Description</label>
                        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="task-description" placeholder="" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="task-status">Status</label>
                        <select id="task-status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="todo">To-Do</option>
                            <option value="in-progress">In Progress</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            Add Task
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Task List -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Your Tasks</h3>
            <div id="task-list">
                <!-- Task items will be added here dynamically -->
            </div>
        </div>
    </div>

    <div id="classes" class="classes-section content-section hidden">
        <div class="bg-white p-6 rounded-lg shadow mb-6" id="classesList">
            <h3 class="text-xl mb-4 ">Your Classes</h3>
            <!-- Class items will be blank initially -->
        </div>

        <!-- Add New Class Form -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-xl mb-4">Add New Class</h3>
            <form id="classForm" onsubmit="addClass(event)">
                <input type="text" id="className" placeholder="Class Name" class="w-full p-2 border border-gray-300 rounded" required>
                <input type="text" id="subject" placeholder="Subject" class="w-full p-2 border border-gray-300 rounded" required>
                <input type="text" id="teacherName" placeholder="Teacher Name" class="w-full p-2 border border-gray-300 rounded" required>
                <input type="text" id="roomNumber" placeholder="Room Number" class="w-full p-2 border border-gray-300 rounded" required>
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg ">Add Class</button>
            </form>
        </div>
    </div>

    <div id="calendar" class="calendar-section content-section hidden">
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="flex justify-between mb-4">
                <select id="reminder-type" class="p-2 border border-gray-300 rounded">
                    <option value="exam">Exam</option>
                    <option value="task">Task</option>
                    <option value="custom">Custom</option>
                </select>

 <!-- Hidden input for custom reminder -->
                <input id="custom-reminder-input" type="text" placeholder="Enter custom reminder" class="p-2 border border-gray-300 rounded hidden">
            </div>

            <!-- Time picker input -->
            <div class="flex justify-between mb-4">
                <input type="time" id="reminder-time" class="p-2 border border-gray-300 rounded">
                <button id="set-reminder" class="bg-green-500 text-white p-2 rounded">Set Reminder</button>
            </div>

            <div class="flex justify-between mb-4">
                <select id="month-select" class="p-2 border border-gray-300 rounded">
                    <option value="0">January</option>
                    <option value="1">February</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                    <option value="4">May</option>
                    <option value="5">June</option>
                    <option value="6">July</option>
                    <option value="7">August</option>
                    <option value="8">September</option>
                    <option value="9">October</option>
                    <option value="10">November</option>
                    <option value="11">December</option>
                </select>
                <select id="year-select" class="p-2 border border-gray-300 rounded">
                    <!-- Year options will be generated dynamically -->
                </select>
            </div>

            <!-- Days of the Week -->
            <div class="grid grid-cols-7 text-center font-semibold text-gray-700 mb-2">
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
                <div>Sun</div>
            </div>

            <div id="calendar-days" class="grid grid-cols-7 gap-2">
                <!-- Days of the month will be generated here -->
            </div>

            <!-- Section to show reminders -->
            <div id="reminder-list" class="mt-4 hidden">
                <h4 class="font-semibold text-lg text-gray-700">Reminders for <span id="selected-date"></span>:</h4>
                <div id="reminder-buttons" class="flex flex-wrap gap-2"></div>
            </div>
        </div>
    </div>
</main>

<script>
    // Calendar management
    const setReminderButton = document.getElementById('set-reminder');
    const calendarDays = document.getElementById('calendar-days'); 
    const reminderTypeSelect = document.getElementById('reminder-type');
    const customReminderInput = document.getElementById('custom-reminder-input');
    const reminderTimeInput = document.getElementById('reminder-time');
    const monthSelect = document.getElementById('month-select');
    const yearSelect = document.getElementById('year-select');
    const reminderList = document.getElementById('reminder-list');
    const reminderButtons = document.getElementById('reminder-buttons');
    const selectedDateDisplay = document.getElementById('selected-date'); 
    let selectedDate = null;
    let reminders = {}; 

    // Generate year options dynamically (from current year to 10 years ahead)
    const currentYear = new Date().getFullYear();
    for (let i = currentYear - 10; i <= currentYear + 10; i++) {
        const yearOption = document.createElement('option');
        yearOption.value = i;
        yearOption.text = i;
        yearSelect.appendChild(yearOption);
    }

    // Set the current month and year as default selections
    monthSelect.value = new Date().getMonth();
    yearSelect.value = currentYear;

    // Show custom input based on reminder type
    reminderTypeSelect.addEventListener('change', function () {
        if (this.value === 'custom') {
            customReminderInput.classList.remove('hidden');
        } else {
            customReminderInput.classList.add('hidden');
        }
    });

    // Generate the calendar
    function generateCalendar() {
        const selectedMonth = parseInt (monthSelect.value);
        const selectedYear = parseInt(yearSelect.value);
        const firstDay = new Date(selectedYear, selectedMonth, 1).getDay();
        const lastDate = new Date(selectedYear, selectedMonth + 1, 0).getDate();

        // Clear previous days
        calendarDays.innerHTML = '';

        // Fill empty cells for days before the first day of the month
        for (let i = 0; i < (firstDay === 0 ? 6 : firstDay - 1); i++) {
            const emptyCell = document.createElement('div');
            calendarDays.appendChild(emptyCell);
        }

        // Create day cells for the current month
        for (let day = 1; day <= lastDate; day++) {
            const dayCell = document .createElement('div');
            dayCell.innerText = day;
            dayCell.classList.add('date-box', 'cursor-pointer');

            // Handle date selection
            dayCell.addEventListener('click', function () {
                selectedDate = new Date(selectedYear, selectedMonth, day);
                highlightSelectedDate(dayCell);
                displayRemindersForSelectedDate();
            });

            calendarDays.appendChild(dayCell);
        }
    }

    // Update the calendar when the month or year is changed
    monthSelect.addEventListener('change', generateCalendar);
    yearSelect.addEventListener('change', generateCalendar);

    // Initialize the calendar
    generateCalendar();

    // Highlight the selected date
    function highlightSelectedDate(dayCell) {
        const allDayCells = document.querySelectorAll('#calendar-days .date-box');
        allDayCells.forEach(cell => {
            cell.classList.remove('bg-green-100');
        });
        dayCell.classList.add('bg-green-100');
    }

    // Display reminders for the selected date
    function displayRemindersForSelectedDate() {
        if (selectedDate) {
            const dateKey = selectedDate.toDateString();
            selectedDateDisplay.innerText = dateKey;
            reminderButtons.innerHTML = '';

            if (reminders[dateKey]) {
                reminders[dateKey].forEach(reminder => {
                    const reminderButton = document.createElement('button');
                    reminderButton .classList.add('bg-blue-500', 'text-white', 'p-2', 'rounded', 'm-2');
                    reminderButton.innerText = reminder.message;
                    reminderButtons.appendChild(reminderButton);
                });
                reminderList.classList.remove('hidden');
            } else {
                reminderList.classList.add('hidden');
            }
        }
    }

    // Set reminder on the selected date
    setReminderButton.addEventListener('click', function () {
        if (!selectedDate) {
            alert('Please select a date.');
            return;
        }

        let reminderType = reminderTypeSelect.value;
        let customReminderText = '';
        if (reminderType === 'custom') {
            customReminderText = customReminderInput.value.trim();
            if (!customReminderText) {
                alert('Please enter a custom reminder.');
                return;
            }
            reminderType = customReminderText; 
        }

        // Get the selected time
        const reminderTime = reminderTimeInput.value;
        if (!reminderTime) {
            alert('Please select a time for the reminder.');
            return;
        }

        // Prepare the reminder message
        const reminderMessage = `${reminderType} on ${selectedDate.toDateString()} at ${reminderTime}`;

        // Store the reminder
        const dateKey = selectedDate.toDateString();
        if (!reminders[dateKey]) {
            reminders[dateKey] = [];
        }
        reminders[dateKey].push({
            message: reminderMessage,
            type: reminderType 
        });

        // Display the reminder in the reminder output
        alert(`Reminder set for ${reminderMessage}`);
        displayRemindersForSelectedDate();

        // Highlight the date cell based on reminder type
        const dayCells = document.querySelectorAll('#calendar-days .date-box');
        dayCells.forEach(cell => {
            if (parseInt(cell.innerText) === selectedDate.getDate()) {
                // Clear previous type-specific classes
                cell.classList.remove('exam', 'task', 'custom-reminder');
                // Add the new type class
                if (reminderType === 'exam') {
                    cell.classList.add('exam');
                } else if (reminderType === 'task') {
                    cell.classList.add('task');
                } else if (reminderType === customReminderText) {
                    cell.classList.add('custom-reminder');
                }
            }
        });
    });

    // Update the calendar when the month or year is changed
    monthSelect.addEventListener('change', generateCalendar);
    yearSelect.addEventListener('change', generateCalendar);

    // Initialize the calendar
    generateCalendar();

    // Add task functionality
    function addTask(event) {
        event.preventDefault();
        const taskName = document.getElementById('task-name').value;
        const taskSubject = document.getElementById('task-subject').value;
        const taskDueDate = document.getElementById('task-due-date').value;
        const taskDescription = document.getElementById('task-description').value;
        const taskStatus = document.getElementById('task-status').value; // Get status

        // Create a new task object
        const task = {
            name: taskName,
            subject: taskSubject,
            dueDate: taskDueDate,
            description: taskDescription,
            status: taskStatus // Add status to task
        };

        // Add the task to the task list
        addTaskToDOM(task);
        updateTaskCount();
    }

    function addTaskToDOM(task) {
        const taskList = document.getElementById('task-list');
        const taskItem = document.createElement('div');
        taskItem.classList.add('task-item');
        taskItem.innerHTML = `
            <h4>${task.name}</h4>
            <p>Subject: ${task.subject}</p>
            <p>Due Date: ${task.dueDate}</p>
            <p>${task.description}</p>
            <p>Status: <span class="task-status">${task.status}</span></p>
            <button onclick="updateTaskStatus(this)">Complete Task</button>
        `;
        taskList.appendChild(taskItem);

        // Add the task to the upcoming tasks section in the dashboard
        const upcomingTasks = document.getElementById('upcoming-tasks');
        const upcomingTaskItem = document.createElement('div');
        upcomingTaskItem.classList.add('task-item');
        upcomingTaskItem.innerHTML = `
            <h4>${task.name}</h4>
            <p>Subject: ${task.subject}</p>
            <p>Due Date: ${task.dueDate}</p>
            <p>${task.description}</p>
            <p>Status: <span class="task-status">${task.status}</span></p>
        `;
        upcomingTasks.appendChild(upcomingTaskItem);
    }

    function updateTaskStatus(button) {
        const taskItem = button.parentElement;
        const statusSpan = taskItem.querySelector('.task-status');

        // Update status to completed
        statusSpan.innerText = 'completed';

        // Optionally, you can hide the button or change its text
        button.innerText = 'Task Completed';
        button.disabled = true;

        // Update the dashboard as well
        const upcomingTasks = document.getElementById('upcoming-tasks');
        const completedTaskItem = document.createElement('div');
        completedTaskItem.classList.add('task-item');
        completedTaskItem.innerHTML = `
            <h4>${taskItem.querySelector('h4').innerText}</h4>
            <p>Subject: ${taskItem.querySelector('p:nth-of-type(1)').innerText}</p>
            <p>Due Date: ${taskItem.querySelector('p:nth-of-type(2)').innerText}</p>
            <p>${taskItem.querySelector('p:nth-of-type(3)').innerText}</p>
            <p>Status: <span class="task-status">completed</span></p>
        `;
        upcomingTasks.appendChild(completedTaskItem);
    }
    
    const taskName = taskItem.querySelector('h4').innerText;
            const upcomingTasks = document.getElementById('upcoming-tasks');
            const existingTaskItem = Array.from(upcomingTasks.children).find(item => 
                item.getAttribute('data-task-name') === taskName
            );

    // Add class functionality
    function addClass(event) {
        event.preventDefault();
        const className = document.getElementById('className').value;
        const subject = document.getElementById('subject').value;
        const teacherName = document.getElementById('teacherName').value;
        const roomNumber = document.getElementById('roomNumber').value;

        // Create a new class object
        const classItem = {
            name: className,
            subject: subject,
            teacher: teacherName,
            room: roomNumber
        };

        // Add the class to the class list
        const classList = document.getElementById('classesList');
        const classElement = document.createElement('div');
        classElement.innerHTML = `
            <h4>${classItem.name}</h4>
            <p>Subject: ${classItem.subject}</p>
            <p>Teacher : ${classItem.teacher}</p>
            <p>Room: ${classItem.room}</p>
        `;
        classList.appendChild(classElement);

        // Clear the form fields
        document.getElementById('className').value = '';
        document.getElementById('subject').value = '';
        document.getElementById('teacherName').value = '';
        document.getElementById('roomNumber').value = '';
    }
</script>
</body>
</html>