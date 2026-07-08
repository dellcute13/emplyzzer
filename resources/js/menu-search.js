import Alpine from "alpinejs";
import { menuItems } from "./search-menu";

window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {

    Alpine.store("menuSearch", {

        query: "",

        selected: 0,

        menus: menuItems,

        get filtered() {
 
            if (this.query.trim() === "") {
                return [];
            }

            const keyword = this.query.toLowerCase(); 

            return this.menus.filter(menu =>

                menu.title.toLowerCase().includes(keyword) ||

                menu.keywords.some(k =>
                    k.toLowerCase().includes(keyword)
                )

            );

        }

    });

});

Alpine.start();