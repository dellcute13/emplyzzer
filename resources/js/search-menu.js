document.addEventListener('alpine:init', () => {

    Alpine.store('menuSearch', {

        query: '',

        selected: 0,

        menus: [

            {
                title: 'Dashboard',
                keywords:['dashboard','home','beranda'],
                route:'/dashboard',
                icon:'dashboard'
            },

            {
                title:'Data Pegawai',
                keywords:['pegawai','employee','karyawan'],
                route:'/employee/employee-data',
                icon:'groups'
            }

            // dst...
        ],

        get filtered(){

            if(this.query==='') return [];

            const q=this.query.toLowerCase();

            return this.menus.filter(menu=>

                menu.title.toLowerCase().includes(q)

                ||

                menu.keywords.some(k=>k.toLowerCase().includes(q))

            );

        }

    });

});