<template>
    <div>
        <input v-model="newTask" @keyup.enter="addTask" placeholder="Add a new task">
        <ul>
            <li v-for="task in tasks" :key="task.id">
                {{ task.name }}
                <button @click="removeTask(task.id)">Remove</button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            newTask: '',
            tasks: [],
            csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        };
    },
    methods: {
        async fetchTasks() {
            try {
                const response = await fetch('/tasks'); // Adjust URL as needed
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                this.tasks = await response.json();
            } catch (error) {
                console.error('Error fetching tasks:', error);
            }
        },
        async addTask() {
    if (this.newTask.trim() === '') return;

    try {
        const response = await fetch('/tasks', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': this.csrfToken,
            },
            body: JSON.stringify({ name: this.newTask }),
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        this.newTask = '';
        this.fetchTasks(); // Refresh the task list
    } catch (error) {
        console.error('Error adding task:', error);
    }
}
,
        async removeTask(id) {
            try {
                await fetch(`/tasks/${id}`, { // Adjust URL as needed
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': this.csrfToken,
                    },
                });
                this.fetchTasks();
            } catch (error) {
                console.error('Error removing task:', error);
            }
        }
    },
    created() {
        this.fetchTasks();
    }
}
</script>

<style scoped>
/* Add your styles here */
</style>
