import './bootstrap';

import { createApp } from 'vue';
import app from './components/TodoComponent.vue';
import axios from 'axios';

// Set the CSRF token header globally
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

createApp(app).mount('#app');