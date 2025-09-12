new Vue({
            el: '#app',
            data: {
                scrolled: false,
                menuOpen: false,
                features: [
                    {
                        icon: 'fas fa-search',
                        title: 'Real-time Inventory Tracking',
                        description: 'Track every item in your store with real-time updates and low stock alerts.',
                    },
                    {
                        icon: 'fas fa-chart-bar',
                        title: 'Sales Analytics',
                        description: 'Get insights into your best-selling products and optimize your stock levels.',
                    },
                    {
                        icon: 'fas fa-box',
                        title: 'Supplier Management',
                        description: 'Manage all your suppliers in one place with automated reordering.',
                    },
                    {
                        icon: 'fas fa-users',
                        title: 'Multi-user Access',
                        description: 'Grant different access levels to your staff based on their roles.',
                    },
                ],
                testimonials: [
                    {
                        name: 'John Smith',
                        role: 'Store Owner',
                        company: 'Smith Hardware',
                        content: 'This system cut our inventory discrepancies by 85% in the first month. It\'s transformed how we manage our stock.',
                        rating: 5,
                    },
                    {
                        name: 'Maria Rodriguez',
                        role: 'Operations Manager',
                        company: 'BuildRight Supplies',
                        content: 'The real-time tracking has eliminated our stockouts. Our customers are happier and our sales have increased.',
                        rating: 5,
                    },
                    {
                        name: 'Thomas Wilson',
                        role: 'Purchasing Director',
                        company: 'Wilson Hardware Chain',
                        content: 'The automated reordering feature saves us 10+ hours per week and ensures we never miss a replenishment.',
                        rating: 5,
                    },
                ],
            },
            methods: {
                handleScroll() {
                    this.scrolled = window.scrollY > 10;
                },
                toggleMenu() {
                    this.menuOpen = !this.menuOpen;
                },
                closeMenu() {
                    this.menuOpen = false;
                }
            },
            mounted() {
                window.addEventListener('scroll', this.handleScroll);
                
                // Close menu when clicking on a link
                document.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', this.closeMenu);
                });
            }
        });