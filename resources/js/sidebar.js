import { createApp } from 'vue';

export default function initSidebar() {
    const app = createApp({
        data() {
            return {
                isSidebarOpen: true,
                isMobile: window.innerWidth < 1024, // < lg breakpoint
            };
        },
        methods: {
            toggleSidebar() {
                this.isSidebarOpen = !this.isSidebarOpen;
            },
            handleResize() {
                this.isMobile = window.innerWidth < 750;

                if (this.isMobile) {
                    this.isSidebarOpen = false; // auto-close on mobile
                } else {
                    this.isSidebarOpen = true; // always open on desktop
                }
            }
        },
        mounted() {
            this.handleResize(); // run once on load
            window.addEventListener('resize', this.handleResize);
        },
        beforeUnmount() {
            window.removeEventListener('resize', this.handleResize);
        }
    });

    app.mount('#sidebar-app'); //mount sa sidebar element
}
